    <!-- Favicon icon-->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon"/>

    <!-- Flag icon css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/flag-icon.css') }}"/>
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{ asset('assets/css/iconly-icon.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bulk-style.css') }}"/>
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{ asset('assets/css/themify.css') }}"/>
    <!--fontawesome-->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-min.css') }}"/>
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/weather-icons/weather-icons.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}"/>
    <!-- Slick css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick-theme.css') }}"/>
    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen"/>
    <script>
      (function(){
        try {
          var baseCss = "{{ asset('assets/css') }}";
          var color = localStorage.getItem('color');
          if (color) {
            var el = document.getElementById('color');
            if (el) { el.setAttribute('href', baseCss + '/' + color + '.css'); }
          }
          var primary = localStorage.getItem('primary');
          if (primary) { document.documentElement.style.setProperty('--theme-default', primary); }
          var secondary = localStorage.getItem('secondary');
          if (secondary) { document.documentElement.style.setProperty('--theme-secondary', secondary); }

          var serverLocale = "{{ session('locale', request()->cookie('locale', app()->getLocale())) }}";
          var locale = localStorage.getItem('locale') || serverLocale;
          var dir = (locale === 'ar') ? 'rtl' : 'ltr';
          document.documentElement.setAttribute('dir', dir);
          document.documentElement.setAttribute('lang', locale);
          localStorage.setItem('dir', dir);
          localStorage.setItem('locale', locale);
        } catch (e) {}
      })();
    </script>
    <!--choices.js-->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/choices.js/public/assets/styles/choices.min.css') }}">

 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
<style>
    *:not(i) {
        font-family: "Cairo", sans-serif !important;
        font-optical-sizing: auto !important;
        font-weight: 700 !important;
        font-style: normal !important;
        font-variation-settings:"slnt" 0 !important;
    }
</style>
@stack('styles')
