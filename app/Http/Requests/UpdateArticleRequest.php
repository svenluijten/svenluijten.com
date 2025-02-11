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
        /** @var \App\Models\Article $article */
        $article = $this->route('article');

        return [
            'title' => ['string'],
            'slug' => ['string', Rule::unique('articles', 'slug')->ignore($article)],
            'published' => [Rule::date()->todayOrAfter()],
            'content' => ['string'],
        ];
    }
}
