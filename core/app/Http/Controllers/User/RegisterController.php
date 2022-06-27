<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Emailsetting;
use App\Model\Language;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class RegisterController extends Controller
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

    public function register()
    {
        return view('user.register');
    }

    public function registerSubmit(Request $request){
        $emailsetting = Emailsetting::first();

        $request->validate([
            'name' => 'required:string|max:90',
            'username' => 'required:string|max:25|unique:users,username',
            'email'=> 'required|email|unique:users',
            'phone'=> 'required|numeric',
            'zipcode'=> 'required|numeric',
            'address'=> 'required|max:250',
            'country'=> 'required|max:100',
            'city'=> 'required|max:80',
            'password' => 'required|min:8|confirmed',
        ]);


            $user = new User();

            $user->username = $request->username;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->zipcode = $request->zipcode;
            $user->address = $request->address;
            $user->country = $request->country;
            $user->city = $request->city;
            $user->password = bcrypt($request->password);
            $token = md5(time().$request->username.$request->email);
            $user->email_verify_token = $token ;
            $user->save();

            $mail = new PHPMailer(true);

            if($emailsetting->is_verification_email == 1)
            {
                $to = $request->email;
                $subject = 'Verify your email address.';
                $msg = "Dear Customer,<br> We noticed that you need to verify your email address. <a href=".route('user.register.token',$token).">Simply click here to verify. </a>";


                if($emailsetting->is_smtp == 1){

                    try {
                        $mail->isSMTP();
                        $mail->Host       = $emailsetting->smtp_host;
                        $mail->SMTPAuth   = true;
                        $mail->Username   = $emailsetting->smtp_user;
                        $mail->Password   = $emailsetting->smtp_pass;
                        $mail->SMTPSecure = $emailsetting->email_encryption;
                        $mail->Port       = $emailsetting->smtp_port;

                        //Recipients
                        $mail->setFrom($emailsetting->from_email, $emailsetting->from_name);
                        $mail->addAddress($to);

                        // Content
                        $mail->isHTML(true);
                        $mail->Subject =  $subject;
                        $mail->Body    =  $msg;

                        $mail->send();
                    } catch (Exception $e) {
                        // die($e->getMessage());
                    }

                    return redirect(route('user.login'))->with('success',__('We need to verify your email address. We have sent an email to'). ' '.$to. ' '  .__('to verify your email address. Please click link in that email to continue.'));
                }else{
                    $notification = array(
                        'messege' => 'Successfully Registered',
                        'alert' => 'success'
                    );
                    return redirect(route('user.login'))->with('notification', $notification);
                }

            }

    }


    public function token($token)
    {


        $emailsetting = Emailsetting::first();

        if ($emailsetting->is_verification_email == 1) {
            $user = User::where('email_verify_token', $token)->first();
            if (isset($user)) {
                $user->email_verified = 'Yes';
                $user->update();
                Auth::guard('web')->login($user);

                $notification = array(
                    'messege' => 'Email Verified Successfully',
                    'alert' => 'success'
                );
                return redirect(route('user.dashboard'))->with('notification', $notification);
            }
        } else {
            return redirect()->back();
        }
    }
}
