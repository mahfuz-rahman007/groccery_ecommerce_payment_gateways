@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Currency') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Payment Settings') }}</li>
            <li class="breadcrumb-item">{{ __('Currency') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Currency List') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.currency.add') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> {{ __('Add Currency') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="idtable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Sign') }}</th>
                                <th>{{ __('Value') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($currency as $id=>$curr)
                            <tr>
                                <td>{{ ++$id }}</td>
                                <td>
                                    {{ $curr->name }}
                                </td>

                                <td>
                                    {{ $curr->sign }}
                                </td>

                                <td>
                                    {{ $curr->value }}
                                </td>
                                
                                <td>
                                    @if($curr->is_default == 1)
                                    <a href="javascript:;" class="btn btn-success btn-sm">{{ __('Default') }}</a>
                                    <a href="{{ route('admin.currency.edit', $curr->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                   
                                    @else
                                    <a href="{{ route('admin.currency.status', $curr->id ) }}" class="btn btn-primary btn-sm">{{ __('Set Default') }}</a>
                                    <a href="{{ route('admin.currency.edit', $curr->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                              
                                    <form  id="deleteform" class="d-inline-block" action="{{ route('admin.currency.delete', $curr->id ) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $curr->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                        <i class="fas fa-trash"></i>{{ __('Delete') }}
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
<div class="modal fade deleteModel" tabindex="-1" role="dialog"
aria-labelledby="deleteModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">{{ __("Confirm Delete") }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <p class="text-center">{{__("Are you sure")}}</p>
        <p class="text-center">{{ __("Do you want to proceed?") }}</p>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
        <a href="javascript:;" class="btn btn-danger btn-delete">{{ __("Delete") }}</a>
    </div>
</div>
</div>
</div>
@endsection
