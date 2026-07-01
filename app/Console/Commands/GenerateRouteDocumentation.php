<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRouteDocumentation extends Command
{
    protected $signature = 'docs:routes';
    protected $description = 'Generate route documentation';

    public function handle()
    {
        $routes = app('router')->getRoutes();

        $doc = "# Routes\n\n";
        $doc .= "| Method | URI | Name | Action |\n";
        $doc .= "|--------|-----|------|--------|\n";

        foreach ($routes as $route) {
            $doc .= sprintf(
                "| %s | %s | %s | %s |\n",
                implode(', ', $route->methods()),
                $route->uri(),
                $route->getName() ?? '-',
                $route->getActionName()
            );
        }

        File::ensureDirectoryExists(base_path('docs'));
        File::put(base_path('docs/routes.md'), $doc);

        $this->info('Routes documentation generated at docs/routes.md');
    }
}