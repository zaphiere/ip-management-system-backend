<?php

namespace App\Http\Requests\Admin;

use App\Enums\Role;
use App\Helpers\JsonResponseHelper;
use Illuminate\Contracts\Validation\{
    ValidationRule,
    Validator,
};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateAdminUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'max:255',
                'email:rfc,dns',
                Rule::unique('users', 'email')
                    ->whereNull('deleted_at'),
            ],
            'password' => [
                'required',
                Password::min(6)
                    ->max(24)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'role' => [
                'required',
                Rule::enum(Role::class),
            ],
        ];
    }

    /**
     * Handle Failed Validation into JSON
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            JsonResponseHelper::error(
                $validator->errors()->all(),
                'Validation Error',
                422
            )
        );
    }
}
