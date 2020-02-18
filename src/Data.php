<?php

namespace Katsana\Prefetch;

class Data
{
    /**
     * SSE data message.
     *
     * @var mixed
     */
    protected $message;

    /**
     * Construct a new Data.
     *
     * @param mixed $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Construct of make a new Data.
     *
     * @param \Katsana\Prefetch\Data|mixed $message
     *
     * @return static
     */
    public static function make($message)
    {
        if ($message instanceof self) {
            return $message;
        }

        return new static($message);
    }

    /**
     * Convert message to SSE payload.
     */
    public function __toString()
    {
        return 'data: '.\json_encode($this->message)."\n\n";
    }
}
