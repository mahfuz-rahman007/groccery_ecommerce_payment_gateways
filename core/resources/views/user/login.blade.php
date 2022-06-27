
@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="br-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="pagetitle">
						{{ __('Login') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Login') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->



        <!-- Login Area Start -->
        <section class="auth">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="sign-form">
                            <div class="heading">
                                <h4 class="title">
                                    {{ __('Login') }}
                                </h4>
                                <p class="subtitle">
                                    {{ __('Login to your account to continue.') }}
                                </p>
                            </div>

                            <form class="form-group mb-0" action="{{ route('user.login.submit') }}" method="POST">
                                @csrf
                                <input class="form-control " type="email" value="{{ old('email') }}" name="email" placeholder="{{ __('Enter Email') }}">
                                @if(Session::has('error'))
                                <p class="m-1 text-danger">{{ Session::get('error') }}</p>
                                @endif
                                <input class="form-control" type="password" name="password" placeholder="{{ __('Enter Password') }}">
                                @if($errors->has('password'))
                                <p  class="m-1 text-danger">{{ $errors->first('password') }}</p>
                                @endif
                                @if(Session::has('success'))
                                <p  class="m-1 text-success">{{ Session::get('success') }}</p>
                                @endif

                                <button class="btn btn-block btn-outline-secondary btn-black text-uppercase mb-2" type="submit">{{ __('Login') }}</button>

                                <p class="reg-text text-center  mb-0 user">{{ __("Don't have an account?") }} <a href="{{ route('user.register') }}">{{ __('Register Now') }}</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Login Area End -->

@endsection



