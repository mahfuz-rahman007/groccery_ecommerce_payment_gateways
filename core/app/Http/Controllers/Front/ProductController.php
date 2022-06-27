<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function product_details($slug){

        $product = Product::where('slug', $slug)->first();

        return view('front.product-details', compact('product'));
    }

    public function cart()
    {
        if(Session::has('cart')){
            $cart = Session::get('cart');

        }else{
            $cart = [];
        }
        return view('front.cart', compact('cart'));
    }

    public function addToCart($id)
    {

        $cart = Session::get('cart');

        if(strpos($id, ',,,') == true){
            $data = explode(',,,', $id);

            $id = $data[0];
            $qty = $data[1];

            $product = Product::findOrFail($id);

            // chek if the product is out of stock or not
            if(!empty($cart) && array_key_exists($id, $cart)){
                if($product->stock < $cart[$id]['qty'] + $qty){
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            }else{
                if($product->stock < $qty){
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            }

            if(!$product){
                abort(404);
            }

            // if cart is empty then this is the first product
            if(!$cart){
                $cart = [
                    $id => [
                        "name" => $product->title,
                        "qty"  => $qty,
                        "price" => $product->current_price,
                        "photo" => $product->image,
                    ]
                ];

                Session::put('cart', $cart);
                return response()->json(['success' => 'Product Added To Cart Successfully']);
            }

            // if cart not empty then check this product if it already exist and increament the quntity
            if(isset($cart[$id])){
                $cart[$id]['qty'] += $qty;

                Session::put('cart', $cart);
                return response()->json(['success' => 'Product Added To Cart Successfully']);
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $product->title,
                "qty" => $qty,
                "price" => $product->current_price,
                "photo" => $product->image
            ];

        }else{

            $id = $id;
            $product = Product::findOrFail($id);

            if(!$product){
                abort(404);
            }

            // chek if the product is out of stock or not
            if(!empty($cart) && array_key_exists($id, $cart)){
                if($product->stock < $cart[$id]['qty'] + 1){
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            }else{
                if($product->stock < 1){
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            }

            // if cart is empty then this is the first product
            if(!$cart){
                $cart = [
                    $id => [
                        "name" => $product->title,
                        "qty"  => 1,
                        "price" => $product->current_price,
                        "photo" => $product->image,
                    ]
                ];

                Session::put('cart', $cart);
                return response()->json(['success' => 'Product Added To Cart Successfully']);
            }

            // if cart not empty then check this product if it already exist and increament the quntity to one
            if(isset($cart[$id])){
                $cart[$id]['qty'] ++;

                Session::put('cart', $cart);
                return response()->json(['success' => 'Product Added To Cart Successfully']);
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $product->title,
                "qty" => 1,
                "price" => $product->current_price,
                "photo" => $product->image
            ];

        }

        Session::put('cart', $cart);
        return response()->json(['message' => 'Product added to cart successfully!']);

    }

    public function updatecart(Request $request)
    {

        if(Session::has('cart')){
            $cart = Session::get('cart');
            foreach ($request->product_id as $key => $id) {
                $product = Product::findOrFail($id);
                if($product->stock < $request->product_quantity[$key]){

                    $notification = array(
                        'messege' => $product->title. ' stock not available!',
                        'alert' => 'danger'
                    );
                    return redirect()->back()->with('notification', $notification);
                }

                if(isset($cart[$id])){
                    $cart[$id]['qty'] = $request->product_quantity[$key];
                    Session::put('cart', $cart);
                }
            }


            $notification = array(
                'messege' => 'Cart Updated Successfully!',
                'alert' => 'success'
            );
            return redirect()->back()->with('notification', $notification);

        }
    }

    public function removecart($id)
    {

        if($id){

            $cart = Session::get('cart');
            if(isset($cart[$id])){
                unset($cart[$id]);
                Session::put('cart', $cart);
            }

            $count = 0;
            $total = 0;
            foreach ($cart as $i) {
                $count += $i['qty'];
                $total += $i['price'] * $i['qty'];
            }

            $total = round($total , 2);
            return response()->json(['message' => 'Cart Removed Successfully.', 'total' => $total, 'count' => $count]);

        }
    }

    public function checkout(){
        if(!Session::get('cart')){
            $notification = array(
                'messege' => 'ANo Product Added to cart',
                'alert' => 'warning'
            );
            return redirect(route('front.cart'))->with('notification', $notification);
        }

        $user = Auth::user();

        if($user){
            if(Session::has('cart')){
                $data['cart'] = Session::get('cart');

            }else{
                $data['cart'] = null;

            }
             return view('front.checkout', $data);

        }else{
            Session::put('link', url()->current());
            return redirect(route('user.login'));
        }
    }


}
