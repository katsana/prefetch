<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\Data;
use Katsana\Prefetch\Handler;
use Katsana\Prefetch\EventCommand;

class PingWithEventHandler extends Handler
{
    public function collection(Request $request)
    {
        return Collection::make([
            'foo',
            new EventCommand('ping', new Data(['pong'])),
            'bar',
        ]);
    }
}
