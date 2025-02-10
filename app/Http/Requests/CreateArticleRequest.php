<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'slug' => ['required', 'string', Rule::unique('articles', 'slug')],
            'published' => ['required', Rule::date()->todayOrAfter()],
            'content' => ['required', 'string'],
        ];
    }
}
