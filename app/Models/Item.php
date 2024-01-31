<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function driver(){

        return $this->belongsTo(User::class,'driver_id');
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

}
