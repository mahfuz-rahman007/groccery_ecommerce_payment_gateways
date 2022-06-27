@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Product Category') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                    <li class="breadcrumb-item">{{ __('Product Category') }}</li>
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
                        <h3 class="card-title">{{ __('Edit Product Category') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.pcategory') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i>{{ __('Back') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.pcategory.update', $pcategory->id) }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $pcategory->name }}" placeholder="{{ __('Enter Name') }}">
                                    @if($errors->has('name'))
                                     <p class="text-danger">{{ $errors->first('name') }}</p>
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
