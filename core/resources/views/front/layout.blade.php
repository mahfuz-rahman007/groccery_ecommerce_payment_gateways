<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('meta-description')">
    <meta name="keywords" content="@yield('meta-keywords')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $commonsetting->website_title }}</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href=" {{ asset('assets/front/css/bootstrap.min.css') }} ">

    {{-- plugin --}}
    <link rel="stylesheet" href=" {{ asset('assets/front/css/plugin.css') }} ">
    <!-- font awesome -->
    <link rel="stylesheet" href=" {{ asset('assets/front/css/all.css') }} ">

    <!-- main css -->
    <link rel="stylesheet" href=" {{ asset('assets/front/css/style.css') }}">

</head>

<body {{ Session::has('notification') ? 'data-notification' : '' }}
    @if (Session::has('notification')) data-notification-message='{{ json_encode(Session::get('notification')) }} @endif'>
    <!-- header -->
    <header>
        <!-- navbar  -->
        <!--
     -->
        <nav class="navbar navbar-expand-lg px-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img
                        src="{{ asset('assets/front/img/' . $commonsetting->website_logo) }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNav">
                    <span class="toggler-icon"><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="myNav">
                    <ul class="navbar-nav mx-auto text-capitalize">
                        <li class="nav-item active">
                            <a class="nav-link"
                                href="@if (request()->path() == '/') #home @else {{ route('front.index') }}#home @endif">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link "
                                href="@if (request()->path() == '/') #about @else {{ route('front.index') }}#about @endif">{{ __('About') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="@if (request()->path() == '/') #store @else {{ route('front.index') }}#store @endif">{{ __('Store') }}</a>
                        </li>
                    </ul>
                    <div class="nav-info-items d-none d-lg-flex ">
                        <!-- single info -->
                        <div class="nav-info   mx-lg-5">
                            <p class="mb-1">
                                <span class="info-icon"><i class="fas fa-phone"></i></span>
                                @php
                                    $number = explode(',', $commonsetting->number);
                                @endphp
                                {{ $number[0] }}
                            </p>
                            <p class="mb-0">
                                @php
                                    $number = explode(',', $commonsetting->email);
                                @endphp
                                {{ $number[0] }}
                            </p>
                        </div>
                        <!-- end of single 0info -->
                        @if (auth()->check())
                            <div class="nav-info align-items-center d-flex justify-content-between mx-3">
                                <a class="link" href="{{ route('user.dashboard') }}"><span
                                        class="info-icon"> <i class="fas fa-user"></i>
                                        {{ Auth::user()->name }} </span></a>

                            </div>
                        @else
                            <div class="nav-info align-items-center d-flex justify-content-between mx-3">
                                <a class="link" href="{{ route('user.login') }}"> <span
                                        class="info-icon"> {{ __('Login') }}</span> </a>

                            </div>
                        @endif
                        <!-- single info -->

                        <!-- end of single info -->
                        <!-- single info -->
                        @if (count($langs) > 0)
                            <div class="nav-info align-items-center d-flex justify-content-between language-change">
                                <span class="info-icon"><i class="fas fa-globe"></i>
                                    {{ $currentLang->name }}</span>
                                <div class="language-menu">
                                    @foreach ($langs as $lang)
                                        <a href="{{ route('changeLang', $lang->code) }}"
                                            class="{{ $lang->name == $currentLang->name ? 'active' : '' }}">{{ $lang->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                        <!-- single info -->
                        @if (Auth::user())
                            <div id="cart-info"
                                class="nav-info align-items-center cart-info d-flex justify-content-between mx-lg-5">
                                <span class="cart-info__icon mr-lg-3"><i class="fas fa-shopping-cart"></i></span>
                                @if ($cart != null)
                                    <p class="mb-0 text-capitalize"> <a class="link"
                                            href="{{ route('front.cart') }} "><span id="item-count">{{ $countitem }}
                                            </span> items - $<span class="item-total">{{ $cartTotal }}</span></a>
                                    </p>
                                @else
                                    <p class="mb-0 text-capitalize"><a class="link"
                                            href="{{ route('front.cart') }} "><span class="mr-2">
                                                {{ __('Empty Cart') }}</span></a> </p>
                                @endif
                            </div>
                        @else
                            <div id="cart-info"
                                class="nav-info align-items-center cart-info d-flex justify-content-between mx-lg-5">
                                <span class="cart-info__icon mr-lg-2"><i class="fas fa-shopping-cart"></i></span>

                                    <p class="mb-0 text-capitalize"><a class="link" href="{{ route('user.login') }} "><span class="">{{ __('Cart') }}</span></a>
                                     </p>
                            </div>
                        @endif

                        <!-- end of single info -->
                    </div>
                </div>
            </div>
        </nav>
        <!-- end of nav -->
        <!--end of  banner  -->
    </header>
    <!-- header -->


    @yield('content')



    <footer class="footer-08">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-6 py-5">
                    <div class="row">
                        <div class="col-12 mb-md-0 mb-4">
                            <!-- section title -->
                            <div class="row mb-5">
                                <div class="col-12 mx-auto text-center">
                                <h1 class="text-capitalize">Grocery <strong class="banner-title ">store</strong></h1>
                                </div>
                            </div>
                            <p>{{ $commonsetting->footer_text }}</p>
                        </div>
                    </div>
                    <div class="row mt-md-5">
                        <div class="col-md-12">
                            <p class="copyright">
                                {{ $commonsetting->copyright_text }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 py-md-5 py-4 aside-stretch-right pl-lg-5">
                    <h2 class="footer-heading footer-heading-white">Contact <strong class="banner-title ">Us</strong></h2>
                    <form action="#" class="contact-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-outline-secondary btn-black text-uppercase filter-btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </footer>

    <!-- jquery -->
    <script src=" {{ asset('assets/front/js/jquery-3.3.1.min.js') }} "></script>
    
    <!-- plugin js-->
    <script src="{{ asset('assets/front/js/plugin.js') }}"></script>

    <!-- bootstrap js -->
    <script src="  {{ asset('assets/front/js/bootstrap.bundle.min.js') }} "></script>

    <!-- popper -->
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>


    <!-- script js -->
    <script src="  {{ asset('assets/front/js/app.js') }} "></script>



</body>

</html>
