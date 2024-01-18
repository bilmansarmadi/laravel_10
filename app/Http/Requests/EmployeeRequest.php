<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class EmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'date_of_birth' => ['required', 'date'],
            'phone_number' => ['required'],
            'email' => ['required', 'email', 'unique:employees'],
            'province_id' => ['required', 'exists:provinces,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'street_address' => ['required'],
            'zip_code' => ['required'],
            'ktp_number' => ['required', 'unique:employees'],
            'position_id' => ['required','exists:positions,id'],
            'bank_id' => ['required', 'exists:banks,id'],
            'bank_account_number' => ['required'],
            'image_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
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
