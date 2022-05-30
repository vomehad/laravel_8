<?php

namespace App\Http\Requests;

use App\Dto\ArticleDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'int',
            'title' => 'required|min:5|max:128',
            'link' => 'nullable|string:regex:/^http(s)?:\/\/(.*)/',
            'category.*' => 'required|integer|exists:categories,id',
            'text' => 'required|min:3',
        ];
    }

    public function createDto(): ArticleDto
    {
        return app(ArticleDto::class)->createFromRequest($this->validated());
    }
}
