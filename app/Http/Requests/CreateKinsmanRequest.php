<?php

namespace App\Http\Requests;

use App\Dto\KinsmanDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateKinsmanRequest extends FormRequest
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
            'name' => 'required_if:kinsman.name,null|string|min:3',
            'kinsman.name' => 'required_if:name,null|string|min:3',

            'middle_name' => 'required_if:kinsman.middle_name,null|string',
            'kinsman.middle_name' => 'required_id:middle_name,null|string',

            'gender' => 'required_if:kinsman.gender,null|in:male,female',
            'kinsman.gender' => 'required_if:gender,null|in:male,female',

            'father_id' => 'nullable|int',
            'kinsman.father_id' => 'nullable|int',

            'mother_id' => 'nullable|int',
            'kinsman.mother_id' => 'nullable|int',

            'kin_id' => 'nullable|int',
            'kinsman.kin_id' => 'nullable|int',
        ];
    }

    public function createDto(): KinsmanDto
    {
        return app(KinsmanDto::class)->createFromRequest($this->validated());
    }
}
