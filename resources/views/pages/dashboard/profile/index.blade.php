@extends('layouts.app')
@section('title')
    {{ __('Profile') }}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ __('Edit Profile') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <h3 class="card-title mb-0">{{ __('My Profile') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="profile-title">
                            <div class="d-flex align-items-center">                  
                                <img class="img-70 rounded-circle" alt="" src="{{asset('assets/images/user/7.jpg')}}"/>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-1">{{ $user->name }}</h3>
                                    <p class="mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="mt-2 text-muted small">
                                <div class="mb-2"><strong>{{ __('General Info') }}:</strong></div>
                                <div class="mb-1">{{ __('Phone') }}:{{ optional($userInformations)->phone ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Address') }}:{{ optional($userInformations)->address ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('City') }}:{{ optional($userInformations)->city ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('State') }}:{{ optional($userInformations)->state ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Country') }}:{{ optional($userInformations)->country ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Birth Date') }}:{{ $userInformations && $userInformations->birth_date ? $userInformations->birth_date->format('Y-m-d') : __('Not provided') }}</div>
                                <hr class="my-4">
                                <div class="mb-2"><strong>{{ __('Contact Info') }}:</strong></div>
                                <div class="mb-1">{{ __('Phone') }}: {{ optional($contactInformations)->phone ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Whatsapp') }}: {{ optional($contactInformations)->whatsapp ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Facebook') }}: {{ optional($contactInformations)->facebook ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Tiktok') }}: {{ optional($contactInformations)->tiktok ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Instagram') }}: {{ optional($contactInformations)->instagram ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Telegram') }}: {{ optional($contactInformations)->telegram ?? __('Not provided') }}</div>
                                <div class="mb-1">{{ __('Email') }}: {{ optional($contactInformations)->email ?? __('Not provided') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <h3 class="card-title mb-0">{{ __('Change Password') }}</h3>
                </div>
                <div class="card-body">
                    <x-forms.form :action="route('profile.password.update')" method="PUT" class="needs-validation" novalidate>
                        <div class="row">
                            <x-forms.input name="current_password" label="{{ __('Current Password') }}" type="password" col="12" required />
                            <x-forms.input name="new_password" label="{{ __('New Password') }}" type="password" col="6" required />
                            <x-forms.input name="new_password_confirmation" label="{{ __('Confirm New Password') }}" type="password" col="6" required />
                        </div>
                        <div class="text-end">
                            <x-forms.submit-button label="{{ __('Update Password') }}" class="btn btn-warning" />
                        </div>
                    </x-forms.form>
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <h3 class="card-title mb-0">{{ __('Edit Profile') }}</h3>
                </div>
                <div class="card-body">
                    <x-forms.form :action="route('profile.update')" method="PUT" class="needs-validation" novalidate>
                        <div class="row">
                            <x-forms.input name="name" label="{{ __('Name') }}" :model="$user" col="6" required />
                            <x-forms.input name="email" label="{{ __('Email') }}" type="email" :model="$user" col="6" required />
                        </div>
                        <hr />
                        <h5 class="mb-3">{{ __('General Information') }}</h5>
                        <div class="row">
                            <x-forms.input name="birth_date" label="{{ __('Birth Date') }}" type="date" :model="$userInformations" col="6" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="phone" label="{{ __('Phone') }}" type="tel" :model="$userInformations" col="6" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="address" label="{{ __('Address') }}" :model="$userInformations" col="12" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="city" label="{{ __('City') }}" :model="$userInformations" col="4" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="state" label="{{ __('State') }}" :model="$userInformations" col="4" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="country" label="{{ __('Country') }}" :model="$userInformations" col="4" placeholder="{{ __('Not provided') }}" />
                        </div>
                        <hr />
                        <h5 class="mb-3">{{ __('Contact Information') }}</h5>
                        <div class="row">
                            <x-forms.input name="contact[phone]" label="{{ __('Contact Phone') }}" type="tel"  :value="old('contact.phone', $contactInformations->phone ?? '')" col="6" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="contact[whatsapp]" label="{{ __('Whatsapp') }}" type="tel" :value="old('contact.whatsapp', $contactInformations->whatsapp ?? '')" col="6" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="contact[telegram]" label="{{ __('Telegram') }}" type="text" :value="old('contact.telegram', $contactInformations->telegram ?? '')" col="6" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="contact[facebook]" label="{{ __('Facebook') }}" type="url" :value="old('contact.facebook', $contactInformations->facebook ?? '')" col="6" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="contact[instagram]" label="{{ __('Instagram') }}" type="url" :value="old('contact.instagram', $contactInformations->instagram ?? '')" col="6" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="contact[tiktok]" label="{{ __('Tiktok') }}" type="url" :value="old('contact.tiktok', $contactInformations->tiktok ?? '')" col="6" placeholder="{{ __('Not provided') }}" />
                            <x-forms.input name="contact[email]" label="{{ __('Contact Email') }}" type="email" :value="old('contact.email', $contactInformations->email ?? '')" col="12" placeholder="{{ __('Not provided') }}" />
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
