<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="htetshine, codetest, free template"
    />
    <meta
      name="description"
      content="htetshine's code test template"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="{{ asset('images/favicon.png') }}"
    />
    <!-- Custom CSS -->
    <link href="{{ asset('libs/flot/css/float-chart.css') }}" rel="stylesheet"/>

    @vite([
        'resources/js/app.js',
        'resources/css/style.min.css',
        'resources/js/waves.js',
        'resources/js/sidebarmenu.js',
        'resources/js/custom.min.js',
        'resources/js/pages/chart/chart-page-init.js',
        ])
  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    {{-- <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div> --}}
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      <x-admin.header></x-admin.header>

      <x-admin.left-sidebar></x-admin.left-sidebar>

      <div class="page-wrapper">

        @yield('content')
        
        <x-admin.footer></x-admin.footer>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Main Wrapper -->
    <!-- ============================================================== -->
    <x-javascript></x-javascript>
  </body>
</html>