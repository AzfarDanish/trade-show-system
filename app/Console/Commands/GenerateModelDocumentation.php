<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Model;

class GenerateModelDocumentation extends Command
{
    protected $signature = 'docs:models';
    protected $description = 'Generate model documentation without Doctrine';

    public function handle()
    {
        $modelsPath = app_path('Models');

        if (!File::exists($modelsPath)) {
            $this->error("Models directory not found.");
            return 1;
        }

        $models = collect(File::allFiles($modelsPath))
            ->filter(fn($file) => $file->getExtension() === 'php');

        $doc = "# Laravel Models Documentation\n\n";
        $doc .= "Generated on: " . now()->toDateTimeString() . "\n\n";

        foreach ($models as $file) {
            $className = 'App\\Models\\' . str_replace(
                ['/', '.php'],
                ['\\', ''],
                $file->getRelativePathname()
            );

            if (!class_exists($className)) {
                continue;
            }

            if (!is_subclass_of($className, Model::class)) {
                continue;
            }

            $doc .= $this->documentModel($className);
        }

        File::ensureDirectoryExists(base_path('docs'));
        File::put(base_path('docs/models.md'), $doc);

        $this->info("Documentation generated: docs/models.md");

        return 0;
    }

    protected function documentModel(string $className): string
    {
        $reflection = new ReflectionClass($className);
        $model = new $className;
        $table = $model->getTable();

        $output = "## " . $reflection->getShortName() . "\n\n";
        $output .= "**Table:** " . $table . "\n\n";
        $output .= "**Primary Key:** " . $model->getKeyName() . "\n\n";

        try {
            // Get column details (NO DOCTRINE)
            $columns = DB::select("SHOW COLUMNS FROM {$table}");
        } catch (\Exception $e) {
            $this->error("Cannot read table {$table}");
            return "";
        }

        $output .= "### Columns\n";
        $output .= "| Field | Type | Null | Default |\n";
        $output .= "|------|------|------|---------|\n";

        foreach ($columns as $col) {
            $output .= sprintf(
                "| %s | %s | %s | %s | \n",
                $col->Field,
                $col->Type,
                $col->Null,
                $col->Default ?? 'NULL'
            );
        }

        // Fillable
        $output .= "\n### Fillable\n";
        foreach ($model->getFillable() as $fill) {
            $output .= "- $fill\n";
        }

        // Casts
        if (!empty($model->getCasts())) {
            $output .= "\n### Casts\n";
            foreach ($model->getCasts() as $key => $type) {
                $output .= "- $key => $type\n";
            }
        }

        // Relationships
        $output .= "\n### Relationships\n";
        $methods = get_class_methods($className);
        foreach ($methods as $method) {
            if (str_starts_with($method, 'get') || str_starts_with($method, 'scope')) {
                continue;
            }

            try {
                $reflectionMethod = new ReflectionMethod($className, $method);
                $returnType = $reflectionMethod->getReturnType();

                if ($returnType) {
                    $typeName = $returnType->getName();

                    if (str_contains($typeName, 'HasMany') ||
                        str_contains($typeName, 'BelongsTo') ||
                        str_contains($typeName, 'HasOne') ||
                        str_contains($typeName, 'BelongsToMany')) {
                        $params = $reflectionMethod->getParameters();

                        if (empty($params)) {
                            $output .= "- `{$method}()` → {$typeName}\n";
                        }
                    }
                }
            } catch (\Exception $e) {
                // Skip methods that can't be analyzed
            }
        }

        // Accessors & Mutators
        $output .= "\n### Accessors & Mutators\n";
        foreach ($methods as $method) {
            if (str_starts_with($method, 'get') && str_ends_with($method, 'Attribute')) {
                $attribute = str_replace(['get', 'Attribute'], '', $method);
                $output .= "- `{$attribute}` (accessor)\n";
            } elseif (str_starts_with($method, 'set') && str_ends_with($method, 'Attribute')) {
                $attribute = str_replace(['set', 'Attribute'], '', $method);
                $output .= "- `{$attribute}` (mutator)\n";
            }
        }

        $output .= "\n---\n\n";

        return $output;
    }
}