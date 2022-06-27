@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('About') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                    <li class="breadcrumb-item">{{ __('About') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            {{-- update BAsic Information --}}
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('About Content') }}</h3>
                        <div class="card-tools d-flex">
                            <div class="d-inline-block mr-4">
                                <select class="form-control lang languageSelect" data="{{ url()->current(). '?language='}}">
                                    @foreach ($langs as $lang)
                                    <option value="{{ $lang->code }}" {{ $lang->code == request()->input('language') ? 'selected':'' }}>{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.aboutContent.update', $aboutSectiontitle->language_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('About Title') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="about_title" id="about_title" class="form-control" value="{{$aboutSectiontitle->about_title}}" placeholder="{{ __('About Title') }}">
                                    @if($errors->has('about_title'))
                                     <p class="text-danger">{{ $errors->first('about_title') }}</p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="address" class="col-sm-2 control-label">{{ __('About Description') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea  name="about_subtitle" id="about_subtitle" class="form-control summernote" placeholder="{{ __('About Subtitle') }}">{{$aboutSectiontitle->about_subtitle}}</textarea>
                                    @if($errors->has('about_subtitle'))
                                     <p class="text-danger">{{ $errors->first('about_subtitle') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('About Image') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="mw-400 mb-3 show-img img-demo" src="
                                    @if($aboutSectiontitle->about_image)
                                    {{ asset('assets/front/img/'.$aboutSectiontitle->about_image)}}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif"
                                    " alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="about_image">{{ __('Choose New Image') }}</label>
                                        <input type="file" class="custom-file-input up-img" name="about_image" id="about_image">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 1920X390 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
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
