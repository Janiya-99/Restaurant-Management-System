<!-- [ Sidebar Menu ] start -->

<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header text-center">
            <a href="/" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ URL::asset('build/images/logo-dark.svg') }}" alt="Company Logo" width="100%">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                @include('layouts.menu-list')
            </ul>
        </div>
    </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
