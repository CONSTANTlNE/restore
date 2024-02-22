<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sector;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{

    public function index(){

        $role     = Role::where('name', 'driver')->first();
        $couriers = $role->users;
        $items    = Item::with('order.user')->get();
        $sectors=Sector::with('prices')->get();


        return view('test',compact('items','couriers','sectors'));

    }




    public function testItems(){

        $role     = Role::where('name', 'driver')->first();
        $couriers = $role->users;
        $items    = Item::with('order.user')->get();
        $sectors=Sector::with('prices')->get();
        return view('htmx.htmxItems',compact('items','couriers','sectors'));
    }


    public function prices(){



    }


}
