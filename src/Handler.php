<?php

namespace Katsana\Prefetch;

abstract class Handler
{
    /**
     * Transform data to array.
     *
     * @param \Illuminate\Database\Eloquent\Model|mixed $data
     */
    public function transform($data): Data
    {
        return Data::make($data);
    }

    /**
     * On loop ended event.
     */
    public function onLoopEnded(): void
    {
        //
    }

    /**
     * On loop ended event.
     */
    public function onStreamEnded(): void
    {
        //
    }
}
