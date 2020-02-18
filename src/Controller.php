<?php

namespace Katsana\Prefetch;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Katsana\Prefetch\Handler;

class Controller extends \Illuminate\Routing\Controller
{
    use Concerns\DisableBuffering;

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        \ini_set('max_execution_time', 0);
        $this->disableOutputBuffering();

        $handler = \app()->make($request->route()->defaults['handler']);

        return Response::stream($this->streamResolver($handler, $request), 200, [
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
            'Cache-Control' => 'no-cache',
        ]);
    }

    /**
     * Stream resolver.
     *
     * @param object $handler
     */
    protected function streamResolver(Handler $handler, Request $request): Closure
    {
        return static function () use ($handler, $request) {
            $shouldExit = false;

            do {
                $handler->collection($request)
                    ->map(static function ($data) use ($handler) {
                        if ($data instanceof ExitCommand) {
                            return $data;
                        }

                        return $handler->transform($data);
                    })->each(static function ($data) use ($shouldExit) {
                        if ($data instanceof ExitCommand) {
                            $shouldExit = true;

                            return false;
                        }

                        echo 'data: '.\json_encode($data)."\n\n";
                    });

                $handler->onLoopEnded();
            } while ($handler instanceof Contracts\LoopUntil && ! $shouldExit);

            $handler->onStreamEnded();
        };
    }
}
