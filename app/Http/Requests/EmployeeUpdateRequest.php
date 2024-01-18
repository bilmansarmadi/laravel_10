<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employeeId = $this->route('employee');

        return [
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'email' => [
                'nullable',
                'email',
                Rule::unique('employees', 'email')->ignore($this->route('id')),
            ],
            'province_id' => ['nullable', 'exists:provinces,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'street_address' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:10'],
            'ktp_number' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('employees', 'ktp_number')->ignore($this->route('id')),
            ],
            'position_id' => ['nullable', 'exists:positions,id'],
            'bank_id' => ['nullable', 'exists:banks,id'],
            'bank_account_number' => ['nullable', 'string', 'max:20'],
            'image_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "code" => 400,
            "status" => "false",
            "data" => [],
            "error" => $validator->getMessageBag()
        ], 400));
    }
}
