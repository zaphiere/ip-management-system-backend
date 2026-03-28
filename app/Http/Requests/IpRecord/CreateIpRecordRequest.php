<?php

namespace App\Http\Requests\IpRecord;

use App\Helpers\JsonResponseHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateIpRecordRequest extends FormRequest
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
                'required',
                'max:45',
                'ip',
                Rule::unique('ip_address_records', 'ip_address')
           ],
           'label' => [
                'required',
                'max:100',
                'string',
                'regex:/^[A-Za-z0-9 _-]+$/',
           ],
           'comment' => [
                'nullable',
                'max:255',
                'string',
                'regex:/^[\pL\pN\s\.,;:!?\-()\'"]*$/u',
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
