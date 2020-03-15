<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\Component;
use Katsana\Prefetch\Data;
use Katsana\Prefetch\Event;

class PingWithEventHandler extends Component
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
