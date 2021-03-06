<?php

namespace App\Http\Controllers\Payment\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaystackController extends Controller
{
    public function store(Request $request){
        $notification = array(
            'messege' => 'Product Paystack payment successfully',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification',$notification);
    }
}
