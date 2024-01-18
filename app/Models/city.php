<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $table = "cities";
    protected $primaryKey = 'id';

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
