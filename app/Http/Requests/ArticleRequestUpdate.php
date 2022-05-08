<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 * @property string $title
 */
class ArticleRequestUpdate extends FormRequest
{
    public function authorize(): string
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:128',
            'text' => 'required|min:3',
            'category.*' => 'required|integer|exists:categories,id',
        ];
    }
}
