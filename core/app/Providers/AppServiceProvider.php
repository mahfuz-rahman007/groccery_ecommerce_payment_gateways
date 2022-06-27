<?php

namespace App\Providers;

use App\Model\Admin;
use App\Model\Language;
use App\Model\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $adminprofile = Admin::first();

            $commonsetting = Setting::where('id', 1)->first();

            $lang = Language::where('is_default', '1')->first();
            $setting = Setting::where('language_id', $lang->id)->first();

            if (session()->has('lang')) {
                $currentLang = Language::where('code', session()->get('lang'))->first();

                $setting = Setting::where('language_id', $currentLang->id)->first();


                $view->with('setting', $setting);
                $view->with('currentLang', $currentLang);

            } else {
                $currentLang = Language::where('is_default', '1')->first();

                $setting = Setting::where('language_id', $currentLang->id)->first();


                $view->with('setting', $setting);
                $view->with('currentLang', $currentLang);

            }

            $langs = Language::all();
            if(Session::has('cart')){
                $cart = Session::get('cart');

            }else{
                $cart = [];
            }
            $cartTotal = 0;
            $countitem = 0;
            foreach ($cart as $pid => $item) {
                $countitem += $item['qty'];
                $cartTotal += (double)$item['price'] * (int)$item['qty'];
            }

            $view->with('langs', $langs);
            $view->with('lang', $lang);
            $view->with('commonsetting', $commonsetting);
            $view->with('cart', $cart);

            $view->with('countitem', $countitem);
            $view->with('cartTotal', $cartTotal);




            $view->with('adminprofile', $adminprofile);

        });
    }
}
