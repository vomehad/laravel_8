<?php

namespace App\Http\Requests;

use App\Dto\NoteDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category' => 'nullable|array',
            'note_id' => 'nullable|int',
            'content' => 'required|string|min:14',
        ];
    }

    public function createDto(): NoteDto
    {
        return app(NoteDto::class)->createFromRequest($this->validated());
    }
}
