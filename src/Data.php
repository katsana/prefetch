<?php

namespace Katsana\Prefetch;

class Data implements Contracts\Command
{
    /**
     * SSE data id.
     *
     * @var string
     */
    protected $id;

    /**
     * SSE data message.
     *
     * @var mixed
     */
    protected $message;

    /**
     * Construct a new Data.
     *
     * @param mixed    $message
     * @param int|null $id
     */
    public function __construct($message, $id = null)
    {
        $this->message = $message;
        $this->id = $id;
    }

    /**
     * Construct of make a new Data.
     *
     * @param \Katsana\Prefetch\Data|mixed $message
     * @param int|null                     $id
     *
     * @return static
     */
    public static function make($message, $id = null)
    {
        if ($message instanceof self) {
            return $message;
        }

        return new static($message, $id);
    }

    /**
     * Convert message to SSE payload.
     */
    public function __toString()
    {
        $id = ! \is_null($this->id) ? "id: {$this->id}\n" : '';

        $payload = $this->message instanceof Arrayable
            ? $this->message->toArray()
            : \json_encode($this->message);

        return sprintf("%sdata: %s\n\n", $id, $payload);
    }
}
