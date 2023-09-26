<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;

class LoginRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
