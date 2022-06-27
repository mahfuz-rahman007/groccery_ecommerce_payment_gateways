<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Language;
use App\Model\Pcategory;
use App\Model\Product;
use App\Model\Slider;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request){
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $sliders = Slider::where('status', 1)->limit(2)->get();

        $category = $request->category;
        $catid = null;
        if(!empty($category)){
            $data['category'] = Pcategory::where('slug', $category)->firstOrFail();
            $catid = $data['category']->id;
        }

        $term = $request->term;

        $pcategories = Pcategory::orderBy('id', 'DESC')->get();
        

        $products = Product::where('status', 1)
        ->when($catid, function($query , $catid){
            return $query->where('pcategory_id', $catid);
        })
        ->when($term , function($query , $term){
            return $query->where('title','like','%'.$term.'%');
        })
        ->orderBy('id', 'DESC')->get();



        return view('front.index', compact('sliders', 'pcategories', 'products'));
    }

    public function changeLang($lang)
    {
        session()->put('lang', $lang);
        app()->setLocale($lang);

        return redirect()->route('front.index');
    }
}
