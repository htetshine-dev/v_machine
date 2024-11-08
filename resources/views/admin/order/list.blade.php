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
                <div class="card">
                    <table class="table mb-0">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Id</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date & Time</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orders as $key => $order)
                          <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->total_amount }} USD</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.order.detail', $order->id) }}" class="btn btn-outline-info">
                                    <i class="mdi mdi-comment-check-outline"></i>
                                </a>
                                
                            </td>
                          </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
                      <div class="card">
                        <div class="border-top">
                            <div class="m-3">
                            {{$orders->links('pagination::bootstrap-5')}}
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection

