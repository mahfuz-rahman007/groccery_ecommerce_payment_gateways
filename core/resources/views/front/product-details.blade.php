@extends('front.layout')

@section('meta-keywords', "$product->meta_tags")
@section('meta-description', "$product->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="pagetitle">
						{{ $product->title }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ $product->title }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

  <!-- Product Details Section Start -->
  <section class="product-details-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="product-image">
              <img src="{{ asset('assets/front/img/'.$product->image) }}" alt="">
          </div>
        </div>
        <div class="col-lg-7">
          <div class="right-area">
            <div class="product-info">
              <div class="product-title-area">
                <h1 class="product-title">{{ $product->title }}</h1>
              </div>
              @if($product->stock >0)
              <span class="badge badge-success">
                <i class="far fa-check-circle"></i> {{ __('In Stock') }}
              </span>
            @else
            <span class="badge badge-danger">
              <i class="far fa-times-circle"></i> {{ __('Out of Stock') }}
              </span>
            @endif
              <div class="product-price">
                <p class="price">{{ Helper::showCurrencyPrice($product->current_price) }} <small><del>{{ Helper::showCurrencyPrice($product->previous_price) }}</del></small></p>
              </div>

              <div class="short-info">
                <p>
                    {!! $product->short_description !!}
                </p>
              </div>

              <div class="qtySelector">
                <i class="fas fa-minus decreaseQty subclick"></i>
                <input type="text" class="qtyValue cart-amount" value="1" />
                <i class="fas fa-plus increaseQty addclick"></i>
                <input type="hidden" value="{{ $product->stock }}" id="current_stock">
              </div>

              <div class="cart-buttons">
                @if(Auth::user())
                    <a data-href="{{route('add.cart',$product->id)}}" href="#" class="btn btn-outline-secondary btn-black text-uppercase add-to-cart"> {{__('Add to Cart')}} <i class="fas fa-shopping-cart"></i></a>
                @else

                    <a href="{{ route('user.login') }}" class="btn btn-outline-secondary btn-black text-uppercase ">{{ __('Add to Cart') }}</a>

                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
            <div class="product-desc">
                <h4 class="heading-title">{{ __("Description :") }}</h4>
                {!! $product->description !!}
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Product Details Section Start -->

@endsection
