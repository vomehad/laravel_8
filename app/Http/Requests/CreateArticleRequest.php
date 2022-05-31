<?php

namespace App\Http\Requests;

use App\Dto\ArticleDto;
use App\Interfaces\TransportInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest implements TransportInterface
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
            'article.title' => 'required|min:5|max:128',
            'article.link' => 'nullable|string:regex:/^http(s)?:\/\/(.*)/',
            'article.created_by' => 'required|integer|exists:users,id',
            'article.category.*' => 'required|integer|exists:categories,id',
            'article.text' => 'required|min:3',
        ];
    }

    public function createDto(): ArticleDto
    {
        return app(ArticleDto::class)->createFromRequest($this->validated(), 'article');
    }
}
