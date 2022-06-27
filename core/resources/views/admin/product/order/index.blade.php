@extends('admin.layout')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        @if (request()->path() == 'admin/product/pending/orders')
                            {{ __('Pending') }}
                        @elseif (request()->path() == 'admin/product/all/orders')
                            {{ __('All') }}
                        @elseif (request()->path() == 'admin/product/processing/orders')
                            {{ __('Processing') }}
                        @elseif (request()->path() == 'admin/product/completed/orders')
                            {{ __('Completed') }}
                        @elseif (request()->path() == 'admin/product/rejected/orders')
                            {{ __('Rejcted') }}
                        @endif
                        {{ __('Order') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">
                            @if (request()->path() == 'admin/product/pending/orders')
                                {{ __('Pending') }}
                            @elseif (request()->path() == 'admin/product/all/orders')
                                {{ __('All') }}
                            @elseif (request()->path() == 'admin/product/processing/orders')
                                {{ __('Processing') }}
                            @elseif (request()->path() == 'admin/product/completed/orders')
                                {{ __('Completed') }}
                            @elseif (request()->path() == 'admin/product/rejected/orders')
                                {{ __('Rejcted') }}
                            @endif
                            {{ __('Order') }}
                        </li>
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
                            <h3 class="card-title">
                                @if (request()->path() == 'admin/product/pending/orders')
                                    {{ __('Pending') }}
                                @elseif (request()->path() == 'admin/product/all/orders')
                                    {{ __('All') }}
                                @elseif (request()->path() == 'admin/product/processing/orders')
                                    {{ __('Processing') }}
                                @elseif (request()->path() == 'admin/product/completed/orders')
                                    {{ __('Completed') }}
                                @elseif (request()->path() == 'admin/product/rejected/orders')
                                    {{ __('Rejcted') }}
                                @endif
                                {{ __('Order List:') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Order Number') }}</th>
                                        <th>{{ __('Gateway') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Order Status') }}</th>
                                        <th>{{ __('Payment Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $id => $order)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>#{{ $order->order_number }}</td>
                                            <td>{{ $order->method }}</td>
                                            <td> {{ $order->currency_sign }}{{ round($order->total, 2) }}</td>
                                            <td>
                                                <form action="{{ route('admin.product.orders.status') }}" id="orderStatusForm{{ $order->id }}"
                                                    class="d-inline-block" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <select name="order_status"
                                                        class="form-control form-control-sm
                                                        @if ($order->order_status == '0')
                                                            bg-warning
                                                        @elseif($order->order_status == '1')
                                                            bg-primary
                                                        @elseif($order->order_status == '2')
                                                            bg-success
                                                        @elseif($order->order_status == '3')
                                                            bg-danger
                                                        @endif
                                                        " onchange="document.getElementById('orderStatusForm{{ $order->id }}').submit();">
                                                        <option value="0"
                                                            {{ $order->order_status == '0' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="1"
                                                            {{ $order->order_status == '1' ? 'selected' : '' }}>
                                                            Processing</option>
                                                        <option value="2"
                                                            {{ $order->order_status == '2' ? 'selected' : '' }}>Completed
                                                        </option>
                                                        <option value="3"
                                                            {{ $order->order_status == '3' ? 'selected' : '' }}>Rejected
                                                        </option>
                                                    </select>

                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.product.payment.status') }}" id="paymentStatusForm{{ $order->id }}"
                                                    class="d-inline-block" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <select name="payment_status"
                                                        class="form-control form-control-sm
                                                        @if ($order->payment_status == '0')
                                                            bg-warning
                                                        @elseif($order->payment_status == '1')
                                                            bg-success
                                                        @endif
                                                        " onchange="document.getElementById('paymentStatusForm{{ $order->id }}').submit();">
                                                        <option value="0"
                                                            {{ $order->payment_status == '0' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="1"
                                                            {{ $order->payment_status == '1' ? 'selected' : '' }}>
                                                            Complete
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.product.details',$order->id) }}">Details</a>
                                                        <a class="dropdown-item"
                                                            href="{{ asset('assets/front/invoices/product/' . $order->invoice_number) }}"
                                                            target="_blank">Invoice</a>
                                                        <form id="deleteform" class="d-inline-block dropdown-item"
                                                            action="{{ route('admin.product.order.delete') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="order_id"
                                                                value="{{ $order->id }}">
                                                            <button type="submit" id="delete" class="bg-transparent border-none m-0 p-0">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
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
@endsection
