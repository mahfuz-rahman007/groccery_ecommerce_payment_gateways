@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Slider') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                    <li class="breadcrumb-item">{{ __('Slider') }}</li>
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
                        <h3 class="card-title">{{ __('Add Slider') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.slider') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i>{{ __('Back') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.sliderStore') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="language_id" class="col-sm-2 control-label">{{ __('Category') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="pcategory_id" class="form-control">
                                        <option value="" disabled ><-- select slider option --></option>
                                        <option value="0">Welcome Slider</option>
                                        @foreach ($pcategories as $pcategory)
                                            <option value="{{ $pcategory->id }}" >{{ $pcategory->name }}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('pcategory_id'))
                                     <p class="text-danger">{{ $errors->first('pcategory_id') }}</p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="image" class="col-sm-2 control-label">{{ __('Image') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="mw-400 mb-3 img-demo show-img" src="{{ asset('assets/admin/img/img-demo.jpg') }}
                                    " alt="">
                                    <div class="custom-file">
                                        <label for="image" class="custom-file-label">{{ __('Choose New Image') }}</label>
                                        <input type="file" class="custom-file-input up-img" name="image" id="image">
                                    </div>
                                    <p class="help-block text-info">
                                        {{ __('Upload 1920X460 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}">
                                    @if($errors->has('name'))
                                     <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="status" class="col-sm-2 control-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="0">{{ __('Unpublish') }}</option>
                                        <option value="1">{{ __('Publish') }}</option>
                                    </select>

                                    @if($errors->has('status'))
                                     <p class="text-danger">{{ $errors->first('status') }}</p>
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
