<?php

namespace Katsana\Prefetch;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Controller extends \Illuminate\Routing\Controller
{
    use Concerns\DisableBuffering;

    /**
     * Should exit request.
     *
     * @var bool
     */
    protected $shouldExit = false;

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        \ini_set('max_execution_time', 0);
        $this->disableOutputBuffering();

        $component = \app()->make($request->route()->defaults['component']);

        return Response::stream($this->streamResolver($component, $request), 200, [
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
            'Cache-Control' => 'no-cache',
        ]);
    }

    /**
     * Stream resolver.
     */
    protected function streamResolver(Component $component, Request $request): Closure
    {
        return function () use ($component, $request) {
            $component->onStreamStarted();

            do {
                $component->onLoopStarted();

                $component->collection($request)
                    ->map(static function ($data) use ($component) {
                        if ($data instanceof Contracts\Command) {
                            return $data;
                        }

                        return $component->transform($data);
                    })->each(function ($data) use ($component) {
                        if ($data instanceof ExitCommand) {
                            $this->shouldExit = true;

                            return false;
                        }

                        $component->render($data);
                    });

                $component->onLoopEnded();
            } while ($component instanceof Contracts\LoopUntil && $this->shouldExit === false);

            $component->onStreamEnded();
        };
    }
}
