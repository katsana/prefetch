<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\Data;
use Katsana\Prefetch\Event;
use Katsana\Prefetch\Handler;

class PingWithEventHandler extends Handler
{
    public function collection(Request $request)
    {
        return Collection::make([
            'foo',
            new Event('ping', new Data(['pong'])),
            'bar',
        ]);
    }
}
