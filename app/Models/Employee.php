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
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(city::class, 'city_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(bank::class, 'bank_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(position::class, 'position_id', 'id');
    }
}
