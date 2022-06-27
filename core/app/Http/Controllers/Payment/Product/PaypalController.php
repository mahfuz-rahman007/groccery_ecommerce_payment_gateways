<?php

namespace App\Http\Controllers\Payment\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function store(Request $request){
        dd($request->all());
        $notification = array(
            'messege' => 'Product Paypal payment successfully',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification',$notification);
    }
}
