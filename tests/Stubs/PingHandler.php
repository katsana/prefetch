<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\Component;
use Katsana\Prefetch\Data;

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
