<?php

namespace Katsana\Prefetch\Contracts;

interface LoopUntil
{
    /**
     * On loop ended event.
     */
    public function onLoopEnded(): void;
}
