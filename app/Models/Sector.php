<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;



    public function prices(){
        return $this->hasMany(ServicePrice::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }
}
