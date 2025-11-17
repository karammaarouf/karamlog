<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
  <body>
    @include('layouts.partials.alert')
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    @include('layouts.partials.loader')
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card login-dark">
            <div>
              <div><a class="logo" href="index.html"><img class="img-fluid for-light m-auto" src="{{asset('assets/images/logo/logo1.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo-dark.png')}}" alt="logo"></a></div>
              <div class="login-main"> 
                <form class="theme-form" action="{{route('login')}}" method="POST">
                  @csrf
                  <h2 class="text-center">{{__('Sign in to account')}}</h2>
                  <p class="text-center">{{__('Enter your email & password to login')}} </p>
                  <div class="form-group">
                    <label class="col-form-label">{{__('Email Address')}}</label>
                    <input class="form-control" name='email' type="email" required="" placeholder="Test@gmail.com" @if($errors->has('email')) value="{{ old('email') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">{{__('Password')}}</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="" placeholder="*********" @if($errors->has('password')) value="{{ old('password') }}" @endif>
                      <div class="show-hide"><span class="show">                         </span></div>
                    </div>
                  </div>
                  <div class="form-group mb-0 checkbox-checked">
                    <div class="form-check checkbox-solid-info">
                      <input name="remember" class="form-check-input" id="solid6" type="checkbox">
                      <label class="form-check-label" for="solid6">{{__('Remember password')}}</label>
                    </div><a class="link" href="forget-password.html">{{__('Forgot password?')}}</a>
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">{{__('Sign in')}}</button>
                    </div>
                  </div>
                  <div class="login-social-title">
                    <h6>{{__('Or Sign in with')}}</h6>
                  </div>
                  <div class="form-group">
                    <ul class="login-social">
                      <li><a href="https://www.linkedin.com" target="_blank"><i class="icon-linkedin"></i></a></li>
                      <li><a href="https://twitter.com" target="_blank"><i class="icon-twitter"></i></a></li>
                      <li><a href="https://www.facebook.com" target="_blank"><i class="icon-facebook"></i></a></li>
                      <li><a href="https://www.instagram.com" target="_blank"><i class="icon-instagram"></i></a></li>
                    </ul>
                  </div>
                  <p class="mt-4 mb-0 text-center">{{__('Don\'t have account?')}}<a class="ms-2" href="sign-up.html">{{__('Create Account')}}</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('layouts.partials.scripts')
    </div>
  </body>
</html>