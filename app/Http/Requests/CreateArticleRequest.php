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
            'article.title' => 'required_if:article.title,article.title|min:5|max:128',
            'title' => 'required_if:title,title|min:5|max:128',
            'article.link' => 'nullable|string:regex:/^http(s)?:\/\/(.*)/',
            'link' => 'nullable|string:regex:/^http(s)?:\/\/(.*)/',
            'article.created_by' => 'required_if:article.created_by,created_by|integer|exists:users,id',
            'created_by' => 'required_if:created_by,created_by|integer|exists:users,id',
            'article.category.*' => 'required_if:article.category.*,article.category.*|integer|exists:categories,id',
            'category.*' => 'required_if:category.*,category.*|integer|exists:categories,id',
            'article.text' => 'required_if:article.text,article.text|min:3',
            'text' => 'required_if:text,text|min:3',
        ];
    }

    public function createDto(): ArticleDto
    {
        return app(ArticleDto::class)->createFromRequest($this->validated());
    }
}
