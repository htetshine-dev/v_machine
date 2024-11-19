@extends('layouts.admin')

@section('title', 'Product List')

@section('content')
    
    <x-admin.breadcrumb :values="$breadCrumb"></x-admin.breadcrumb>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus"></i> Add New Product
                        </a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table mb-0">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity Available</th>
                            <th scope="col">Instock</th>
                            <th scope="col">Outstock</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $key => $product)
                          <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }} USD</td>
                            <td>{{ $product->quantity_available }}</td>
                            <td>{{ $product->in_stock }}</td>
                            <td>{{ $product->out_stock }}</td>
                            <td>
                                <a href="{{ route('admin.product.detail', $product->id) }}" class="btn btn-outline-info">
                                    <i class="mdi mdi-comment-check-outline"></i>
                                </a>
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-outline-primary">
                                    <i class="mdi mdi-pencil-box-outline"></i>
                                </a>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" id="delete-form-{{ $product->id }}" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>                                
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $product->id }}" data-name="{{ $product->name }}"">
                                    <i class="mdi mdi-delete-forever"></i>
                                </button>
                            </td>
                          </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
                      <div class="card">
                        <div class="border-top">
                            <div class="m-3">
                            {{$products->links('pagination::bootstrap-5')}}
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

