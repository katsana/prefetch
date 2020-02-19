<?php

namespace Laravie\Prefetch\Tests\Unit;

use Katsana\Prefetch\Data;
use PHPUnit\Framework\TestCase;

class DataTest extends TestCase
{
    /** @test */
    public function it_can_create_a_simple_data()
    {
        $data = new Data('ping');

        $this->assertSame("data: \"ping\"\n\n", (string) $data);
    }

    /** @test */
    public function it_can_create_a_simple_data_using_array()
    {
        $data = new Data(['ping' => 'foobar']);

        $this->assertSame("data: {\"ping\":\"foobar\"}\n\n", (string) $data);
    }

    /** @test */
    public function it_can_create_a_simple_data_with_id()
    {
        $data = new Data('ping', 1);

        $this->assertSame("id: 1\ndata: \"ping\"\n\n", (string) $data);
    }

    /** @test */
    public function it_can_create_a_simple_data_using_array_with_id()
    {
        $data = new Data(['ping' => 'foobar'], 2);

        $this->assertSame("id: 2\ndata: {\"ping\":\"foobar\"}\n\n", (string) $data);
    }
}
