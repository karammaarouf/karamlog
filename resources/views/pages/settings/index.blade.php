@extends('layouts.app')
@section('title')
    {{ __('Settings') }}
@endsection
@section('breadcrumb')
    {{ __('Settings') }}
@endsection
@section('breadcrumbActive')
    {{ __('Customize') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-no-border pb-0">
        <h3>{{ __('Customize') }}</h3>
        <p class="mb-0">{{ __('Choose interface settings and they will be applied instantly') }}</p>
      </div>
      <div class="card-body">
        <div id="settingsLoader" class="position-fixed top-0 start-0 w-100 h-100 bg-light bg-opacity-50 align-items-center justify-content-center d-none" style="z-index:2000;">
          <div class="spinner-border text-primary" role="status"><span class="visually-hidden">{{ __('loading') }}</span></div>
        </div>

        <div class="mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="color-header mb-2">
            <h4>{{ __('Theme Mode') }}</h4>
            <p>{{ __('Choose between Light / Dark / Mix') }}</p>
          </div>
          <div class="color-body d-flex align-items-center justify-space-between">
            <div class="color-img">
              <img class="img-fluid" src="/assets/images/customizer/light.png" alt="">
              <div class="customizer-overlay"></div>
              <div class="button color-btn light-setting"><a href="javascript:void(0)">{{ __('Light') }}</a></div>
            </div>
            <div class="color-img mx-1">
              <img class="img-fluid" src="/assets/images/customizer/dark.png" alt="">
              <div class="customizer-overlay"></div>
              <div class="button color-btn dark-setting"><a href="javascript:void(0)">{{ __('Dark') }}</a></div>
            </div>
            <div class="color-img">
              <img class="img-fluid" src="/assets/images/customizer/mix.png" alt="">
              <div class="customizer-overlay"></div>
              <div class="button color-btn mix-setting"><a href="javascript:void(0)">{{ __('Mix') }}</a></div>
            </div>
          </div>
        </div>

        <div class="mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="sidebar-icon mb-2"><h4>{{ __('Sidebar Icon') }}</h4><p>{{ __('Choose between Stroke / Colorful') }}</p></div>
          <div class="sidebar-body form-check radio ps-0">
            <ul class="radio-wrapper">
              <li class="default-svg">
                <input class="form-check-input" id="radio-icon5" type="radio" name="radio2" value="stroke" checked>
                <label class="form-check-label" for="radio-icon5"><svg class="stroke-icon"><use href="/assets/svg/icon-sprite.svg#stroke-icons"></use></svg><span>{{ __('Stroke Icon') }}</span></label>
              </li>
              <li class="colorfull-svg">
                <input class="form-check-input" id="radio-icon6" type="radio" name="radio2" value="color">
                <label class="form-check-label" for="radio-icon6"><svg class="stroke-icon"><use href="/assets/svg/icon-sprite.svg#stroke-icons"></use></svg><span>{{ __('Colorful Icon') }}</span></label>
              </li>
            </ul>
          </div>
        </div>

        <div class="mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="theme-layout mb-2"><h4>{{ __('Theme Layout') }}</h4><p>{{ __('Choose between LTR / RTL / Box') }}</p></div>
          <div class="radio-form checkbox-checked">
            <div class="form-check ltr-setting"><input class="form-check-input" id="flexRadioDefault1" type="radio" name="flexRadioDefault" checked><label class="form-check-label" for="flexRadioDefault1">{{__('LTR')}}</label></div>
            <div class="form-check rtl-setting"><input class="form-check-input" id="flexRadioDefault2" type="radio" name="flexRadioDefault"><label class="form-check-label" for="flexRadioDefault2">{{__('RTL')}}</label></div>
            <div class="form-check box-setting"><input class="form-check-input" id="flexRadioDefault3" type="radio" name="flexRadioDefault"><label class="form-check-label" for="flexRadioDefault3">{{__('Box')}}</label></div>
          </div>
        </div>

        <div class="mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="sidebar-type mb-2"><h4>{{ __('Sidebar Type') }}</h4><p>{{ __('Choose between Vertical / Horizontal') }}</p></div>
          <form>
            <div class="sidebar-body form-check radio ps-0">
              <ul class="radio-wrapper">
                <li class="vertical-setting"><input class="form-check-input" id="radio-icon" type="radio" name="radio3" value="vertical" checked><label class="form-check-label" for="radio-icon"><span>{{__('Vertical')}}</span></label></li>
                <li class="horizontal-setting"><input class="form-check-input" id="radio-icon4" type="radio" name="radio3" value="horizontal"><label class="form-check-label" for="radio-icon4"><span>{{__('Horizontal')}}</span></label></li>
              </ul>
            </div>
          </form>
        </div>

        <div class="customizer-color mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="color-picker mb-2"><h4>{{ __('Color Picker') }}</h4></div>
          <ul class="layout-grid">
            <li class="color-layout" data-attr="color-1" data-primary="#308e87" data-secondary="#f39159"><div></div></li>
            <li class="color-layout" data-attr="color-2" data-primary="#57375D" data-secondary="#FF9B82"><div></div></li>
            <li class="color-layout" data-attr="color-3" data-primary="#0766AD" data-secondary="#29ADB2"><div></div></li>
            <li class="color-layout" data-attr="color-4" data-primary="#025464" data-secondary="#E57C23"><div></div></li>
            <li class="color-layout" data-attr="color-5" data-primary="#884A39" data-secondary="#C38154"><div></div></li>
            <li class="color-layout" data-attr="color-6" data-primary="#0C356A" data-secondary="#FFC436"><div></div></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function(){
    var loader = document.getElementById('settingsLoader');
    function showLoader(){ if(!loader) return; loader.classList.remove('d-none'); loader.classList.add('d-flex'); }
    function hideLoader(){ if(!loader) return; setTimeout(function(){ loader.classList.add('d-none'); loader.classList.remove('d-flex'); }, 200); }
    function apply(fn){ showLoader(); try{ fn(); } finally { hideLoader(); } }

    document.addEventListener('DOMContentLoaded', function(){
      // Apply persisted settings
      var dir = localStorage.getItem('dir');
      if (dir) { document.documentElement.setAttribute('dir', dir); }
      var layout = localStorage.getItem('sidebarLayout');
      if (layout === 'horizontal') {
        document.querySelectorAll('.page-wrapper').forEach(function(el){ el.classList.add('horizontal-sidebar'); el.classList.remove('compact-wrapper'); });
      } else if (layout === 'compact') {
        document.querySelectorAll('.page-wrapper').forEach(function(el){ el.classList.add('compact-wrapper'); el.classList.remove('horizontal-sidebar'); });
      }
      var iconStyle = localStorage.getItem('sidebarIcon');
      if (iconStyle === 'iconcolor-sidebar') {
        document.querySelectorAll('.page-sidebar').forEach(function(el){ el.classList.add('iconcolor-sidebar'); el.setAttribute('data-sidebar-layout','iconcolor-sidebar'); });
      } else if (iconStyle === 'stroke-svg') {
        document.querySelectorAll('.page-sidebar').forEach(function(el){ el.classList.remove('iconcolor-sidebar'); el.setAttribute('data-sidebar-layout','stroke-svg'); });
      }
    });

    // Theme mode
    document.querySelector('.light-setting')?.addEventListener('click', function(){ apply(function(){
      document.body.setAttribute('data-theme','light');
      document.body.classList.add('light');
      document.body.classList.remove('dark-only','dark-sidebar');
      localStorage.setItem('mode','light');
    }); });
    document.querySelector('.dark-setting')?.addEventListener('click', function(){ apply(function(){
      document.body.setAttribute('data-theme','dark-only');
      document.body.classList.add('dark-only');
      document.body.classList.remove('light','dark-sidebar');
      localStorage.setItem('mode','dark-only');
    }); });
    document.querySelector('.mix-setting')?.addEventListener('click', function(){ apply(function(){
      document.documentElement.setAttribute('data-theme','dark-sidebar');
      document.body.classList.remove('dark-only','light');
      document.body.classList.add('dark-sidebar');
      localStorage.setItem('mode','dark-sidebar');
    }); });

    // Direction
    document.querySelector('.ltr-setting')?.addEventListener('click', function(){ apply(function(){
      document.body.classList.remove('rtl','box-layout');
      document.documentElement.setAttribute('dir','ltr');
      localStorage.setItem('dir','ltr');
    }); });
    document.querySelector('.rtl-setting')?.addEventListener('click', function(){ apply(function(){
      document.body.classList.remove('ltr','box-layout');
      document.documentElement.setAttribute('dir','rtl');
      localStorage.setItem('dir','rtl');
    }); });
    document.querySelector('.box-setting')?.addEventListener('click', function(){ apply(function(){
      document.body.classList.add('box-layout');
      document.documentElement.removeAttribute('dir');
      localStorage.setItem('dir','');
    }); });

    // Sidebar type
    document.querySelector('.horizontal-setting')?.addEventListener('click', function(){ apply(function(){
      document.querySelectorAll('.page-wrapper').forEach(function(el){ el.classList.add('horizontal-sidebar'); el.classList.remove('compact-wrapper'); });
      localStorage.setItem('sidebarLayout','horizontal');
    }); });
    document.querySelector('.vertical-setting')?.addEventListener('click', function(){ apply(function(){
      document.querySelectorAll('.page-wrapper').forEach(function(el){ el.classList.add('compact-wrapper'); el.classList.remove('horizontal-sidebar'); });
      localStorage.setItem('sidebarLayout','compact');
    }); });

    // Sidebar icon style
    document.querySelector('.colorfull-svg')?.addEventListener('click', function(){ apply(function(){
      document.querySelectorAll('.page-sidebar').forEach(function(el){ el.classList.add('iconcolor-sidebar'); el.setAttribute('data-sidebar-layout','iconcolor-sidebar'); });
      localStorage.setItem('sidebarIcon','iconcolor-sidebar');
    }); });
    document.querySelectorAll('.default-svg').forEach(function(el){ el.addEventListener('click', function(){ apply(function(){
      document.querySelectorAll('.page-sidebar').forEach(function(el2){ el2.classList.remove('iconcolor-sidebar'); el2.setAttribute('data-sidebar-layout','stroke-svg'); });
      localStorage.setItem('sidebarIcon','stroke-svg');
    }); }); });

    // Unlimited color
    document.querySelectorAll('.color-layout').forEach(function(li){
      li.addEventListener('click', function(){ apply(function(){
        document.querySelectorAll('.customizer-color li').forEach(function(el){ el.classList.remove('active'); });
        li.classList.add('active');
        var color = li.getAttribute('data-attr');
        var primary = li.getAttribute('data-primary');
        var secondary = li.getAttribute('data-secondary');
        localStorage.setItem('color', color);
        localStorage.setItem('primary', primary);
        localStorage.setItem('secondary', secondary);
        document.getElementById('color')?.setAttribute('href', '/assets/css/' + color + '.css');
        document.documentElement.style.setProperty('--theme-default', primary);
        document.documentElement.style.setProperty('--theme-secondary', secondary);
      }); });
    });
  })();
</script>
@endpush

@push('styles')
<style>
.customizer-color ul .color-layout{height:35px;width:35px;border-radius:6px;display:inline-block;margin-right:3px;border:1px solid #b8b8b8;padding:3px;position:relative;cursor:pointer;opacity:.9}
.customizer-color ul .color-layout>div{background-color:#308E87;height:100%;width:100%;border-radius:5px}
.customizer-color ul .color-layout[data-attr="color-2"]>div{background-color:#57375D}
.customizer-color ul .color-layout[data-attr="color-3"]>div{background-color:#0766AD}
.customizer-color ul .color-layout[data-attr="color-4"]>div{background-color:#025464}
.customizer-color ul .color-layout[data-attr="color-5"]>div{background-color:#884A39}
.customizer-color ul .color-layout[data-attr="color-6"]>div{background-color:#0C356A}
</style>
@endpush
