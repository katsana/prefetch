<?php

namespace Laravie\Prefetch\Tests\Unit;

use Katsana\Prefetch\Data;
use Katsana\Prefetch\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    /** @test */
    public function it_can_create_a_simple_event()
    {
        $event = new Event('ping', Data::make(['pong']));

        $this->assertSame("event: ping\ndata: [\"pong\"]\n\n", (string) $event);
    }
}
