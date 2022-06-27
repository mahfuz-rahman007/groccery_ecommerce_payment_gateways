<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Model\Pcategory;
use App\Model\Product;
use Illuminate\Http\Request;

class PcategoryController extends Controller
{

    public function pcategory(){
        $pcategories = Pcategory::all();

        return view('admin.product.pcategory.index', compact('pcategories'));
    }

    public function add(){
        return view('admin.product.pcategory.add');

    }

    public function store(Request $request)
    {
        $slug = Helper::make_slug($request->name);
        $pcategories = Pcategory::select('slug')->get();

        $request->validate([
            'name' => [
              'required',
              'unique:pcategories,name',
              'max:150',
              function($attribute, $value, $fail) use ($slug, $pcategories) {
                  foreach($pcategories as $pcategory) {
                    if ($pcategory->slug == $slug) {
                      return $fail('Name already taken!');
                    }
                  }
                }
            ],

        ]);


        $pcategory = new Pcategory();

        $pcategory->name         = $request->name;
        $pcategory->slug         = $slug;
        $pcategory->save();

        $notification = array(
            'messege' => 'Product Category Created successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }

    public function edit($id){
        $pcategory = Pcategory::where('id', $id)->first();

        return view('admin.product.pcategory.edit', compact('pcategory'));

    }

    public function update(Request $request, $id){

        $slug = Helper::make_slug($request->name);
        $pcategory = Pcategory::where('id', $id)->first();

        $pcategories = Pcategory::select('slug')->get();

        $request->validate([
            'name' => [
                'required',
                'max:150',
                function($attribute, $value, $fail) use ($slug, $pcategories, $pcategory) {
                    foreach($pcategories as $pcate) {
                      if ($pcategory->slug != $slug) {
                        if ($pcate->slug == $slug) {
                          return $fail('Title already taken!');
                        }
                      }
                    }
                  },
                  'unique:pcategories,name,'.$id
              ],
        ]);



        $pcategory->name         = $request->name;
        $pcategory->slug         = $slug;
        $pcategory->save();

        $notification = array(
            'messege' => 'Product Category Updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function delete(Request $request, $id){
        $pcategory = Pcategory::where('id', $id)->first();

        $pcategory->delete();

        $notification = array(
            'messege' => 'Product Category Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }


}
