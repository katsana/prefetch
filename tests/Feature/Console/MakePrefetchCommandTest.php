<?php

namespace Laravie\Prefetch\Tests\Feature\Console;

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;
use Orchestra\Testbench\TestCase;

class MakePrefetchCommandTest extends TestCase
{
    use InteractsWithPublishedFiles;
    
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
            'use Katsana\Prefetch\Component;',
            'class Ping extends Component',
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
