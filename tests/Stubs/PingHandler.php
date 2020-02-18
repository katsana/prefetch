<?php

namespace Katsana\Prefetch\Tests\Stubs;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Katsana\Prefetch\Handler;

class PingHandler extends Handler
{
    protected $data = ['foo', 'bar'];

    public function collection(Request $request)
    {
        return Collection::make($this->data);
    }
}
