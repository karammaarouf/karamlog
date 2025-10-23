<!DOCTYPE html >
<html lang="en">
@include('layouts.partials.head')
  <body>
    <!-- page-wrapper Start-->
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    <div class="loader-wrapper">
      <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper"> 
        @include('layouts.partials.header')
      <!-- Page Body Start-->
      <div class="page-body-wrapper"> 
        <!-- Page sidebar start-->
        @include('layouts.partials.aside')
        <!-- Page sidebar end-->
        @include('layouts.partials.body')
        @include('layouts.partials.footer')
      </div>
    </div>
    @include('layouts.partials.scripts')
  </body>
</html>