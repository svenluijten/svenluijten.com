<?php

namespace App\Models\Concerns;

use App\Support\Markdown\Renderer;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;

trait HasMarkdownContent
{
    public function renderMarkdown(string $field): string
    {
        return app(Renderer::class)->render($this, $field);
    }

    protected function renderedContent(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->renderMarkdown('content'),
        );
    }

    public function cacheKey(string $field): string
    {
        return sprintf(
            'markdown.%s.%s.%s',
            $this->getTable(),
            $this->getKey(),
            $field,
        );
    }

    protected static function bootHasMarkdownContent(): void
    {
        static::updated(static function ($model) {
            if ($model->wasChanged('content')) {
                Cache::forget($model->cacheKey('content'));
            }
        });
    }
}
