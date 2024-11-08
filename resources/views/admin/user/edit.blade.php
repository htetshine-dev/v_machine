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
            <form method="POST" id="example-form" action="{{ route('admin.user.update', $user->id) }}" class="mt-5">
                @csrf
                <div>
                    <label for="name">Name <sapn class="text-danger">*</sapn></label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="required form-control"
                        value="{{ old('name', $user->name) }}"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <label for="email">Email <sapn class="text-danger">*</sapn></label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="required form-control"
                        value="{{ old('email', $user->email) }}"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <label for="role">Role <sapn class="text-danger">*</sapn></label>
                    <select
                      id="role"
                      name="role"
                      class="select2 form-select shadow-none"
                      style="width: 100%; height: 36px"
                    >
                      <option value="">Select</option>
                        <option value="admin" {{ old('role', $user->getRoleNames()->first()) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="client" {{ old('role', $user->getRoleNames()->first()) == 'client' ? 'selected' : '' }}>User</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
                <div>
                    <label for="password">Password <sapn class="text-danger">*</sapn></label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="required form-control"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <label for="password_confirmation">Confirm Password <sapn class="text-danger">*</sapn></label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="required form-control"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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