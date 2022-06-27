<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Model\Pcategory;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products(){
        $products = Product::all();

        return view('admin.product.index', compact('products'));
    }

    public function add(){
        $pcategories = Pcategory::all();

        return view('admin.product.add', compact('pcategories'));
    }



    public function store(Request $request){

        $slug = Helper::make_slug($request->title);
        $products = Product::select('slug')->get();

        $request->validate([
            'pcategory_id' => 'required',
            'title' => [
                'required',
                'unique:products,title',
                'max:255',
                function($attribute, $value, $fail) use ($slug, $products){
                    foreach($products as $product){
                        if($product->slug == $slug){
                            return $fail('Title already taken!');
                        }
                    }
                }
            ],
            'description' => 'nullable|string',
            'short_description' => 'nullable',
            'current_price' => 'required|nullable',
            'previous_price' => 'nullable',
            'stock' => 'required',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'image' => 'required|mimes:jpeg,jpg,png',
            'status' => 'required',
        ]);


        $product = new Product();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'product_'.time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);
            $product->image = $image;
        }


        $product->stock = $request->stock;
        $product->pcategory_id = $request->pcategory_id;
        $product->title = $request->title;
        $product->slug = $slug;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->current_price = Helper::storePrice($request->current_price);
        $product->previous_price = Helper::storePrice($request->previous_price);
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        $product->status = $request->status;
        $product->save();

        $notification = array(
            'messege' => 'Product Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }

    public function delete($id){

        $product = Product::findOrFail($id);

        @unlink('assets/front/img/' . $product->image);
        $product->delete();

        return back();

    }

    public function edit($id){
        $pcategories = Pcategory::all();


        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product', 'pcategories'));

    }

    public function update(Request $request, $id){

        $slug = Helper::make_slug($request->title);
        $products = Product::select('slug')->get();
        $product = Product::findOrFail($id);

        $request->validate([
            'pcategory_id' => 'required',
            'title' => [
                'required',
                'max:255',
                function($attribute, $value, $fail) use ($slug, $products, $product){
                    foreach($products as $blg){
                        if($product->slug != $slug){
                            if($blg->slug == $slug){
                                return $fail('Title already taken!');
                            }
                        }
                    }
                },
                'unique:products,title,'.$id
            ],
            'description' => 'nullable|string',
            'short_description' => 'nullable',
            'current_price' => 'nullable',
            'previous_price' => 'nullable',
            'stock' => 'required',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'image' => 'mimes:jpeg,jpg,png',
            'status' => 'nullable|string|max:191',
        ]);



        if($request->hasFile('image')){
            @unlink('assets/front/img/'. $product->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'portfolio_'.time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);
            $product->image = $image;
        }

        $product->stock = $request->stock;
        $product->pcategory_id = $request->pcategory_id;
        $product->title = $request->title;
        $product->slug = $slug;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->current_price = Helper::storePrice($request->current_price);
        $product->previous_price = Helper::storePrice($request->previous_price);
        $product->status = $request->status;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        $product->save();


        $notification = array(
            'messege' => 'Product Updated successfully!',
            'alert' => 'success'
        );

        return redirect(route('admin.product'))->with('notification', $notification);

    }
}
