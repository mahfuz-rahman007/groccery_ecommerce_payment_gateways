@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Languages') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                    <li class="breadcrumb-item">{{ __('Languages') }}</li>
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
                        <h3 class="card-title">{{ $page_name }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.language.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i>{{ __('Back') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.language.updateKeyword', $lang->id) }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-4 mt-2" v-for="(value,key)in datas" :key="key">
                                    <div class="form-group">
                                        <label for="title" class="control-label" style="white-space: normal;">@{{ key }}</label>
                                        <input type="text" :name="'keys[' + key +']'" :value="value" class="form-control">
                                    </div>
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

@section('script')
    <script src="{{asset('assets/admin/plugins/vue/vue.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/vue/axios.js')}}"></script>
    <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>

    <script>
        window.app = new Vue({
            el: '#app',
            data: {
                datas: {!! $json !!},
            }
        })
    </script>

@endsection
