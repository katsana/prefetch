<?php

namespace Laravie\Prefetch\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Katsana\Prefetch\Tests\Stubs\PingHandler;
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
}
