<?php

namespace Laravie\Prefetch\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Katsana\Prefetch\Tests\Stubs\PingHandler;
use Katsana\Prefetch\Tests\Stubs\PingWithExitHandler;
use Katsana\Prefetch\Tests\TestCase;

class MakeRequestTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->afterApplicationCreated(static function () {
            Route::prefetch('stream', PingHandler::class);
            Route::prefetch('stream-with-exit', PingWithExitHandler::class);
        });
    }

    /** @test */
    public function it_can_make_a_request()
    {
        $response = $this->get('/stream');

        $this->assertSame('data: "foo"

data: "bar"

', $response->streamedContent());

        $response->assertOk()
            ->assertHeader('Content-Type', 'text/event-stream; charset=UTF-8')
            ->assertHeader('X-Accel-Buffering', 'no');
    }


    /** @test */
    public function it_can_make_a_request_with_exit_command()
    {
        $response = $this->get('/stream-with-exit');

        $this->assertSame('data: "foobar"

', $response->streamedContent());

        $response->assertOk()
            ->assertHeader('Content-Type', 'text/event-stream; charset=UTF-8')
            ->assertHeader('X-Accel-Buffering', 'no');
    }
}
