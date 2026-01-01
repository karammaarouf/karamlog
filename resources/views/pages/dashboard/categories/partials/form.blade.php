@extends('layouts.app')
@php
    $isEdit = isset($category) && $category->exists;
    $title = $isEdit ? __('Edit Category') : __('Add New Category');
    $action = $isEdit ? route('categories.update', $category) : route('categories.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Categories') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Category') : __('Add New Category') }}
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
                                <a class="nav-link {{$index == 0 ? 'active' : ''}}" 
                                id="{{$locale}}-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#{{$locale}}"
                                href="#{{$locale}}" 
                                role="tab"
                                aria-controls="{{$locale}}" 
                                aria-selected="{{$index == 0 ? 'true' : 'false'}}">
                                {{__($locale)}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                        <div class="tab-content" id="languageTabsContent">
                        @foreach (config('app.available_locales', ['en', 'ar']) as $index => $locale)
                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="{{ $locale }}" role="tabpanel" aria-labelledby="{{ $locale }}-tab">
                            <x-forms.input 
                            name="name_{{$locale}}"
                            placeholder="{{__('name in ') . __($locale)}}"
                             label="{{ __('name') }} ({{ __($locale) }})" 
                             :value="old('name_' . $locale, $isEdit ? $category->getTranslation('name', $locale) : '')" 
                             required />
                            <x-forms.textarea 
                            name="description_{{$locale}}" 
                            placeholder="{{__('description in ') . __($locale)}}"
                            label="{{ __('description') }} ({{ __($locale) }})" 
                            :value="old('description_' . $locale, $isEdit ? $category->getTranslation('description', $locale) : '')" />
                        </div>
                        @endforeach
                        </div>
                        <x-forms.switch-checkbox name="is_active" label="{{__('status')}}" :model="$category" />

                        <div class="col-12 d-flex gap-2">
                            <x-forms.submit-button label="{{__('save')}}" />
                            <x-buttons.cancel route="categories.index"/>
                        </div>
                    </x-forms.form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
