<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class GenerateControllerDocumentation extends Command
{
    protected $signature = 'docs:controllers';
    
    public function handle()
    {
        $controllers = collect(File::allFiles(app_path('Http/Controllers')));
        $doc = "# Controllers\n\n";

        foreach ($controllers as $file) {
            $relativePath = $file->getRelativePath();
            $className = $file->getFilenameWithoutExtension();

            $namespace = 'App\\Http\\Controllers';
            if (!empty($relativePath)) {
                $namespace .= '\\' . str_replace('/', '\\', $relativePath);
            }

            $fullClassName = $namespace . '\\' . $className;

            if (class_exists($fullClassName)) {
                $location = 'app/Http/Controllers';
                if (!empty($relativePath)) {
                    $location .= '/' . $relativePath;
                }
                $doc .= "## {$fullClassName}\n";
                $doc .= "**Location:** {$location}/{$file->getFilename()}\n\n";
            }
        }

        File::put(base_path('docs/controllers.md'), $doc);
        $this->info('Controllers docs generated at docs/controllers.md');
    }
}