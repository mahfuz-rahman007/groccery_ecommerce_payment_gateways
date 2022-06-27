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
                            <div class="card-title">{{ __('Update Admin Information') }}</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.update_profile') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 control-label">{{ __('Image') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <img class="w-100 mb-3 img-demo show-img"  src="{{ asset('assets/front/img/'.$adminprofile->image) }}" alt=""  >
                                        <div class="custom-file">
                                            <label for="image" class="custom-file-label">{{ __('Choose New Image') }}</label>
                                            <input type="file" class="custom-file-input up-img" name="image" id="image">
                                        </div>
                                        <p class="help-block text-info">
                                            {{ __('Upload 70X70 (Pixel) Size image for best quality.
                                            Only jpg, jpeg, png image is allowed.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 control-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{$adminprofile->name}}" placeholder="{{ __('Full Name') }}">
                                        @if($errors->has('name'))
                                         <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 control-label">{{ __('Username') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" id="name" class="form-control" value="{{$adminprofile->username}}" placeholder="{{ __('Username') }}">
                                        @if($errors->has('username'))
                                         <p class="text-danger">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 control-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" id="eamil" class="form-control" value="{{$adminprofile->email}}" placeholder="{{ __('Email') }}">
                                        @if($errors->has('email'))
                                         <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
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
