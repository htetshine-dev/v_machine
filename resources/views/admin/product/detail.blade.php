@extends('layouts.admin')

@section('title', 'User')

@section('content')
    
    <x-admin.breadcrumb :values="$breadCrumb"></x-admin.breadcrumb>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body wizard-content">
            <form method="GET" id="example-form" action="{{ route('admin.product.edit', $product->id) }}" class="mt-5">
                @csrf
                <div>
                    <label for="name">Name <sapn class="text-danger">*</sapn></label>
                    <input
                        disabled
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
                        disabled
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

                <div>
                    <label for="quantity_available">Quantity Available <sapn class="text-danger">*</sapn></label>
                    <input
                        disabled
                        id="quantity_available"
                        name="quantity_available"
                        type="number"
                        class="required form-control"
                        value="{{ old('quantity_available', $product->quantity_available) }}"
                    />
                    <x-input-error :messages="$errors->get('quantity_available')" class="mt-2" />
                </div>

                <div>
                    <label for="in_stock">Instock <sapn class="text-danger">*</sapn></label>
                    <input
                        disabled
                        id="in_stock"
                        name="in_stock"
                        type="number"
                        class="required form-control"
                        value="{{ old('in_stock', $product->in_stock) }}"
                    />
                    <x-input-error :messages="$errors->get('in_stock')" class="mt-2" />
                </div>

                <div>
                    <label for="out_stock">Out of stock <sapn class="text-danger">*</sapn></label>
                    <input
                        disabled
                        id="out_stock"
                        name="out_stock"
                        type="number"
                        class="required form-control"
                        value="{{ old('out_stock', $product->out_stock) }}"
                    />
                    <x-input-error :messages="$errors->get('out_stock')" class="mt-2" />
                </div>

                <div>
                    <label for="created_user">Created User <sapn class="text-danger">*</sapn></label>
                    <input
                        disabled
                        id="created_user"
                        name="created_user"
                        type="text"
                        class="required form-control"
                        value="{{ old('created_user', $product->createdBy->name ?? null) }}"
                    />
                    <x-input-error :messages="$errors->get('created_user')" class="mt-2" />
                </div>

                <div>
                    <label for="updated_user">Updated User <sapn class="text-danger">*</sapn></label>
                    <input
                        disabled
                        id="updated_user"
                        name="updated_user"
                        type="text"
                        class="required form-control"
                        value="{{ old('updated_user', $product->updatedBy->name ?? null) }}"
                    />
                    <x-input-error :messages="$errors->get('updated_user')" class="mt-2" />
                </div>
               

                {{-- <div class="border-top">
                    <div class="card-body d-flex justify-content-end">
                      <button type="button" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                </div> --}}
                <div class="border-top">
                    <div class="card-body d-flex justify-content-end">
                    <x-primary-button class="btn btn-primary">
                        {{ __('Edit') }}
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