@extends('admin.layout')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="text-dark">{{ __('Admin Profile') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"> <i class="fas fa-home"></i>{{ __('Home') }} </a> </li>
                        <li class="breadcrumb-item">{{ __('Admin Profile') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Update Admin Password') }}</h3>
                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('admin.update_password') }}" method="POST" >
                                @csrf


                                <div class="form-group row">
                                    <label for="old_password" class="col-sm-2 control-label">{{ __('Current Password') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="old_password" id="old_password" class="form-control" value="" placeholder="{{ __('Current Password') }}">
                                        @if($errors->has('old_password'))
                                         <p class="text-danger">{{ $errors->first('old_password') }}</p>
                                        @else
                                            @if ($errors->first('oldPassMatch'))
                                                <span class="text-danger">
                                                    {{ __("Old Password Doesn't Math With The Existing Password") }}
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 control-label">{{ __('New Password') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="password" id="password" class="form-control" value="" placeholder="{{ __('New Password') }}">
                                        @if($errors->has('password'))
                                         <p class="text-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 control-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="password_confirmation" id="name" class="form-control" value="" placeholder="{{ __('Confirm Password') }}">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
