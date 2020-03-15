<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\Data;
use Katsana\Prefetch\Component;

class PingHandler extends Component
{
    public function collection(Request $request)
    {
        return Collection::make([
            'foo',
            'bar',
            new Data('foobar', 1234),
        ]);
    }
}
