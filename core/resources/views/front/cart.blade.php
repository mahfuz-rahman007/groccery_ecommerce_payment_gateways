@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="pagetitle">
						{{ __('Cart') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Cart') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->
  <!-- Cart Area Start -->
  <section class="cart-area remove_before">
    @if($cart !=null)
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="cart-table">
            <div class="table-responsive table-remove">
                <form id="update_cart" action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    <table class="table table-bordered cart-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Product Name') }}</th>
                            <th class="t-qty">{{ __('Quantity') }}</th>
                            <th class="t-price">{{ __('Price') }}</th>
                            <th class="t-price">{{ __('Total') }}</th>
                            <th class="t-price">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                                $cartTotal = 0;
                                $countitem = 0;
                            @endphp
                            @foreach ($cart as $pid => $item)
                            @php
                                $countitem += $item['qty'];
                                $cartTotal += (double)$item['price'] * (int)$item['qty'];
                                $product = App\Model\Product::findOrFail($pid);
                            @endphp
                            <input type="hidden" value="{{$pid}}" class="product_id" name="product_id[]">
                            <tr class="remove{{$pid}}">
                                <td>{{ $i++ }}</td>
                                <td>
                                <div class="thumbnail">
                                    <img src="{{ asset('assets/front/img/'.$item['photo']) }}" alt="product-image">
                                </div>
                                </td>
                                <td>
                                <h2 class="product-title"><a class="link" href="{{ route('front.product-details', $product->slug) }}">{{ $item['name'] }}</a></h2>
                                </td>
                                <td>
                                    <input type="number" aria-details="{{ $product->stock }}" name="product_quantity[]" class="quantity form-control cart_qty_update" min="1" value="{{ $item['qty'] }}">
                                </td>
                                <td>{{ Helper::showCurrency() }}{{ $item['price'] }} <span class="fas fa-times"></span> {{ $item['qty'] }}</td>
                                <td> {{ Helper::showCurrency() }}<span class="cart_price">{{ $item['price'] * $item['qty'] }}</td></span>
                                <td>
                                <button class="btn btn-danger btn-sm item-remove" rel="{{$pid}}" data-href="{{ route('cart.item.remove', $pid) }} "><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="cart-middle">
                        <tr>
                            <td colspan="6">
                            <div class="cart-footer-area">
                                <div class="row">
                                <div class="col-md-6 offset-6">
                                    <div class="update-cart">
                                    <button type="submit" id="cart_update" class="btn btn-outline-secondary btn-black text-uppercase">{{ __('Update Cart') }}</button>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
          </div>

        </div>
      </div>
      <div class="row justify-content-end cart-middle">
        <div class="col-md-6">
          <div class="cart-summery">
            <h4 class="title">
              {{ __('Cart Summery :') }}
            </h4>
            <table class="table table-bordered">
              <tr>
                <th>{{ __('Total Item') }}</th>
                <td class="cart-item-view"> {{ $countitem }}</td>
              </tr>
              <tr>
                <th>{{ __('Total') }}</th>
                <td> <span>{{ Helper::showCurrency() }}</span><span class="cart-total-view">{{ $cartTotal }}</span> </td>
              </tr>
            </table>
            <div class="checkout-btn-wrape">
              <a href="{{ route('front.checkout') }}" class="btn btn-outline-secondary btn-black text-uppercase">{{ __('Checkout') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="container" id="nocart">
      <div class="row">
        <div class="col-lg-12">
           <div class="bg-light py-5 text-center">
              <h3 class="text-uppercase">{{__('Cart is empty!')}}</h3>
          </div>
        </div>
      </div>
    </div>
    @endif
  </section>
  <!-- Cart Area End -->

@endsection
