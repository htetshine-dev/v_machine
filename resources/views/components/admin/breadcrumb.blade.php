<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
@props([
    'values'
])

<div class="page-breadcrumb">
<div class="row">
    <div class="col-12 d-flex no-block align-items-center">
    <h4 class="page-title">{{ ucfirst(end($values)) }}</h4>
    <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($values as $value)
                @if(!$loop->last)
                <li class="breadcrumb-item"><a href="#">{{ucfirst($value)}}</a></li>
                @else
                <li class="breadcrumb-item active" aria-current="page">{{ucfirst($value)}}</li>
                @endif
            @endforeach
        </ol>
        </nav>
    </div>
    </div>
</div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->