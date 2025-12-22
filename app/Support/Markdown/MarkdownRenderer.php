<?php

namespace App\Support\Markdown;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\MarkdownConverter;

readonly class MarkdownRenderer implements Renderer
{
    public function __construct(
        private MarkdownConverter $converter,
    ) {}

    public function render(Model $model, string $field): string
    {
        return $this->converter->convert($model->{$field})->getContent();
    }
}
