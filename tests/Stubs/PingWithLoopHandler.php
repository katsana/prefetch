<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\Component;
use Katsana\Prefetch\Contracts\LoopUntil;
use Katsana\Prefetch\ExitCommand;

class PingWithLoopHandler extends Component implements LoopUntil
{
    protected $data = ['foo', 'bar'];

    public function collection(Request $request)
    {
        return Collection::make($this->data);
    }

    public function onLoopEnded(): void
    {
        $this->data = [
            'foobar',
            new ExitCommand(),
            'hello',
        ];
    }
}
