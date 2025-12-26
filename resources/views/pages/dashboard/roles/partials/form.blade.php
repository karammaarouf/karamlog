@extends('layouts.app')
@php
    $isEdit = isset($role) && $role->exists;
    $title = $isEdit ? __('Edit Role') : __('Add New Role');
    $action = $isEdit ? route('roles.update', $role) : route('roles.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Roles') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Role') : __('Add New Role') }}
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
                            <div class="tab-pane fade {{$index == 0 ? 'show active' : ''}}" id="{{$locale}}" role="tabpanel" aria-labelledby="{{$locale}}-tab">
                                <x-forms.input :value="old('name_' . $locale, $isEdit?$role->getTranslation('name', $locale) : '')" name="name_{{$locale}}" label="{{__('name')}} ({{__($locale)}})" :model="$role" required />
                                <x-forms.textarea :value="old('description_' . $locale, $isEdit?$role->getTranslation('description', $locale) : '')" name="description_{{$locale}}" label="{{__('description')}} ({{__($locale)}})" :model="$role" />
                            </div>
                        @endforeach
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach(($permissionGroups ?? collect()) as $group => $perms)
                                    <div class="col-md-4 mb-4">
                                        @php $groupKey = \Illuminate\Support\Str::slug($group); @endphp
                                        <div class="card h-100 border border-1">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">{{ __($group) }}</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input group-toggle" type="checkbox" id="group_{{ $groupKey }}" data-group="{{ $groupKey }}">
                                                    <label class="form-check-label" for="group_{{ $groupKey }}">{{ __('select all') }}</label>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @foreach($perms as $permission)
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox permission-{{ $groupKey }}" type="checkbox" id="perm_{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}" @checked(in_array($permission->name, $selectedPermissions ?? []))>
                                                        <label class="form-check-label" for="perm_{{ $permission->id }}">{{ __($permission->name) }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                          document.querySelectorAll('.group-toggle').forEach(function(toggle) {
                            var group = toggle.getAttribute('data-group');
                            var boxes = document.querySelectorAll('.permission-' + group);
                            var allChecked = boxes.length && Array.from(boxes).every(function(b){ return b.checked; });
                            toggle.checked = allChecked;
                            toggle.addEventListener('change', function() { boxes.forEach(function(b){ b.checked = toggle.checked; }); });
                          });
                        });
                        </script>

                        <div class="col-md-12 d-flex gap-2">
                            <x-forms.submit-button label="{{ $isEdit ? __('edit') : __('create') }}" />
                            <x-buttons.cancel :route="'roles.index'" />
                        </div>
                    </x-forms.form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection