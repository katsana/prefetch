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
     * On loop started event.
     */
    public function onLoopStarted(): void
    {
        //
    }

    /**
     * On loop ended event.
     */
    public function onLoopEnded(): void
    {
        //
    }

    /**
     * On stream started event.
     */
    public function onStreamStarted(): void
    {
        //
    }

    /**
     * On stream ended event.
     */
    public function onStreamEnded(): void
    {
        //
    }
}
