<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public $lang_id;
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }
        $this->lang_id = $currlang->id;
    }

    public function login (){
        $url = url()->previous();
        $url = explode('/', $url);
        if(in_array('chekout', $url)){
            session(['link' => url()->previous() ]);
        }

        return view('user.login');
    }

    public function loginSubmit(Request $request){

        if(Session::has('link')){
            $redirectUrl = Session::get('link');
            Session::forget('link');
        }else{
            $redirectUrl = route('user.dashboard');
        }

        $request->validate([
            'email'  => 'required|email',
            'password' => 'required'
        ]);

                // Attempt to log the user in
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location

            // Check If Email is verified or not
            if (Auth::guard('web')->user()->email_verified == 'NO') {
                Auth::guard('web')->logout();
                return back()->with('error', __('Your Email is not Verified!'));
            }

            if (Auth::guard('web')->user()->status == '0') {
                Auth::guard('web')->logout();
                return back()->with('error', __('Your account has been banned'));
            }

            return redirect($redirectUrl);
        }
        return back()->with('error', __("Credentials Doesn't Match !"));
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }


}
