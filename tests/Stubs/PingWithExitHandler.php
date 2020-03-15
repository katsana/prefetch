<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\Component;
use Katsana\Prefetch\ExitCommand;

class PingWithExitHandler extends Component
{
    public function collection(Request $request)
    {
        return Collection::make([
            'foobar',
            new ExitCommand(),
            'hello',
        ]);
    }
}
