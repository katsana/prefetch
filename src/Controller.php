<?php

namespace Katsana\Prefetch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Controller extends \Illuminate\Routing\Controller
{
    use Concerns\DisableBuffering;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        \ini_set('max_execution_time', 0);
        $this->disableOutputBuffering();

        $handler = \app()->make($request->route()->defaults['handler']);

        return Response::stream(function () use ($handler, $request) {
            $loopUntil = $handler instanceof Contracts\LoopUntil;

            do {
                $handler->collection($request)
                    ->map(static function ($data) use ($handler) {
                        if ($data instanceof ExitCommand) {
                            exit();
                        }

                        return $handler->transform($data);
                    })->each(static function ($data) {
                        echo "data: ".\json_encode($data)."\n\n";
                    });
            } while($loopUntil === true);

            if ($loopUntil === true) {
                $handler->onLoopEnded();
            }
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
            'Cache-Control' => 'no-cache',
        ]);
    }
}
