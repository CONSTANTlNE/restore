<?php

namespace App\Http\Controllers;

use App\Models\Balance;
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
        $orders = Order::with('user','items')->get();
        $balance = Balance::selectRaw('customer_id, SUM(amount) as total_amount')
            ->groupBy('customer_id')
            ->get();

        return view('admin.orders', compact('orders', 'balance'));


    }

    public function itemsAdmin(){

        $role     = Role::where('name', 'driver')->first();
        $couriers = $role->users;
        $items    = Item::with('order.user')->get();
        $sectors=Sector::with('prices')->get();



        return view('admin.items',compact('items','couriers','sectors'));
    }

    public function newPrice(Request $request){

       ServicePrice::create([
           'sector_id' => $request->sector,
           'price' => $request->price
       ]);

       return back();
    }


    public function orderDetails(Request $request,$id){


        $role     = Role::where('name', 'driver')->first();
        $couriers = $role->users;
        $items    = Item::with('order.user')->where('order_id',$id)->get();
        $status=Order::where('id',$id)->pluck('status')->first();
        $sectors=Sector::with('prices')->get();

        return view('admin.order-details',compact('items','couriers','status','sectors'))->with('id',$id);
    }


    public function orderConfirm(Request $request){


        $order = Order::find($request->id);
        $order->status = 1;
        $order->save();

        $balance         = Balance::where('order_id', $request->order_id)->first();
        $balance->amount = -$order->sum_value;
        $balance->save();

        return back()->with('status',$order->status);

    }


    public function settings(){

        $sectors=Sector::with('prices')->get();

        return view('admin.settings',compact('sectors'));
    }

    public function addSector(Request $request){

        $request->validate([
            'sector_name' => 'required|string|max:255',
            'sector_address' => 'required|string|max:255',
            'sector_price' => 'required|numeric|min:0',
        ]);

        $sector = Sector::create([
            'name' => $request->sector_name,
            'address' => $request->sector_address
        ]);

        $price = ServicePrice::create([
            'price' => $request->sector_price
        ]);

        $sector->prices()->save($price);

//        $sector=new Sector();
//        $sector->name=$request->sector_name;
//        $sector->address=$request->sector_address;
//        $sector->save();
//
//        $price=new ServicePrice();
//        $price->price=$request->sector_price;
//
//        $sector->prices()->save($price);

        return back();

    }


    public function sectorUpdate(Request $request)
    {
        // Fetch the Sector from the DB
        $sector = Sector::find($request->id);

        if($sector) {
            //Now we update the properties
            if($request->has('name')) {
                $sector->name = $request->get('sector_name');
            }

            if($request->has('address')) {
                $sector->address = $request->get('sector_address');
            }

            // Save to apply the changes to the database
            $sector->save();

            return response()->json(['status' => 'success', 'message' => 'Sector updated successfully'], 200);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Sector not found'], 404);
        }
    }


    public function users()
    {

        $users = User::all();
        $roles = Role::all();

        return view('admin.users', compact('roles', 'users'));
    }

    public function newUser(Request $request)
    {

//        dd($request->all());

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


    public function updateUser(Request $request){

        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;

        $user->ident_no=$request->id_number;
        $user->legal_form=$request->legal_form;
        $user->company_name=$request->company_name;
        $user->mobile1=$request->mobile1;
        $user->mobile2=$request->mobile2;
        $user->save();

        return back();
    }

    public  function deleteUser(Request $request){

        $user=User::find($request->id);
        $user->delete();

        return back();
    }


    public  function updatePassword(Request $request){

        $user=User::find($request->id);
        $user->password=$request->password;
        $user->save();

        return back();
    }


    public function assigments(Request $request)
    {

        $package = Item::where('id', $request->package)->first();
        $package->driver_id =$request->courier;
        $package->save();

        return back();
    }

    public function activateUser(Request $request){

        $user=User::find($request->id);
        $user->active=1;
        $user->save();

        return back();

    }


    public function deactivateUser(Request $request){

        $user=User::find($request->id);
        $user->active=0;
        $user->save();
        return back();

    }

}
