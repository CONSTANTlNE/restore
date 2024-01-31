<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomRedirectController extends Controller
{
    public function index(){

        if(auth()->user()->hasRole('customer')){

            return redirect()->route('customer-index');

        }elseif(auth()->user()->hasRole('driver')){

            return redirect()->route('driver-index');


        }

        return redirect()->route('admin-main');
    }
}
