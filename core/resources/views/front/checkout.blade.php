@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

    <!--Main Breadcrumb Area Start -->
    <div class="main-breadcrumb-area"
        style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="pagetitle">
                        {{ __('Checkout') }}
                    </h1>
                    <ul class="pages">
                        <li>
                            <a href="{{ route('front.index') }}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                                {{ __('Checkout') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--Main Breadcrumb Area End -->

    <form action="javascript:;" id="payment_gateway_check" method="POST">
        <div class="checkout-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 order-2">
                        <div class="card mb-5">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-3">{{ __('Your Cart') }}</h4>
                            </div>
                            <div class="card-body p-0">
                                @php
                                    $countTotal = 0;
                                    $cartTotal = 0;
                                    if ($cart) {
                                        foreach ($cart as $p) {
                                            $cartTotal += (float) $p['price'] * (int) $p['qty'];
                                            $countTotal += $p['qty'];
                                        }
                                    }
                                @endphp
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                                <tr>
                                                    <th>
                                                        <img width="50px" height="50px"
                                                            src="{{ asset('assets/front/img/' . $item['photo']) }}"
                                                            alt="">
                                                    </th>
                                                    <th>
                                                        {{ $item['name'] }}
                                                    </th>
                                                    <th>
                                                        {{ Helper::showCurrencyPrice($item['price']) }} *
                                                        {{ $item['qty'] }} =
                                                        {{ Helper::showCurrencyPrice($item['price'] * $item['qty']) }}
                                                    </th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-5">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-3">{{ __('Shipping Methods') }}</h4>
                            </div>
                            <div class="card-body p-0">
                                @php
                                    $shipping_methods = App\Model\Shipping::where('status', 1)->orderBy('id','DESC')->get();
                                @endphp
                                @if(count($shipping_methods) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Method</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shipping_methods as $method)
                                            <tr>
                                                <td>
                                                    <input type="radio"  @if ($method->cost == '0') checked @endif  name="shipping_charge" data="{{ Helper::showPrice($method->cost) }}" class="shipping-charge"
                                                      value="{{ $method->id }}">
                                                  </td>
                                                  <td>
                                                    <p class="m-0"><strong>{{ $method->title }} (<span>{{ Helper::showCurrencyPrice($method->cost) }}</span>)</strong></p>
                                                    <p  class="m-0"><small>{{ $method->subtitle }}</small></p>
                                                  </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-3">{{ __('Cart Summery') }}</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="33.3%">{{ __('Subtotal') }}</th>
                                            <td>{{ Helper::showCurrencyPrice($cartTotal) }}</td>
                                        </tr>
                                        @if(count($shipping_methods) > 0)
                                        @php
                                            $shipping_cost = 0;
                                        @endphp
                                        <tr>
                                            <th width="33.3%">{{ __('Shipping Cost') }}</th>
                                            <td>+ <span>{{ Helper::showCurrency() }}</span><span class="shipping_cost">{{ $shipping_cost }}</span> </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th width="33.3%">{{ __('Total') }}</th>
                                            <td><span>{{ Helper::showCurrency() }}</span><span class="grand_total" data="{{ Helper::showPrice($cartTotal) }}">{{ Helper::showPrice($cartTotal + $shipping_cost) }}</span> </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 order-1">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-3">{{ __('Billing Address') }}</h4>
                            </div>
                            <div class="card-body">
                                @php
                                    $user = Auth::user();
                                @endphp
                                <div class="mb-3">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="billing_name"
                                        value="{{ $user->name }}" placeholder="{{ __('Name') }}">
                                    @if ($errors->has('billing_name'))
                                        <p class="text-danger"> {{ $errors->first('billing_name') }} </p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="address">{{ __('Address') }}</label>
                                    <input type="text" class="form-control" name="billing_address"
                                        value="{{ $user->address }}" id="address" placeholder="{{ __('Address') }}">
                                    @if ($errors->has('billing_address'))
                                        <p class="text-danger"> {{ $errors->first('billing_address') }} </p>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input type="text" class="form-control" name="billing_email"
                                            value="{{ $user->email }}" id="email" placeholder="{{ __('Email') }}"
                                            value="">
                                        @if ($errors->has('billing_email'))
                                            <p class="text-danger"> {{ $errors->first('billing_email') }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="number">{{ __('Phone Number') }}</label>
                                        <input type="text" class="form-control" id="number"
                                            value="{{ $user->phone }}" name="billing_number"
                                            placeholder="{{ __('Phone Number') }}" value="">
                                        @if ($errors->has('billing_number'))
                                            <p class="text-danger"> {{ $errors->first('billing_number') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label for="country">{{ __('Country') }}</label>
                                        <input type="text" class="form-control" name="billing_country"
                                            value="{{ $user->country }}" id="country"
                                            placeholder="{{ __('Country') }}">
                                        @if ($errors->has('billing_country'))
                                            <p class="text-danger"> {{ $errors->first('billing_country') }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="billing_state"
                                            value="{{ $user->state }}" id="state" placeholder="State">
                                        @if ($errors->has('billing_state'))
                                            <p class="text-danger"> {{ $errors->first('billing_state') }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="zip-code">{{ __('Zip Code') }}</label>
                                        <input type="text" class="form-control" name="billing_zip_code"
                                            value="{{ $user->zipcode }}" id="zip-code" placeholder="Zip Code">
                                        @if ($errors->has('billing_zip_code'))
                                            <p class="text-danger"> {{ $errors->first('billing_zip_code') }} </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @csrf
                        <div class="card mt-5">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-3">{{ __('Select Payment Gateway') }}</h4>
                            </div>

                            <div class="card-body p-0">
                                <div class="payment-gateway">
                                    <ul class="p-0 mt-3">
                                        @php
                                            $payment_gateways = App\Model\PaymentGatewey::where('status', 1)->get();
                                        @endphp
                                        @foreach ($payment_gateways as $gateway)
                                        <li class="product_payment_gateway_check" data-href="{{ $gateway->id }}" id="{{ $gateway->type == 'automatic' ? $gateway->title : $gateway->title }}">
                                            <img src="{{ asset('assets/front/img/'.$gateway->image) }}" title="{{ $gateway->id }}" id="{{ $gateway->type == 'automatic' ? $gateway->title : $gateway->title }}" alt="">
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="payment_show_check d-none mt-3 mb-3">
                            <div class="row">

                              <div class="col-md-6 mb-3">
                                <label for="cc-number">{{ __('Credit Card Number') }}</label>
                                <input type="text" class="form-control" name="card_number" value="" id="cc-number" placeholder="{{ __('Credit Card Number') }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label for="cc-month">{{ __('Month') }}</label>
                                <input type="text" class="form-control" name="month" value="" id="cc-month" placeholder="{{ __('Month') }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label for="cc-expiration">{{ __('Expaire Year') }}</label>
                                  <input type="text" class="form-control" name="year" value="" id="cc-expiration" placeholder="{{ __('Expaire') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="cc-cvv">{{ __('CVC') }}</label>
                                  <input type="text" class="form-control" name="cvc" value="" id="cc-cvv" placeholder="{{ __('CVC') }}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="" id="payment_gateway" name="payment_gateway" value="payment_gateway">
                        <input type="hidden" name="currency_code" value="{{ Helper::showCurrencyCode() }}">
                        <input type="hidden" name="currency_sign" value="{{ Helper::showCurrency() }}">
                        <input type="hidden" name="currency_value" value="{{ Helper::showCurrencyValue() }}">

                        <button type="submit" class="btn btn-primary btn-lg pr-5 pl-5 pt-3 pb-3">Place Order</button>

                    </div>


                </div>
            </div>
        </div>
    </form>
    <input type="hidden" id="product_paypal" value="{{route('product.paypal.submit')}}">
    <input type="hidden" id="product_stripe" value="{{route('product.stripe.submit')}}">
    <input type="hidden" id="product_paytm" value="{{route('product.paytm.submit')}}">
    <input type="hidden" id="product_paystack" value="{{route('product.paystack.submit')}}">
    <input type="hidden" id="product_cash_on_delivery" value="{{route('product.cash_on_delivery.submit')}}">
    <!-- Checkout Area End -->

@endsection
