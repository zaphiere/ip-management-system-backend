<?php

namespace App\Http\Requests\IpRecord;

use App\Helpers\JsonResponseHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IpAddressListRequest extends FormRequest
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
           'ip_address' => [
                'max:45',
                'nullable',
           ],
           'label' => [
                'max:100',
                'nullable',
           ],
           'comment' => [
                'max:255',
                'nullable',
           ]
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
