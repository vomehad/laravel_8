<?php

namespace App\Http\Requests;

use App\Dto\KinDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateKinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'kin.id' => 'int',
            'active' => 'bool',
            'kin.active' => 'bool',
            'name' => 'required_if:kin.name,null|string|min:3',
            'kin.name' => 'required_if:name,null|string|min:3',
        ];
    }

    public function createDto(): KinDto
    {
        return app(KinDto::class)->createFromRequest($this->validated());
    }
}
