<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateFullDocumentation extends Command
{
    protected $signature = 'docs:generate';
    protected $description = 'Generate all documentation (views, controllers, models, and routes)';

    public function handle()
    {
        $this->call('docs:views');
        $this->call('docs:controllers');
        $this->call('docs:models');
        $this->call('docs:routes');

        $this->info('All documentation generated in docs/ folder');
    }
}