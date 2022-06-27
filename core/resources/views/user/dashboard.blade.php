
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
						{{ __('Dashboard') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Dashboard') }}
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
			<div class="col-lg-9 ">
			  <div class="dashboard-inner pricingPlan-section  packag-page p-0">
				<div class="row">
						<div class="col-lg-12">
							<h4 class="mb-4"><strong>{{ __('Welcome') }}, {{ Auth::user()->name }}</strong></h4>
							<h6>{{ __("You don't purchase any package!!") }}</h6>
						</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>

	</section>
    <!-- User Dashboard End -->

@endsection



