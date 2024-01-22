<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
                'users_id' => $this->user_id,
                'users_name' => $this->users_name,
                'users_email' => $this->users_email,
                'location' => $this->location,
                'balance' => $this->balance,
                'users_token' => $this->whenNotNull($this->users_token),
            ],
            'error' => null,
        ];
    }
}
