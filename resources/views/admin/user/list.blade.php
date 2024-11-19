@extends('layouts.admin')

@section('title', 'User')

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
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus"></i> Create New User
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
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $key => $user)
                          <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @foreach ($user->getRoleNames() as $role)
                                <td>{{ ($role == "client") ? 'User' : ucfirst($role) }}</td>
                            @endforeach
                            <td>
                                <a href="{{ route('admin.user.detail', $user->id) }}" class="btn btn-outline-info">
                                    <i class="mdi mdi-comment-check-outline"></i>
                                </a>
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-outline-primary">
                                    <i class="mdi mdi-pencil-box-outline"></i>
                                </a>
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>                                
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
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
                            {{$users->links('pagination::bootstrap-5')}}
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

