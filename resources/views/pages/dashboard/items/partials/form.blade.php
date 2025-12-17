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
                    <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                        <div class="col-md-6">
                            <x-forms.input name="name" label="{{__('name')}}" :model="$item" required />
                        </div>
                        <div class="col-md-6">
                            <x-forms.input name="code" label="{{__('code')}}" :model="$item" required />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input type="number" name="price" label="{{__('price')}}" :model="$item" required step="0.01" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input type="number" name="quantity" label="{{__('quantity')}}" :model="$item" required />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input type="number" name="discount" label="{{__('discount')}}" :model="$item" step="0.01" />
                        </div>
                        <div class="col-md-12">
                            <x-forms.textarea name="description" label="{{__('description')}}" :model="$item" />
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
