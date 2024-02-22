<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomRedirectController extends Controller
{
    public function index(){

        if(auth()->user()->hasRole('customer')){

            return redirect()->route('customer-index');

        }else if(auth()->user()->hasRole('driver')){

            return redirect()->route('driver-index');

        }

        return redirect()->route('admin-main');
    }
}
