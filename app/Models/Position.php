<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['positions_name'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'id');
    }
}
