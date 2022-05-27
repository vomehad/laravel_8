<?php

namespace App\Http\Requests;

use App\Dto\KinsmanDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKinsmanRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'middle_name' => 'required|string',
            'gender' => 'required|in:male,female',
            'father_id' => 'nullable|int',
            'mother_id' => 'nullable|int',
            'kin_id' => 'nullable|int'
        ];
    }

    public function createDto(): KinsmanDto
    {
        return app(KinsmanDto::class)->createFromRequest($this->validated());
    }
}
