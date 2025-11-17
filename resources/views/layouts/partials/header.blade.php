<header class="page-header row">
        <div class="logo-wrapper d-flex align-items-center col-auto"><a href="index.html"><img class="light-logo img-fluid" src={{asset('assets/images/logo/logo1.png')}} alt="logo"/><img class="dark-logo img-fluid" src={{asset('assets/images/logo/logo-dark.png')}} alt="logo"/></a><a class="close-btn toggle-sidebar" href="javascript:void(0)">
            <svg class="svg-color">
              <use href="{{ asset('assets/svg/iconly-sprite.svg#Category') }}"></use>
            </svg></a></div>
        <div class="page-main-header col">
          <div class="header-left">
            <form class="form-inline search-full col" action="#" method="get">
              <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                  <div class="u-posRelative">
                    <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Admiro .." name="q" title="" autofocus="autofocus"/>
                    <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">{{(__('Loading...'))}}</span></div><i class="close-search" data-feather="x"></i>
                  </div>
                  <div class="Typeahead-menu"></div>
                </div>
              </div>
            </form>
            <div class="form-group-header d-lg-block d-none">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative d-flex align-items-center"> 
                  <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100" type="text" placeholder="Type to Search..." name="q" title=""/><i class="search-bg iconly-Search icli"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="nav-right">
            <ul class="header-right"> 
              <li class="custom-dropdown">
                <div class="translate_wrapper">
                  <div class="current_lang"><a class="lang" href="javascript:void(0)"><i class="flag-icon {{ app()->getLocale() === 'ar' ? 'flag-icon-sa' : 'flag-icon-us' }}"></i>
                      <h6 class="lang-txt f-w-700">{{ app()->getLocale() === 'ar' ? __('AR') : __('EN') }}</h6></a></div>
                  <ul class="custom-menu profile-menu language-menu py-0 more_lang">
                                  <li class="d-block"><a class="lang" href="{{ route('locale.switch', ['locale' => 'ar']) }}"><i class="flag-icon flag-icon-sa"></i>
                                      <div class="lang-txt">{{__('AR')}}</div></a></li>
                                  <li class="d-block"><a class="lang" href="{{ route('locale.switch', ['locale' => 'en']) }}"><i class="flag-icon flag-icon-us"></i>
                                      <div class="lang-txt">{{__('EN')}}</div></a></li>
                  </ul>
                </div>
              </li>
              <li class="search d-lg-none d-flex"> <a href="javascript:void(0)">
                  <svg>
                    <use href="{{ asset('assets/svg/iconly-sprite.svg#Search') }}"></use>
                  </svg></a></li>
              <li>  <a class="dark-mode" href="javascript:void(0)">
                  <svg>
                    <use href="{{ asset('assets/svg/iconly-sprite.svg#moondark') }}"></use>
                  </svg></a></li>

              <li><a class="full-screen" href="javascript:void(0)"> 
                  <svg>
                    <use href="{{ asset('assets/svg/iconly-sprite.svg#scanfull') }}"></use>
                  </svg></a></li>
              <li class="cloud-design"><a class="cloud-mode">
                  <svg class="climacon climacon_cloudDrizzle" id="cloudDrizzle" version="1.1" viewBox="15 15 70 70">
                    <g class="climacon_iconWrap climacon_iconWrap-cloudDrizzle">
                      <g class="climacon_wrapperComponent climacon_wrapperComponent-drizzle">
                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_drizzle climacon_component-stroke_drizzle-left" d="M42.001,53.644c1.104,0,2,0.896,2,2v3.998c0,1.105-0.896,2-2,2c-1.105,0-2.001-0.895-2.001-2v-3.998C40,54.538,40.896,53.644,42.001,53.644z"></path>
                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_drizzle climacon_component-stroke_drizzle-middle" d="M49.999,53.644c1.104,0,2,0.896,2,2v4c0,1.104-0.896,2-2,2s-1.998-0.896-1.998-2v-4C48.001,54.54,48.896,53.644,49.999,53.644z"></path>
                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_drizzle climacon_component-stroke_drizzle-right" d="M57.999,53.644c1.104,0,2,0.896,2,2v3.998c0,1.105-0.896,2-2,2c-1.105,0-2-0.895-2-2v-3.998C55.999,54.538,56.894,53.644,57.999,53.644z"></path>
                      </g>
                      <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud">
                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M63.999,64.944v-4.381c2.387-1.386,3.998-3.961,3.998-6.92c0-4.418-3.58-8-7.998-8c-1.603,0-3.084,0.481-4.334,1.291c-1.232-5.316-5.973-9.29-11.664-9.29c-6.628,0-11.999,5.372-11.999,12c0,3.549,1.55,6.729,3.998,8.926v4.914c-4.776-2.769-7.998-7.922-7.998-13.84c0-8.836,7.162-15.999,15.999-15.999c6.004,0,11.229,3.312,13.965,8.203c0.664-0.113,1.336-0.205,2.033-0.205c6.627,0,11.998,5.373,11.998,12C71.997,58.864,68.655,63.296,63.999,64.944z"></path>
                      </g>
                    </g>
                  </svg>
                  <h3>15</h3></a></li>
              <li class="profile-nav custom-dropdown">
                <div class="user-wrap">
                  <div class="user-img"><img src="{{ asset('assets/images/profile.png') }}" alt="user"/></div>
                  <div class="user-content">
                    <h6>{{ Auth::user()->name }}</h6>
                    <p class="mb-0">{{ Auth::user()->email }}<i class="fa-solid fa-chevron-down"></i></p>
                  </div>
                </div>
                <div class="custom-menu overflow-hidden">
                  <ul class="profile-body">
                    <li class="d-flex"> 
                      <svg class="svg-color">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg#Profile') }}"></use>
                      </svg><a class="ms-2" href="#">{{__('Account')}}</a>
                    </li>
                    <li class="d-flex"> 
                      <svg class="svg-color">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg#Login') }}"></use>
                      </svg><form action="{{ route('logout') }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger text-decoration-none text-nowrap">{{__('Log Out')}}</button>
                      </form>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </header>