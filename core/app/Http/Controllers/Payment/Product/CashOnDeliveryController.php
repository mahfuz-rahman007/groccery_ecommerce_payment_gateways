<?php

namespace App\Http\Controllers\Payment\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CashOnDeliveryController extends Controller
{
    public function store(Request $request){
        $notification = array(
            'messege' => 'Product will be on Cash on Delivery',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification',$notification);
    }
}
