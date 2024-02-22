<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Item;
use App\Models\Order;
use App\Models\Sector;
use App\Models\ServicePrice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $sectors     = Sector::with([
            'prices' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])->get();
        $jsonSectors = json_encode($sectors);
        $orders      = Order::with('items')->withCount(['items as item_count'])->where('customer_id',
            auth()->user()->id)->with('items')->get();
        $balance     = Balance::where('customer_id', auth()->user()->id)
            ->selectRaw('SUM(amount) as total_amount')
            ->first();

        return view('user.customer', compact('jsonSectors', 'orders', 'sectors', 'balance'));
    }

    public function items()
    {
        $sectors = Sector::with('prices')->get();
//        $sectorArray=$sectors->toArray();
        $orders = Order::where('customer_id', auth()->user()->id)->with('items')->get();

        return view('user.packages-detailed', compact('orders', 'sectors'));
    }

    public function store(Request $request)
    {

//        dd($request);

        $order = Order::create([
            'customer_id' => auth()->user()->id,
            'order'       => $request->orderId,
            'sum_value'   => $request->sum_value2
        ]);

        $balance              = new Balance();
        $balance->customer_id = auth()->user()->id;
        $balance->order_id    = $order->id;
        $balance->amount      = -$order->sum_value;
        $order->balance()->save($balance);


        $dataLength = count($request['package-id']);

        for ($i = 0; $i < $dataLength; $i++) {
            $splitable              = $request['sector'][$i];
            $split                  = explode('-', $splitable);
            $price                  = (int) $split[0];
            $sectorid               = (int) $split[1];
            $item                   = new Item();
            $item->order_id         = $order->id;
            $item->package_id       = $request['package-id'][$i];
            $item->description      = $request['package-descr'][$i];
            $item->item_value       = $request['package_value'][$i];
            $item->weight           = $request['weight'][$i];
            $item->length           = $request['length'][$i];
            $item->width            = $request['width'][$i];
            $item->height           = $request['height'][$i];
            $item->delivery_price   = $price;
            $item->sector_id        = $sectorid;
            $item->receiver         = $request['recipient'][$i];
            $item->receiver_phone   = $request['recipient-mobile'][$i];
            $item->receiver_address = $request['recipient-address'][$i];
            $item->customer_comment = $request['comment'][$i];
            $item->save();
        }


        return back();
    }


    public function orderEdit(Request $request, $id)
    {


        $sectors = Sector::with('prices')->get();
        $order   = Order::with('items')->find($id);

        return view('user.edit-order', compact('order', 'sectors'));
    }

    public function orderUpdate(Request $request)
    {
        dd($request);

        // Update order
        $order = Order::find($request->order_id)->with('items')->first();
//        dd($order);
        $order->order = $request->orderId;
        $order->sum_value = $request->sum_value2;
        $order->save();



        // Update balance
        $balance         = Balance::where('order_id', $request->order_id)->first();
        $balance->amount = -$request->sum_value2;
        $balance->save();


        // Update items
        $dataLength = count($request['package-id']);

        for ($i = 0; $i < $dataLength; $i++) {
            $splitable              = $request['sector'][$i];
            $split                  = explode('-', $splitable);
            $price                  = (int) $split[0];
            $sectorid               = (int) $split[1];
            $item                   = $order->items[$i];
            $item->order_id         = $request->order_id;
            $item->package_id       = $request['package-id'][$i];
            $item->description      = $request['package-descr'][$i];
            $item->item_value       = $request['package_value'][$i];
            $item->weight           = $request['weight'][$i];
            $item->length           = $request['length'][$i];
            $item->width            = $request['width'][$i];
            $item->height           = $request['height'][$i];
            $item->delivery_price   = $price;
            $item->sector_id        = $sectorid;
            $item->receiver         = $request['recipient'][$i];
            $item->receiver_phone   = $request['recipient-mobile'][$i];
            $item->receiver_address = $request['recipient-address'][$i];
            $item->customer_comment = $request['comment'][$i];
            $item->save();


        }

        return redirect()->route('customer-index');
    }

    public function itemDeleteCustomer(Request $request){

        $item=Item::find($request->id);
        $balance= Balance::where('order_id', $request->order_id)->first();
        $balance->amount+=$item->delivery_price;
        $balance->save();
        $order=Order::where('id',$request->order_id)->first();
        $order->sum_value-=$item->delivery_price;
        $order->save();


        $item->delete();

        return back();
    }

    public function updateItem(Request $request)
    {

        $item  = Item::find($request->id);
        $order = Order::find($request->order_id);


        $newItemPrice = ServicePrice::where('sector_id', $request->sector)
            ->orderBy('created_at', 'desc')
            ->pluck('price')
            ->first();
        $oldItemPrice = $item->delivery_price;

        $difference = $newItemPrice - $oldItemPrice;

        $order->sum_value += $difference;
        $order->save();

        $balance         = Balance::where('order_id', $request->order_id)->first();
        $balance->amount = -$order->sum_value;
        $balance->save();


        $item->delivery_price   = $newItemPrice;
        $item->package_id       = $request->package_id;
        $item->description      = $request->package_descr;
        $item->item_value       = $request->package_value;
        $item->weight           = $request->weight;
        $item->length           = $request->length;
        $item->width            = $request->width;
        $item->height           = $request->height;
        $item->receiver         = $request->recipient;
        $item->receiver_phone   = $request->recipient_mobile;
        $item->receiver_address = $request->recipient_address;
        $item->customer_comment = $request->comment;
        $item->sector_id        = $request->sector;
        $item->save();

        return back();


    }

    public function deleteOrder(Request $request)
    {


        $order = Order::find($request->id);
        $order->delete();

        return back();

    }

    public function deleteItem(Request $request)
    {

        $order = Order::find($request->order_id);
        if ($order && $order->items()->count() >= 2) {
            $item = Item::find($request->id);
            $item->delete();

            return back();
        } else {
            return back()->with('error_item', 'ბოლო ამანათის წასაშლელად გთხოვთ წაშალოთ მთლიანი შეკვეთა');
        }
    }

    public function editItem(Request $request)
    {

        $responses = Http::pool(fn($client) => [
            $client->get('https://api.novaposhta.ua/v2.0/json/Address/getWarehouses'),
            $client->get('https://api.novaposhta.ua/v2.0/json/Address/getWarehouses'),
            $client->get('https://api.novaposhta.ua/v2.0/json/Address/getWarehouses'),
        ]);

        return $responses[0]->ok && $responses[1]->ok && $responses[2]->ok;
    }


}
