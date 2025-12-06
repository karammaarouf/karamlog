@extends('layouts.app')
@section('title') {{ __('Profile') }} @endsection
@section('breadcrumb') {{ __('Users') }} @endsection
@section('breadcrumbActive') {{ __('Edit Profile') }} @endsection
@section('content')
<div class="row">
  <div class="col-xl-4">
    <div class="card">
      <div class="card-header card-no-border pb-0">
        <h3 class="card-title mb-0">{{ __('My Profile') }}</h3>
        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="profile-title">
            <div class="d-flex gap-3 align-items-center">
              <img class="img-70 rounded-circle" alt="user" src="{{ asset('assets/images/profile.png') }}"/>
              <div class="flex-grow-1">
                <h3 class="mb-1">{{ $user->name }}</h3>
                <p class="mb-0">{{ $user->email }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-8">
    <div class="card">
      <div class="card-header card-no-border pb-0">
        <h3 class="card-title mb-0">{{ __('Edit Profile') }}</h3>
        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
      </div>
      <div class="card-body">
        <x-forms.form :action="route('profile.update')" method="PUT" class="needs-validation" novalidate>
          <div class="row">
            <x-forms.input name="name" label="{{ __('Name') }}" :model="$user" col="6" required />
            <x-forms.input name="email" label="{{ __('Email') }}" type="email" :model="$user" col="6" required />
            <x-forms.input name="password" label="{{ __('Password') }}" type="password" col="6" help="{{ __('Leave blank to keep current password') }}" />
            <x-forms.input name="password_confirmation" label="{{ __('Confirm Password') }}" type="password" col="6" />
          </div>
          <hr/>
          <h5 class="mb-3">{{ __('User Information') }}</h5>
          <div class="row">
            <x-forms.input name="birth_date" label="{{ __('Birth Date') }}" type="date" :model="$userInformations" col="6" placeholder="{{ __('Not provided') }}" />
            <x-forms.input name="phone" label="{{ __('Phone') }}" type="tel" :model="$userInformations" col="6" placeholder="{{ __('Not provided') }}" />
            <x-forms.input name="address" label="{{ __('Address') }}" :model="$userInformations" col="12" placeholder="{{ __('Not provided') }}" />
            <x-forms.input name="city" label="{{ __('City') }}" :model="$userInformations" col="4" placeholder="{{ __('Not provided') }}" />
            <x-forms.input name="state" label="{{ __('State') }}" :model="$userInformations" col="4" placeholder="{{ __('Not provided') }}" />
            <x-forms.input name="country" label="{{ __('Country') }}" :model="$userInformations" col="4" placeholder="{{ __('Not provided') }}" />
          </div>
          <div class="text-end">
            <x-forms.submit-button label="{{ __('Update Profile') }}" class="btn btn-primary" />
          </div>
        </x-forms.form>
      </div>
    </div>
  </div>
</div>
@endsection
