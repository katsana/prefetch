<?php

namespace Laravie\Prefetch\Concerns;

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
        \ini_set('zlib.output_compression', false);

        //Flush (send) the output buffer and turn off output buffering
        while (@\ob_end_flush()) {
            //
        }

        // Implicitly flush the buffer(s)
        \ini_set('implicit_flush', true);
        \ob_implicit_flush(true);
    }
}
