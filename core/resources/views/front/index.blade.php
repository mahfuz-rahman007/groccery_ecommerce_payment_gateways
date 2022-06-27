
@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>

            <div class="carousel-inner">
                @foreach ($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? ' active' : '' }}" id="slider">
                    <img class="d-block w-100" src="{{ asset('assets/front/img/'.$slider->image) }}" alt="First slide" height="600">
                    <div class="overlay"></div>

                    <div class="carousel-caption d-none d-md-block pb-5 mb-5">
                        <h1>{{ $slider->name }}</h1>
                        <a href="#store" class="btn btn-outline-secondary btn-white text-uppercase ">explore</a>
                    </div>
                </div>
                @endforeach

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </header>

    <!-- about us -->
    <section class="about py-5" id="about">
        <div class="container">

        <div class="row">
            <div class="col-10 mx-auto col-md-6 my-5">
            <h1 class="text-capitalize">{{ $setting->about_title }} <strong class="banner-title ">us</strong></h1>
            <p class="my-4 text-muted w-75"> {{ $setting->about_subtitle }}</p>
            <a href="#" class="btn btn-outline-secondary btn-black text-uppercase ">explore</a>

            </div>
            <div class="col-10 mx-auto col-md-6 align-self-center my-5">
            <div class="about-img__container">
                <img src="{{ asset('assets/front/img/'.$setting->about_image) }}" class="img-fluid" alt="">
            </div>
            </div>
        </div>
        </div>
    </section>

    <!-- end of about us -->


    <!-- store -->
    <section id="store" class="store py-5">
        <div class="container">
        <!-- section title -->
        <div class="row">
            <div class="col-10 mx-auto col-sm-6 text-center">
            <h1 class="text-capitalize">our <strong class="banner-title ">store</strong></h1>
            </div>
        </div>
        <!-- end of section title -->
        <!--filter buttons -->
        <div class="row">
            <div class=" col-lg-8 mx-auto d-flex justify-content-around my-2 sortBtn flex-wrap">
            <a href="{{ route('front.index') }}" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2"  > All</a>
            @foreach ($pcategories as $pcategory)
                <a href="{{ route('front.index', ['term' => request()->input('term'), 'category' => $pcategory->slug]) }}"
                class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2
                @if(request()->input('category') == $pcategory->slug ) active @endif"
                >
                {{ $pcategory->name }}</a>
            @endforeach

            </div>
        </div>
        <!-- search box -->
        <div class="row">

            <div class="col-10 mx-auto col-md-6">
            <form action="{{ route('front.index', ['category' => request()->input('category')]) }} " method="GET">
                <div class="input-group mb-3">
                <div class="input-group-prepend ">
                    <span class="input-group-text search-box" id="search-icon"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" placeholder='item....' id="search-item"  name="term" value="{{ request()->input('term') }} ">
                </div>

            </form>
            </div>
        </div>
        <!--end of filter buttons -->
        {{-- totla item --}}
        <div class="row">
            <h4 class="ml-2">Total Item : {{ $products->count() }}</h4>
        </div>
        <!-- store  items-->
        <div class="row" class="store-items" id="store-items">

            @foreach ($products as $product)
                <!-- single item -->
                <div class="col-10 col-sm-6 col-lg-4 mx-auto my-3 store-item sweets" data-item="sweets">
                <div class="card ">

                    <div class="img-container">
                        <img src="{{ asset('assets/front/img/'.$product->image) }}" class="card-img-top store-img" alt="">
                        <span class="store-item-icon">
                        @if(Auth::user())
                            <a data-href="{{route('add.cart',$product->id)}}" href="#" class="add-to-cart" title="Add To Cart"><i class="fas fa-shopping-cart"></i></a>
                        @else
                            <a href="{{ route('user.login') }}" title="Add To Cart"><i class="fas fa-shopping-cart"></i> </a>
                        @endif
                        </span>
                    </div>
                    <div class="card-body">
                    <div class="card-text d-flex justify-content-between text-capitalize">
                      <a class="link" href="{{ route('front.product-details', $product->slug) }}"> <h5 id="store-item-name">{{ $product->title }}</h5></a>
                        <h5 class="store-item-value"><strong id="store-item-price" class="font-weight-bold">{{ Helper::showAdminCurrencyPrice($product->current_price)}} </strong></h5>

                    </div>
                    </div>
                </div>
                </div>
                <!-- end of card-->
            @endforeach


        </div>

        </div>




    </section>
    <!--end of store items -->
@endsection



