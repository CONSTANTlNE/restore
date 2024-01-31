<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Sector;
use App\Models\ServicePrice;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{


    public function index(Request $request)
    {

        $role     = Role::where('name', 'driver')->first();
        $couriers = $role->users;
        $items    = Item::with('order.user')->get();

        return view('admin.items', compact('items', 'couriers'));
    }

    public function orders(){


        $orders = Order::with('user','items')->get();
        return view('admin.orders',compact('orders'));
    }

    public function settings(){

        $sectors=Sector::with('prices')->get();

        return view('admin.settings',compact('sectors'));
    }

    public function addSector(Request $request){

        $sector=new Sector();
        $sector->name=$request->sector_name;
        $sector->address=$request->sector_address;
        $sector->save();

        $price=new ServicePrice();
        $price->price=$request->sector_price;

        $sector->prices()->save($price);

        return back();

    }

    public function ajaxOrders()
    {

        $items = Item::with('order.user')->get();

        return response()->json($items);
    }

    public function users()
    {

        $users = User::all();
        $roles = Role::all();

        return view('admin.users', compact('roles', 'users'));
    }

    public function newUser(Request $request)
    {

        dd($request->all());

        $user               = new User;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = $request->password;
        $user->ident_no     = $request->id_number;
        $user->legal_form   = $request->legal_form;
        $user->company_name = $request->company_name;
        $user->mobile1      = $request->tel - 1;
        $user->mobile2      = $request->tel - 2;
        $user->save();
        $user->assignRole($request->role);

        return view('admin.newUser');

    }

    public function assigments(Request $request)
    {
//dd($request);
        $package = Item::where('id', $request->package)->first();
        $package->driver_id =$request->courier;
        $package->save();

        return back();
    }

}
