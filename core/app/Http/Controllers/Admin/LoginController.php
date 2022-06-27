<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(){
        return view('admin.login');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

         if(Auth::guard('admin')->attempt(['email' => $request->email , 'password' => $request->password])){
             return view('admin.dashboard');
         }
         return redirect()->back()->with('alert', 'Email or Password Doesnt Match');
    }


    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
      }

}
