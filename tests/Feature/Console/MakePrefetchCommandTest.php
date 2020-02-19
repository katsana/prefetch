<?php

namespace Laravie\Prefetch\Tests\Feature\Console;

use Orchestra\Canvas\Core\Testing\TestCase;

class MakePrefetchCommandTest extends TestCase
{
    protected $files = [
        'app/Http/Prefetch/Ping.php',
    ];

    /** @test */
    public function it_can_generate_request_file()
    {
        $this->artisan('make:prefetch', ['name' => 'Ping'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Http\Prefetch;',
            'use Illuminate\Http\Request;',
            'use Illuminate\Support\Collection;',
            'use Katsana\Prefetch\Handler;',
            'class Ping extends Handler',
            'public function collection(Request $request)',
        ], 'app/Http/Prefetch/Ping.php');
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Katsana\Prefetch\PrefetchServiceProvider'];
    }
}
