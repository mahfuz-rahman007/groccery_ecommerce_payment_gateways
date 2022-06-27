@extends('front.layout')
@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

 <!--====== PAGE TITLE PART START ======-->

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="pagetitle">
						{{ __('Success') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Success') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

<!--====== PAGE TITLE PART ENDS ======-->


 <!--====== ABOT FAQ PART START ======-->

<div class="container m-5">
    <div class="row justify-content-center align-item-center">
        <div class="text text-center">
            <h2 class="text-success">Successfully Order Done !</h2>
            <p> Payment Completed and Invoice sent to your email </p>
            <a href="{{ route('front.index') }}" class="btn btn-primary">
                {{ __('Home') }}
            </a>
        </div>
    </div>
</div>
<!--====== ABOT FAQ PART ENDS ======-->



@endsection
