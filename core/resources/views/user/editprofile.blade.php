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
                        <h5 class="card-header">{{ __('Edit Profile') }}</h5>
                        <div class="card-body">
                          <form action="{{ route('user.updateprofile', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group mb-4 text-center">
                                        <div class="upload-img d-inline">
                                          <div class="img">
                                              <img class="mb-3 show-img img-demo" src="
                                              @if(Auth::user()->photo)
                                              {{ asset('assets/front/img/'.Auth::user()->photo) }}
                                              @else
                                              {{ asset('assets/admin/img/img-demo.jpg') }}
                                              @endif"
                                              " alt="">
                                          </div>
                                          <div class="file-upload-area">
                                            <div class="upload-file">
                                              <input type="file" name="photo" class="up-img upload image form-control ">
                                            </div>
                                            @if($errors->has('photo'))
                                            <p  class="m-1 text-danger">{{ $errors->first('photo') }}</p>
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{ __('First Name') }}</label>
                                  <input type="text" class="form-control"  name="name" value="{{ Auth::user()->name }}">
                                  @if($errors->has('name'))
                                <p  class="m-1 text-danger">{{ $errors->first('name') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{ __('Email') }}</label>
                                  <input type="email" class="form-control"  name="email"
                                    value="{{ Auth::user()->email }}">
                                    @if($errors->has('email'))
                                <p  class="m-1 text-danger">{{ $errors->first('email') }}</p>
                                @endif
                                </div>
                              </div>

                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{ __('Phone') }}</label>
                                  <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                                  @if($errors->has('phone'))
                                <p  class="m-1 text-danger">{{ $errors->first('phone') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{ __('Address') }}</label>
                                  <input type="text" class="form-control"  name="address" value="{{ Auth::user()->address }}">
                                  @if($errors->has('address'))
                                <p  class="m-1 text-danger">{{ $errors->first('address') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{ __('Country') }}</label>
                                  <input type="text" class="form-control" name="country" value="{{ Auth::user()->country }}">
                                  @if($errors->has('country'))
                                <p  class="m-1 text-danger">{{ $errors->first('country') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{ __('City') }}</label>
                                  <input type="text" class="form-control"  name="city" value="{{ Auth::user()->city }}">
                                  @if($errors->has('city'))
                                <p  class="m-1 text-danger">{{ $errors->first('city') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label for="">{{ __('Zip Code') }}</label>
                                  <input type="text" class="form-control"  name="zipcode"
                                    value="{{ Auth::user()->zipcode }}">
                                    @if($errors->has('zipcode'))
                                <p  class="m-1 text-danger">{{ $errors->first('zipcode') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <button class="btn btn-bg btn-outline-secondary btn-black text-uppercase mb-2" type="submit">{{ __('Submit') }} <i class="far fa-paper-plane"></i></button>

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

