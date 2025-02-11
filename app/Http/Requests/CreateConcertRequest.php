<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateConcertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'artist' => ['required', 'string'],
            'tour_name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'date' => ['required', 'date'],
            'content' => ['required', 'string'],
            'venue' => ['required', Rule::exists('venues', 'id')],
            'published_at' => ['sometimes', Rule::date()],
        ];
    }
}
