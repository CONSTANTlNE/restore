<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function balanceDetails(Request $request)
    {

        $transactions = Balance::with('orders',)->where('customer_id', auth()->user()->id)
            ->orderBy('created_at')
            ->get();

        $orders       = Order::where('customer_id', auth()->user()->id)
            ->orderBy('created_at')
            ->get();


        return view('user.balance-detailed', compact('transactions', 'orders'));
    }
}
