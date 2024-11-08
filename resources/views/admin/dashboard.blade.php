@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    
    <x-admin.breadcrumb :values="$breadCrumb"></x-admin.breadcrumb>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        I'm dashboard
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection


        