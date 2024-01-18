<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required',
            'email' => 'required|email|unique:employees',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'street_address' => 'required',
            'zip_code' => 'required',
            'ktp_number' => 'required|unique:employees',
            'current_position' => 'required|exists:positions,id',
            'bank_id' => 'required|exists:banks,id',
            'bank_account_number' => 'required',
            'ktp_scan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'The date of birth must be a valid date.',
            'phone_number.required' => 'The phone number field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'province_id.required' => 'The province field is required.',
            'province_id.exists' => 'Invalid province selected.',
            'city_id.required' => 'The city field is required.',
            'city_id.exists' => 'Invalid city selected.',
            'street_address.required' => 'The street address field is required.',
            'zip_code.required' => 'The zip code field is required.',
            'ktp_number.required' => 'The KTP number field is required.',
            'ktp_number.unique' => 'The KTP number is already in use.',
            'current_position.required' => 'The current position field is required.',
            'current_position.exists' => 'Invalid position selected.',
            'bank_id.required' => 'The bank field is required.',
            'bank_id.exists' => 'Invalid bank selected.',
            'bank_account_number.required' => 'The bank account number field is required.',
            'ktp_scan.required' => 'The KTP scan field is required.',
            'ktp_scan.image' => 'The KTP scan must be an image.',
            'ktp_scan.mimes' => 'The KTP scan must be a file of type: jpeg, png, jpg, gif, svg.',
            'ktp_scan.max' => 'The KTP scan may not be greater than 2048 kilobytes.',
        ];
    }
}
