<?php

namespace Katsana\Prefetch\Concerns;

use Throwable;

trait DisableBuffering
{
    /**
     * Disable output buffering.
     */
    protected function disableOutputBuffering(): void
    {
        // Turn off output buffering
        \ini_set('output_buffering', 'off');
        // Turn off PHP output compression

        try {
            \ini_set('zlib.output_compression', false);
        } catch (Throwable $e) {
            //
        }

        // Implicitly flush the buffer(s)
        \ini_set('implicit_flush', true);
        \ob_implicit_flush(true);
    }
}
