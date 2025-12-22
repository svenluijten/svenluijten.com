<?php

namespace App\Support\Markdown;

use Illuminate\Database\Eloquent\Model;

interface Renderer
{
    public function render(Model $model, string $field): string;
}
