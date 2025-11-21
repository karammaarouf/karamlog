@extends('layouts.app')
@php
    $isEdit = isset($role) && $role->exists;
    $title = $isEdit ? __('edit role') : __('add new role');
    $action = $isEdit ? route('roles.update', $role) : route('roles.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('subTitle')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('roles') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('edit role') : __('add new role') }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                        <x-forms.input name="name" label="{{__('name')}}" :model="$role" required />

                        <div class="col-md-12">
                            <div class="row">
                                @foreach(($permissionGroups ?? collect()) as $group => $perms)
                                    <div class="col-md-4">
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
                                                        <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
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