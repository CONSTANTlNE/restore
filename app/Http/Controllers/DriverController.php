<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sector;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function index()
    {

        $items    = Item::with('order.user')
            ->where('driver_id',auth()->user()->id)
            ->where('status',0)
            ->get();
        $sectors=Sector::with('prices')->get();


        return view('driver.currentAssignments',compact('items','sectors'));
    }


    public function finish(Request $request){

        $item=Item::find($request->id);
        $item->status=1;
        $item->delivered_at=now();
        $item->save();
        return back();
    }

    public function finishRemove(Request $request){

        $item=Item::find($request->id);
        $item->status=0;
        $item->delivered_at=null;
        $item->save();
        return back();
    }

    public function finished()
    {

        $items = Item::with('order.user')
            ->where('driver_id',auth()->user()->id)
            ->where('status',1)
            ->get();
        $sectors=Sector::with('prices')->get();

        return view('driver.finished',compact('items','sectors'));

    }


    public function makeComment(Request $request){

        $item=Item::find($request->id);
        $item->driver_comment=$request->driver_comment;
        $item->save();
        return back();
    }


    public function editComment(Request $request){

        $item=Item::find($request->id);
        $item->driver_comment=$request->driver_comment;
        $item->save();
        return back();
    }
}

