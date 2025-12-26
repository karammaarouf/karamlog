@extends('layouts.app')
@php
    $isEdit = isset($item) && $item->exists;
    $title = $isEdit ? __('Edit Item') : __('Add New Item');
    $action = $isEdit ? route('items.update', $item) : route('items.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Items') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Item') : __('Add New Item') }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end align-items-center">
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="itemTabs" role="tablist">
                        @foreach (config('app.available_locales',['en','ar']) as $locale)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $locale }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $locale }}" type="button" role="tab" aria-controls="{{ $locale }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{{__($locale)}}}</button>
                            </li>
                        @endforeach
                    </ul>
                    <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                                                    <div class="tab-content" id="languageTabsContent">
                                                        @foreach (config('app.available_locales',['en','ar']) as $locale)
                                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                                id="{{ $locale }}" role="tabpanel"
                                                                aria-labelledby="{{ $locale }}-tab">
                                                                <x-forms.input :value="old('name_' . $locale,$isEdit ? $item->getTranslation('name', $locale) : '')" name="name_{{ $locale }}" label="{{ __('name') }} ({{ __($locale) }})" :model="$item"
                                                                    required />
                                                                <x-forms.textarea :value="old('description_' . $locale,$isEdit ? $item->getTranslation('description', $locale) : '')" name="description_{{ $locale }}" label="{{ __('description') }} ({{ __($locale) }})"
                                                                    :model="$item" />
                                                            </div>
                                                        @endforeach
                                                    </div>
                        <div class="col-md-6">
                            <x-forms.input name="code" label="{{__('code')}}" :model="$item" required />
                        </div>
                        <div class="col-md-6">
                            <x-forms.input type="number" name="price" label="{{__('price')}}" :model="$item" required step="0.01" />
                        </div>
                        <div class="col-md-6">
                            <x-forms.input type="number" name="quantity" label="{{__('quantity')}}" :model="$item" required />
                        </div>
                        <div class="col-md-6">
                            <x-forms.input type="number" name="discount" label="{{__('discount')}}" :model="$item" step="0.01" />
                        </div>
                        <div class="col-md-12">
                             <x-forms.switch-checkbox name="is_active" label="{{__('status')}}" :model="$item" />
                        </div>
                        <div class="col-12 d-flex gap-2">
                            <x-forms.submit-button label="{{__('save')}}" />
                            <x-buttons.cancel route="items.index"/>
                        </div>
                    </x-forms.form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
