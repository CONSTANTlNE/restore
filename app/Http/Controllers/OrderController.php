<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Sector;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){

        $sectors=Sector::with('prices')->get();
        $jsonSectors=json_encode($sectors);

        return view('user.customer',compact('jsonSectors'));
    }

    public function store(Request $request)
    {

        $order = Order::create([
            'customer_id' => auth()->user()->id,
            'order'=>$request->orderId,
            'sum_value'=>$request->sum_value
        ]);

        $dataLength = count($request['package-id']);

        for ($i = 0; $i < $dataLength; $i++) {
            $item = new Item();
            $item->order_id=$order->id;
            $item->package_id = $request['package-id'][$i];
            $item->description = $request['package-descr'][$i];
            $item->weight = $request['weight'][$i];
            $item->length = $request['length'][$i];
            $item->width = $request['width'][$i];
            $item->height = $request['height'][$i];
            $item->receiver = $request['recipient'][$i];
            $item->receiver_phone= $request['recipient-mobile'][$i];
            $item->receiver_address = $request['recipient-address'][$i];
            $item->customer_comment = $request['comment'][$i];
            $item->save();
        }


    return back();


    }
}
