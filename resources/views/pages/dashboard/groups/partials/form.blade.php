@extends('layouts.app')
@php
    $isEdit = isset($group) && $group->exists;
    $title = $isEdit ? __('Edit Group') : __('Add New Group');
    $action = $isEdit ? route('groups.update', $group) : route('groups.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Groups') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Group') : __('Add New Group') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end align-items-center">
                    </div>
                    <div class="card-body">
                        {{-- table for languages --}}
                        <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                            @foreach (config('app.available_locales', ['en', 'ar']) as $index => $locale)
                                <li class="nav-item">
                                    <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="{{ $locale }}-tab"
                                        data-bs-toggle="tab" data-bs-target="#{{ $locale }}"
                                        href="#{{ $locale }}" role="tab" aria-controls="{{ $locale }}"
                                        aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                        {{ __($locale) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                            <div class="tab-content" id="languageTabsContent">
                                @foreach (config('app.available_locales', ['en', 'ar']) as $index => $locale)
                                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                        id="{{ $locale }}" role="tabpanel"
                                        aria-labelledby="{{ $locale }}-tab">
                                        <x-forms.input :value="old('name_' . $locale,$isEdit ? $group->getTranslation('name', $locale) : '')" name="name_{{ $locale }}" label="{{ __('name') }} ({{ __($locale) }})" :model="$group"
                                            required />
                                        <x-forms.textarea :value="old('description_' . $locale,$isEdit ? $group->getTranslation('description', $locale) : '')" name="description_{{ $locale }}" label="{{ __('description') }} ({{ __($locale) }})"
                                            :model="$group" />
                                    </div>
                                @endforeach
                            </div>
                            <x-forms.switch-checkbox name="is_active" label="{{ __('status') }}" :model="$group" />
                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="groups.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
