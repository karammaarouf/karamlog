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
                    <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                        <x-forms.input name="name" label="{{__('name')}}" :model="$group" required />
                        <x-forms.textarea name="description" label="{{__('description')}}" :model="$group" />
                        <x-forms.switch-checkbox name="is_active" label="{{__('status')}}" :model="$group" />
                        <div class="col-12 d-flex gap-2">
                            <x-forms.submit-button label="{{__('save')}}" />
                            <x-buttons.cancel route="groups.index"/>
                        </div>
                    </x-forms.form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
