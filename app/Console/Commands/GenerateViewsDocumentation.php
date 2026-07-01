<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateViewsDocumentation extends Command
{
    protected $signature = 'docs:views';
    protected $description = 'Generate Blade template docs';

    public function handle()
    {
        $views = collect(File::allFiles(resource_path('views')))
            ->filter(fn($file) => str_ends_with($file, '.blade.php'));

        $doc = "# Blade Views\n\n";

        foreach ($views as $view) {
            $path = $view->getRelativePathname();
            $doc .= "## " . str_replace('.blade.php', '', $path) . "\n";
            $doc .= "**Location:** resources/views/{$path}\n\n";
            $doc .= "**Description:**\n[Describe what this view displays]\n\n";
        }

        File::put(base_path('docs/views.md'), $doc);
        $this->info('Views docs generated at docs/views.md');
    }
}