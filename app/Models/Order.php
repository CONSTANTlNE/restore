<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'customer_id');
    }

    public function items(){
        return $this->hasMany(Item::class);
    }


    public function driver(){
        return $this->belongsTo(User::class,'driver_id');
    }

    public function balance(){

        return $this->hasMany(Balance::class,);

    }


}
