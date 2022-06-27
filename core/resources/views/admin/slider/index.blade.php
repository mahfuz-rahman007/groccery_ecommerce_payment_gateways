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
                        <h3 class="card-title">{{ __('Slider List') }}</h3>
                        <div class="card-tools d-flex">
                            <a href="{{ route('admin.sliderAdd') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>{{ __('Add Slider') }}
                            </a>
                        </div>

                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $id=>$slider)

                                <tr>
                                    <td>
                                        {{ ++$id }}
                                    </td>
                                    <td>
                                        <img class="w-80" src="{{ asset('assets/front/img/'. $slider->image) }}" alt="">
                                    </td>
                                    <td>
                                        {{ $slider->name }}
                                    </td>
                                    <td>
                                        @if ($slider->pcategory_id == '0')
                                            {{ __('Welcome') }}
                                        @else
                                            {{  $slider->pcategory->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($slider->status == 1)
                                            <strong class="badge badge-success">publish</strong>
                                        @else
                                            <strong class="badge badge-warning">unpublish</strong>
                                        @endif
                                    </td>
                                    <td >
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.sliderEdit', $slider->id)}}">
                                                <i class="fas fa-pencil-alt"></i>{{ __('Edit') }}
                                        </a>
                                        <form id="deleteform" class="deleteform d-inline-block" action="{{route('admin.sliderDelete', $slider->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm deletebtn" id="delete">
                                                <i class="fas fa-trash"></i>{{ __('Delete') }}
                                            </button>
                                         </form>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
