@extends('layouts.admin')

@section('title', 'Product Create')

@section('content')
    
    <x-admin.breadcrumb :values="$breadCrumb"></x-admin.breadcrumb>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body wizard-content">
            <form method="POST" id="example-form" action="{{route('admin.product.store')}}" class="mt-5">
                @csrf
                <div>
                    <label for="name">Name <sapn class="text-danger">*</sapn></label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Enter a product's name"
                        class="required form-control"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <label for="price">price <sapn class="text-danger">*</sapn></label>
                    <input
                        id="price"
                        name="price"
                        type="number"
                        step="0.001"
                        min="0"
                        placeholder="Enter a decimal value"
                        class="required form-control"
                    />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div>
                    <label for="quantity_available">Quantity Available <sapn class="text-danger">*</sapn></label>
                    <input
                        id="quantity_available"
                        name="quantity_available"
                        type="number"
                        placeholder="Enter a available quantity"
                        class="required form-control"
                    />
                    <x-input-error :messages="$errors->get('quantity_available')" class="mt-2" />
                </div>
                
                <div class="border-top">
                    <div class="card-body d-flex justify-content-end">
                    <x-primary-button class="btn btn-primary">
                        {{ __('Add') }}
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