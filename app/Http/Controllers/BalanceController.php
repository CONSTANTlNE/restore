<?php

namespace App\Http\Controllers;
use App\Models\Balance;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class BalanceController extends Controller
{
    public function payments()
    {
        $transactions   = Balance::whereNotNull('transfer_date')->with('orders.user')->get();
        $customers      = Role::where('name', 'customer')->first()->users;

        return view('admin.payments', compact('transactions', 'customers'));
    }

    public function balance()
    {

        $customers = Role::where('name', 'customer')->first()->users;
        $orders = Order::with('user', 'items')->get();
        $balance   = Balance::groupBy('customer_id')
            ->selectRaw('customer_id, SUM(amount) as total_amount')
            ->get();
//        dd($balance);

        return view('admin.balance', compact('orders', 'customers', 'balance'));

    }


    public function payment(Request $request)
    {


        $payment                = new Balance();
        $payment->customer_id   = $request->customer;
        $payment->amount        = $request->amount;
        $payment->transfer_date = $request->date;
        $payment->bank       = $request->bank;
        $payment->save();

        return back();

    }


    public function paymentDelete(Request $request){

        $payment = Balance::where('id', $request->id)->first();
        $payment->delete();
        return back();
    }


    public function paymentUpdate(Request $request){

        $payment = Balance::where('id', $request->id)->first();
        $payment->customer_id   = $request->customer;
        $payment->amount        = $request->amount;
        $payment->transfer_date = $request->date;
        $payment->bank       = $request->bank;
        $payment->save();
        return back();
    }

    public function balanceDetails(Request $request, $id)
    {

        $transactions = Balance::with('orders',)->where('customer_id', $id)
            ->orderBy('created_at')
            ->get();
        $customer     = User::where('id', $id)->first();
//        dd($customer);
        $orders       = Order::where('customer_id', $id)
            ->orderBy('created_at')
            ->get();


        return view('admin.balance-detailed', compact('transactions', 'customer', 'orders'));
    }

}
