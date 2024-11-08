<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
    <ul id="sidebarnav" class="pt-4">
        <li class="sidebar-item">
            <a
                class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{ route('admin.dashboard') }}"
                aria-expanded="false"
                ><i class="mdi mdi-view-dashboard"></i
                ><span class="hide-menu">Dashboard</span></a
            >
        </li>
        <li class="sidebar-item">
        <a
        class="sidebar-link waves-effect waves-dark sidebar-link"
        href="{{ route('admin.user.list') }}"
        aria-expanded="false"
        ><i class="mdi mdi-account-check"></i
        ><span class="hide-menu">User</span></a
        >
        </li>
        <li class="sidebar-item">
            <a
            class="sidebar-link waves-effect waves-dark sidebar-link"
            href="{{ route('admin.product.list') }}"
            aria-expanded="false"
            ><i class="mdi mdi-wallet-giftcard"></i
            ><span class="hide-menu">Product</span></a
            >
        </li>
        <li class="sidebar-item">
            <a
            class="sidebar-link waves-effect waves-dark sidebar-link"
            href="{{ route('admin.order.list') }}"
            aria-expanded="false"
            ><i class="mdi mdi-clipboard-text"></i
            ><span class="hide-menu">Order</span></a
            >
        </li>
        
    </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->