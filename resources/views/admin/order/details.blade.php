<!-- /.navbar -->
<!-- Main Sidebar Container -->
@extends('admin.layout.app')
@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.layout.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order: #4F3S8J</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="orders.html" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header pt-3">
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <h1 class="h5 mb-3">Shipping Address</h1>
                                        <address>
                                            <strong>{{ $order->country->name }}</strong>
                                            <br>
                                            {{ $order->address }}
                                            {{-- 795 Folsom Ave, Suite 600
                                                <br>
                                                San Francisco, CA 94107
                                                <br> --}}

                                            <br>
                                            Phone:{{ $order->phone }}
                                            <br>
                                            Email: {{ $order->email }}
                                        </address>
                                    </div>



                                    <div class="col-sm-4 invoice-col">
                                        {{-- <b>Invoice #007612</b><br> --}}
                                        <br>
                                        <b>Order ID:</b> {{ $order->id }}<br>

                                        @if (!$discount_user)
                                            <b>Total:</b> ${{ $order->sub_total }}<br>
                                        @else
                                            <b>Total:</b> ${{ $discount_user->total_discount }}<br>
                                        @endif
                                        @if ($order->status === 1)
                                            <b>Status:</b> <span class="text-danger">Awating Delivery</span>
                                        @else
                                            <b>Status:</b> <span class="text-success">Delivered</span>
                                        @endif
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th width="100">Price</th>
                                            <th width="100">Qty</th>
                                            <th width="100">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $index => $product)
                                            <tr>
                                                <td>{{ $product->title }} </td>
                                                <td>${{ $product->price }} </td>
                                                <td>{{ $quantity[$index] }}</td>
                                                <td>${{ $product->price * $quantity[$index] }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th colspan="3" class="text-right">Subtotal:</th>
                                            <td>${{ $order->sub_total }}</td>
                                        </tr>

                                        <tr>
                                            <th colspan="3" class="text-right">Shipping:</th>
                                            <td>$0.00</td>
                                        </tr>
                                        <tr>
                                            @if (!$discount_user)
                                                <th colspan="3" class="text-right">Grand Total:</th>
                                                <td>${{ $order->sub_total }}</td>
                                            @else
                                                <th colspan="3" class="text-right">Grand Total:</th>
                                                <td>${{ $discount_user->total_discount }}</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Order Status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Pending</option>
                                        <option value="">Shipped</option>
                                        <option value="">Delivered</option>
                                        <option value="">Cancelled</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Send Inovice Email</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Customer</option>
                                        <option value="">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@section('custom-js')
@endsection
@endsection
