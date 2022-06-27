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
						{{ __('User Dashboard') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('User Dashboard') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- User Dashboard Start -->
	<section class="user-dashboard-area">
		<div class="container">
		  <div class="row">
			<div class="col-lg-3">
				@includeif('user.dashboard-sidenav')
			</div>
			<div class="col-lg-9">
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <h5 class="card-header">{{ __('Change Password') }}</h5>
                        <div class="card-body">
                          <form action="{{ route('user.update_password', Auth::user()->id) }}" method="POST" >
                            @csrf
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label for="">{{ __('Old Password') }}</label>
                                  <input type="text" class="form-control"  name="old_password" value="">
                                  @if($errors->has('old_password'))
                                  <p  class="m-1 text-danger">{{ $errors->first('old_password') }}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label for="">{{ __('New Password') }}</label>
                                  <input type="text" class="form-control"  name="password" value="">
                                  @if($errors->has('password'))
                                  <p  class="m-1 text-danger">{{ $errors->first('password') }}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label for="">{{ __('Confirm Password') }}</label>
                                  <input type="text" class="form-control"  name="password_confirmation" value="">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <button type="submit" class="mybtn1">{{ __('Submit') }} <i class="far fa-paper-plane"></i></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
			</div>
		  </div>
		</div>

	  </section>
    <!-- User Dashboard End -->

@endsection
