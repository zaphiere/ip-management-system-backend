<?php

namespace App\Http\Requests\AuditLog;

use App\Helpers\JsonResponseHelper;
use App\Enums\{
    Action,
    EntityType,
};
use Illuminate\Contracts\Validation\{
    ValidationRule,
    Validator,
};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AuditLogSearchRequest extends FormRequest
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
            'user_email' => [
                'nullable',
                'max:255',
            ],
            'session_id' => [
                'nullable',
                'max:100',
            ],
            'entity_type' => [
                'nullable',
                Rule::enum(EntityType::class),
            ],
            'entity_ip' => [
                'nullable',
                'max:45',
            ],
            'entity_user_email' => [
                'nullable',
                'max:255',
            ],
            'action' => [
                'nullable',
                Rule::enum(Action::class),
            ],
            'start_date' => [
                'nullable',
                'date',
                'before_or_equal:end_date',
            ],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
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
