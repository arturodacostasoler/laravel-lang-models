<?php

declare(strict_types=1);

namespace LaravelLang\Models\Generators;

use DragonCode\Support\Facades\Filesystem\Path;
use LaravelLang\Models\Services\ClassMap;

use function array_map;
use function dirname;
use function sprintf;

class ModelGenerator extends Generator
{
    protected string $stub = __DIR__ . '/../../stubs/model.stub';

    protected string $fillables = '        \'%s\',';

    protected string $casts = '        \'%s\' => TrimCast::class,';

    protected function data(): array
    {
        return [
            'suffix'   => $this->modelSuffix(),
            'fillable' => $this->getFillable(),
            'casts'    => $this->getCasts(),
        ];
    }

    protected function filename(): string
    {
        $directory = dirname($path = $this->path());
        $filename  = $this->getModel() . $this->modelSuffix();
        $extension = $this->extension($path);

        return $directory . '/' . $filename . '.' . $extension;
    }

    protected function getFillable(): array
    {
        return array_map(function (string $attribute) {
            return sprintf($this->fillables, $attribute);
        }, $this->columns);
    }

    protected function getCasts(): array
    {
        return array_map(function (string $attribute) {
            return sprintf($this->casts, $attribute);
        }, $this->columns);
    }

    protected function path(): string
    {
        return ClassMap::path($this->model);
    }

    protected function extension(string $path): string
    {
        return Path::extension($path);
    }
}