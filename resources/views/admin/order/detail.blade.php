@extends('layouts.admin')

@section('title', 'Order History')

@section('content')
    <x-admin.breadcrumb :values="$breadCrumb"></x-admin.breadcrumb>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="py-12">
                    <div class="bg-white p-6 rounded-lg shadow-lg p-2">
                        <h2 class="text-xl font-semibold">Order Details</h2>
            
                        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p><strong>Customer:</strong> {{ $order->user->name }}</p>
            
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">Items:</h3>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li>
                                        {{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}
                                        (Added by {{ $item->user->name }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <p><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection

