<?php

namespace Katsana\Prefetch;

abstract class Handler
{
    /**
     * Transform data to array.
     *
     * @param  \Illuminate\Database\Eloquent\Model|mixed  $data
     * @return array|mixed
     */
    public function transform($data)
    {
        return $data;
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
