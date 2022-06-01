<?php

namespace App\Http\Requests;

use App\Dto\ArticleDto;
use App\Dto\CategoryDto;
use App\Interfaces\TransportInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest implements TransportInterface
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
            'category.name' => 'required|min:5|max:128',
            'category.active' => 'bool',
            'category.article.*' => 'required|integer|exists:articles,id',
            'category.note.*' => 'required|integer|exists:notes,id',
        ];
    }

    public function createDto(): CategoryDto
    {
        return app(CategoryDto::class)->createFromRequest($this->validated(), 'category');
    }
}
