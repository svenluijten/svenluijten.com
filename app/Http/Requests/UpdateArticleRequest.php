<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['string'],
            'slug' => ['string', Rule::unique('articles', 'slug')],
            'published' => [Rule::date()->todayOrAfter()],
            'content' => ['string'],
        ];
    }
}
