<?php

namespace Laravie\Prefetch\Tests\Unit;

use Katsana\Prefetch\Data;
use Katsana\Prefetch\ExitCommand;
use PHPUnit\Framework\TestCase;

class ExitCommandTest extends TestCase
{
    /** @test */
    public function it_can_create_a_simple_exit_command()
    {
        $exit = new ExitCommand();

        $this->assertSame("\n", (string) $exit);
    }

    /** @test */
    public function it_can_create_an_exit_command_with_data()
    {
        $exit = new ExitCommand(new Data('foo'));

        $this->assertSame("data: \"foo\"\n\n", (string) $exit);
    }
}
