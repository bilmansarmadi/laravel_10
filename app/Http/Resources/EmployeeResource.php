<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'code' => 200,
            'success' => true,
            'data' => [
                'employee_id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'date_of_birth' => $this->date_of_birth,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'province_id' => $this->province_id,
                'city_id' => $this->city_id,
                'street_address' => $this->street_address,
                'zip_code' => $this->zip_code,
                'ktp_number' => $this->ktp_number,
                'position_id' => $this->position_id,
                'bank_id' => $this->bank_id,
                'bank_account_number' => $this->bank_account_number,
                'image_path' => $this->image_path
            ],
            'error' => null,
        ];
    }
}
