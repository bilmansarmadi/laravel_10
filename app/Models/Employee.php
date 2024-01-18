<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model

{

    protected $table = "employees";
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'email',
        'province_id',
        'city_id',
        'street_address',
        'zip_code',
        'ktp_number',
        'position_id',
        'bank_id',
        'bank_account_number',
        'ktp_scan',
        'image_path'
    ];


    public function province()
    {
        return $this->belongsTo(Province::class, 'id', 'province_id');
    }
}
