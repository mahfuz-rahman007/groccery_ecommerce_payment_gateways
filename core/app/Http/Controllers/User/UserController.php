<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {

        return view('user.dashboard');
    }



    public function editProfile()
    {
        return view('user.editprofile');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $request->validate([
            'photo' => 'mimes:jpeg,jpg,png',
            'name' => 'required:string|max:60',
            'phone' => 'required|numeric',
            'zipcode' => 'required|numeric',
            'address' => 'required|max:150',
            'country' => 'required|max:50',
            'city' => 'required|max:50',
            'email' => 'required|max:50',
        ]);

        if ($request->hasFile('photo')) {
            @unlink('assets/front/img/' . $user->photo);
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $photo = time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $photo);

            $user->photo = $photo;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->zipcode = $request->zipcode;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->email = $request->email;
        $user->save();

        $notification = array(
            'messege' => 'Profile updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function change_password()
    {
        return view('user.change-password');
    }

    public function update_password(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $messages = [
            'password.required' => 'The new password field is required',
            'password.confirmed' => "Password does'nt match"
        ];
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ], $messages);

        if (Hash::check($request->old_password, $user->password)) {
            $oldPassMatch = 'matched';
        } else {
            $oldPassMatch = 'not_matched';
        }
        if ($validator->fails() || $oldPassMatch == 'not_matched') {
            if ($oldPassMatch == 'not_matched') {
                $validator->errors()->add('oldPassMatch', true);
            }
            return redirect()->route('user.change.password')
                ->withErrors($validator);
        }


        $user->password = bcrypt($request->password);
        $user->save();


        $notification = array(
            'messege' => 'User password updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }
}
