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
                        <h3 class="card-title">{{ __('Product Category List') }}</h3>
                        <div class="card-tools d-flex">
                            <a href="{{ route('admin.pcategory.add') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>{{ __('Add Category') }}
                            </a>
                        </div>

                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pcategories as $id=>$pcategory)

                                <tr>
                                    <td>
                                        {{ ++$id }}
                                    </td>
                                    <td>
                                        {{ $pcategory->name }}
                                    </td>

                                    <td >
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.pcategory.edit',$pcategory->id) }}">
                                                <i class="fas fa-pencil-alt"></i>{{ __('Edit') }}
                                        </a>
                                        <form id="deleteform" class="deleteform d-inline-block" action="{{ route('admin.pcategory.delete',$pcategory->id) }}"" method="post">
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
