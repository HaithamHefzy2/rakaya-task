@include('layouts.head')

<div>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>

    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        @include('layouts.navbar')
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->

        <div class="dashboard-page-one">

            <!-- Sidebar Area Start Here -->
            @include('layouts.sidebar')

            <!-- Sidebar Area End Here -->
            @yield('content')

            @include('layouts.footer')
        </div>
        <!-- Page Area End Here -->
    </div>
</div>

@include('layouts.script')
@yield('script')
</body>

</html>
