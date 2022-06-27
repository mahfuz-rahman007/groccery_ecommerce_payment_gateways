<?php

namespace App\Http\Controllers\Payment\Product;

use App\Model\Order;
use App\Model\Product;
use App\Helpers\Helper;
use App\Model\Shipping;
use App\Model\Emailsetting;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\PaymentGatewey;
use Barryvdh\DomPDF\Facade as PDF;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\MissingParameterException;

class StripeController extends Controller
{

    public function __construct()
    {
        $data = PaymentGatewey::whereKeyword('stripe')->first();
        $paydata = $data->convertAutoData();
        Config::set('services.stripe.key',  $paydata['key']);
        Config::set('services.stripe.secret', $paydata['secret']);
    }


    public function store(Request $request)
    {

        $success_url = action('Payment\Product\PaypalController@payreturn');


        if (!Session::has('cart')) {
            return view('errors.404');
        }

        $cart = Session::get('cart');

        $cart_total = 0;

        foreach ($cart as $id => $item) {

            $product = Product::findOrFail($id);

            if ($product->stock < $item['qty']) {
                $notification = array(
                    'messege' =>  $product->title . ' stock not available',
                    'alert' => 'error'
                );
                return redirect()->back()->with('notification', $notification);
            }

            $cart_total += (float)$item['price'] * (int)$item['qty'];
        }

        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required',
            'billing_number' => 'required',
            'billing_address' => 'required',
            'billing_country' => 'required',
            'billing_state' => 'required',

            'card_number' => 'required',
            'cvc' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        $stripe = Stripe::make(Config::get('services.stripe.secret'));

        try {

            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->month,
                    'exp_year' => $request->year,
                    'cvc' => $request->cvc,
                ],
            ]);

            if (!isset($token['id'])) {
                return back()->with('error', 'Token Problem With Your Token.');
            }

            $input = $request->all();

            $charge = Shipping::findOrFail($request->shipping_charge);

            $input['shipping_charge'] = json_encode($charge, true);

            $new_shipping_charge = json_decode($input['shipping_charge'], true);

            $final_shipping_charge = $new_shipping_charge['cost'];

            $total = $cart_total + $final_shipping_charge;

            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => Helper::showCurrencyCode(),
                'amount' =>  $total,
                'description' => 'Product Order',
            ]);

            if ($charge['status'] == 'succeeded') {

                $order = new Order();

                $order['txn_id'] = $charge['balance_transaction'];
                $order['cart'] = json_encode($cart, true);
                $user = Auth::user();
                $order['user_info'] = json_encode($user, true);
                $order['user_id'] = $user->id;
                $order['method'] = 'Stripe';
                $order['order_number'] = Str::random(8);
                $order['payment_status'] = 1;
                $order['order_status'] = 0;
                $order['shipping_charge_info'] = $input['shipping_charge'];
                $order['total'] = $total;
                $order['qty'] = count($cart);

                $order['currency_name'] = $input['currency_code'];
                $order['currency_sign'] =  $input['currency_sign'];
                $order['currency_value'] =  $input['currency_value'];

                $order['billing_name'] =  $input['billing_name'];
                $order['billing_email'] =  $input['billing_email'];
                $order['billing_number'] =  $input['billing_number'];
                $order['billing_address'] =  $input['billing_address'];
                $order['billing_country'] =  $input['billing_country'];
                $order['billing_state'] =  $input['billing_state'];
                $order['billing_zip'] =  $input['billing_zip_code'];
                $order['billing_state'] =  $input['billing_state'];

                $order->save();

                $order_id = $order->id;

                foreach ($cart as $id => $item) {
                    $product = Product::findOrFail($id);
                    $stock = $product->stock - $item['qty'];
                    Product::where('id', $id)->update([
                        'stock' => $stock
                    ]);
                }

                $fileName = Str::random(4) . time() . '.pdf';
                $path = 'assets/front/invoices/product/' . $fileName;
                $data['order']  = $order;
                $pdf = PDF::loadView('pdf.product', $data)->save($path);


                Order::where('id', $order_id)->update([
                    'invoice_number' => $fileName
                ]);

                // Send Mail to Buyer
                $mail = new PHPMailer(true);
                $user = Auth::user();

                $em = Emailsetting::first();

                if ($em->is_smtp == 1) {
                    try {

                        $mail->isSMTP();
                        $mail->Host       = $em->smtp_host;
                        $mail->SMTPAuth   = true;
                        $mail->Username   = $em->smtp_user;
                        $mail->Password   = $em->smtp_pass;
                        $mail->SMTPSecure = $em->email_encryption;
                        $mail->Port       = $em->smtp_port;

                        //Recipients
                        $mail->setFrom($em->from_email, $em->from_name);
                        $mail->addAddress($user->email, $user->name);

                        // Attachments
                        $mail->addAttachment('assets/front/invoices/product/' . $fileName);

                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = "Order placed for Product";
                        $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your order has been placed successfully. We have attached an invoice in this mail.<br/>Thank you.';

                        $mail->send();
                    } catch (Exception $e) {
                        // die($e->getMessage());
                    }
                } else {
                    try {

                        //Recipients
                        $mail->setFrom($em->from_mail, $em->from_name);
                        $mail->addAddress($user->email, $user->name);

                        // Attachments
                        $mail->addAttachment('assets/front/invoices/product/' . $fileName);

                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = "Order placed for Product";
                        $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your order has been placed successfully. We have attached an invoice in this mail.<br/>Thank you.';

                        $mail->send();
                    } catch (Exception $e) {
                        // die($e->getMessage());
                    }
                }

                Session::forget('cart');
                return redirect($success_url);

            }


        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return back()->with('warning', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return back()->with('warning', $e->getMessage());
        }

        return back()->with('warning', 'Please Enter Valid Credit Card Informations.');
    }
}
