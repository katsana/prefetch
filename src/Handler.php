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
        return new Data($data);
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
