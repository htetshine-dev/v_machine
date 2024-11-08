@extends('layouts.admin')

@section('title', 'Product Edit')

@section('content')
    
    <x-admin.breadcrumb :values="$breadCrumb"></x-admin.breadcrumb>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body wizard-content">
            <form method="POST" id="example-form" action="{{ route('admin.product.update', $product->id) }}" class="mt-5">
                @csrf
                <div>
                    <label for="name">Name <sapn class="text-danger">*</sapn></label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="required form-control"
                        value="{{ old('name', $product->name) }}"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <label for="price">Price <sapn class="text-danger">*</sapn></label>
                    <input
                        id="price"
                        name="price"
                        type="number"
                        step="0.001"
                        min="0"
                        class="required form-control"
                        value="{{ old('price', $product->price) }}"
                    />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                @if($product->in_stock == 0)
                <div>
                    <label for="quantity_available">Quantity Available <sapn class="text-danger">*</sapn></label>
                    <input
                        id="quantity_available"
                        name="quantity_available"
                        type="number"
                        placeholder="Enter a available quantity"
                        class="required form-control"
                        value="{{ old('quantity_available', $product->quantity_available) }}"
                    />
                    <x-input-error :messages="$errors->get('quantity_available')" class="mt-2" />
                </div>
                @endif
                
                <div class="border-top">
                    <div class="card-body d-flex justify-content-end">
                    <x-primary-button class="btn btn-primary">
                        {{ __('Update') }}
                    </x-primary-button>
                    </div>
                </div>
            </form>
            </div>
            
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection