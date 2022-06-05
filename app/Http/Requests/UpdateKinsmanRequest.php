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
            'kinsman.id' => 'int',

            'name' => 'required_if:kinsman.name,null|string|min:3',
            'kinsman.name' => 'required_if:name,null|string|min:3',

            'middle_name' => 'required_if:kinsman.middle_name,null|string',
            'kinsman.middle_name' => 'required_if:middle_name,null|string',

            'gender' => 'required_if:kinsman.gender,null|in:male,female',
            'kinsman.gender' => 'required_if:gender,null|in:male,female',

            'father_id' => 'nullable',
            'kinsman.father_id' => 'nullable',

            'mother_id' => 'nullable',
            'kinsman.mother_id' => 'nullable',

            'kin_id' => 'nullable',
            'kinsman.kin_id' => 'nullable',

            'birth_date' => 'nullable|string',
            'life.birth_date' => 'nullable|string',

            'end_date' => 'nullable|string',
            'life.end_date' => 'nullable|string',
        ];
    }

    public function createDto(): KinsmanDto
    {
        return app(KinsmanDto::class)->createFromRequest($this->validated());
    }
}
