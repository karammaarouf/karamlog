<!DOCTYPE html>
<html lang="{{ session('locale') }}" @if(session('dir') !== 'box') dir="{{ session('dir')}}" @endif>
@include('layouts.partials.head')
<body data-mode-source="server" class="{{ session('theme_class') }} {{ session('dir') === 'box' ? 'box-layout' : '' }}">
    @include('layouts.partials.alert')
    <!-- page-wrapper Start-->
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    @include('layouts.partials.loader')
    <div class="page-wrapper horizontal-sidebar" id="pageWrapper">
        @include('layouts.partials.header')
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page sidebar removed for customer view -->
            
            <div class="page-body" style="margin-left: 0 !important; margin-right: 0 !important; margin-top: 80px;">
                <!-- Container-fluid starts-->
                <div class="container-fluid default-dashboard">
                    <div class="row">
                        <div class="col-sm-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>

            @include('layouts.partials.footer')
        </div>
    </div>
    @include('layouts.partials.scripts')
</body>
</html>
