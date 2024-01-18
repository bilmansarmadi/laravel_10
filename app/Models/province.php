<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    protected $table = "provinces";
    protected $primaryKey = 'id';
    public $incrementing = false;


    public function employees()
    {
        return $this->hasMany(Employee::class, 'id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'province_id');
    }
}
