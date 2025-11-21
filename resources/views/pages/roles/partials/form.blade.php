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

                        <x-forms.select name="permissions" label="{{ __('permissions') }}" :options="$permissionsOptions ?? []" :value="$selectedPermissions ?? []" multiple col="12" />

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