<?php

namespace App\Support\Markdown;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

readonly class CachedMarkdownRenderer implements Renderer
{
    public function __construct(
        private Renderer $renderer,
    ) {}

    public function render(Model $model, string $field): string
    {
        if (! method_exists($model, 'cacheKey')) {
            return $this->renderer->render($model, $field);
        }

        return Cache::remember($model->cacheKey($field), now()->addMonth(), function () use ($model, $field) {
            return $this->renderer->render($model, $field);
        });
    }
}
