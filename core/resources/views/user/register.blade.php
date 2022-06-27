
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



    <!-- Register Area Start -->
        <section class="auth">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="sign-form">
                            <div class="heading">
                                <h4 class="title">
                                       {{ __('Register') }}
                                </h4>
                                <p class="subtitle">
                                    {{ __('Register your account to continue.') }}
                                </p>
                            </div>
                            <form class="form-group mb-0" action="{{ route('user.register.submit') }}" method="POST">
                                @csrf
                                <input class="form-control" type="text" value="{{ old('name') }}" name="name" placeholder="{{ __('Full Name') }}">
                                @if($errors->has('name'))
                                <p  class="m-1 text-danger">{{ $errors->first('name') }}</p>
                                @endif
                                <input class="form-control" type="text" value="{{ old('username') }}" name="username" placeholder="{{ __('Enter Username') }}">
                                @if($errors->has('username'))
                                <p  class="m-1 text-danger">{{ $errors->first('username') }}</p>
                                @endif
                                <input class="form-control" type="number" value="{{ old('phone') }}" name="phone" placeholder="{{ __('Enter Phone Number') }}">
                                @if($errors->has('phone'))
                                <p  class="m-1 text-danger">{{ $errors->first('phone') }}</p>
                                @endif
                                <input class="form-control " type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter Email') }}">
                                @if($errors->has('email'))
                                <p  class="m-1 text-danger">{{ $errors->first('email') }}</p>
                                @endif
                                <input class="form-control" type="text" value="{{ old('address') }}" name="address" placeholder="{{ __('Enter Full Address') }}">
                                @if($errors->has('address'))
                                <p  class="m-1 text-danger">{{ $errors->first('address') }}</p>
                                @endif
                                <input class="form-control" type="text" value="{{ old('country') }}" name="country" placeholder="{{ __('Enter Country') }}">
                                @if($errors->has('country'))
                                <p  class="m-1 text-danger">{{ $errors->first('country') }}</p>
                                @endif
                                <input class="form-control" type="text" value="{{ old('city') }}" name="city" placeholder="{{ __('Enter City') }}">
                                @if($errors->has('city'))
                                <p  class="m-1 text-danger">{{ $errors->first('city') }}</p>
                                @endif
                                <input class="form-control" type="number" value="{{ old('zipcode') }}" name="zipcode" placeholder="{{ __('Enter Zip Code') }}">
                                @if($errors->has('zipcode'))
                                <p  class="m-1 text-danger">{{ $errors->first('zipcode') }}</p>
                                @endif
                                <input class="form-control" type="password" name="password" placeholder="{{ __('Enter Password') }}">
                                @if($errors->has('password'))
                                <p  class="m-1 text-danger">{{ $errors->first('password') }}</p>
                                @endif
                                <input class="form-control" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">

                                <button class="btn btn-block btn-outline-secondary btn-black text-uppercase mb-2" type="submit">{{ __('Login') }}</button>

                                <p class="reg-text text-center mb-0">{{ __('Already have an acocunt?') }} <a href="{{ route('user.login') }}">{{ __('Login') }}</a></p>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Register Area End -->

@endsection



