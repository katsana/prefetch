<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\ExitCommand;
use Katsana\Prefetch\Handler;

class PingWithExitHandler extends Handler
{
    /**
     * Create collection for the request.
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Support\LazyCollection
     */
    public function collection(Request $request)
    {
        return Collection::make([
            'foobar',
            new ExitCommand(),
            'hello',
        ]);
    }
}
