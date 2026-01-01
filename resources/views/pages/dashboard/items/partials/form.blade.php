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

                            <x-forms.input name="code" label="{{__('code')}}" :model="$item" col="6" required />
                            <x-forms.input type="number" name="price" label="{{__('price')}}" :model="$item" col="6" required step="0.01" /> 
                            <x-forms.input type="number" name="quantity" label="{{__('quantity')}}" :model="$item" col="6" required />
                            <x-forms.input type="number" name="discount" label="{{__('discount')}}" :model="$item" col="6" step="0.01" />
                            <x-forms.multiple-select id="choices-multiple-groups" name="group_ids" label="{{__('groups')}}" :model="$item" :value="old('group_ids',$isEdit ? $item->groups->pluck('id')->all() : [])" :options="$groups->pluck('name','id')" col="12" />
                            <x-forms.multiple-select name="category_ids" label="{{__('categories')}}" :model="$item" :value="old('category_ids',$isEdit ? $item->categories->pluck('id')->all() : [])" :options="$categories->pluck('name','id')" col="12" />
                            <x-forms.switch-checkbox name="is_active" label="{{__('status')}}" col="12" :model="$item" />

                        <div class="col-12 mb-3 d-flex justify-content-center">
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#itemDetailsCollapse" aria-expanded="false" aria-controls="itemDetailsCollapse" onclick="this.querySelector('i').classList.toggle('fa-plus'); this.querySelector('i').classList.toggle('fa-times');">
                                <i class="fas fa-plus me-1"></i> {{ __('Add More Details') }}
                            </button>
                        </div>

                        <div class="collapse col-12" id="itemDetailsCollapse">
                            <div class="card card-body bg-light text-dark">
                                <div class="row g-3">
                                    <x-forms.input name="details[width]" label="{{ __('Width') }}" :value="old('details.width', $item->details->width ?? '')" col="3" />
                                    <x-forms.input name="details[height]" label="{{ __('Height') }}" :value="old('details.height', $item->details->height ?? '')" col="3" />
                                    <x-forms.input name="details[depth]" label="{{ __('Depth') }}" :value="old('details.depth', $item->details->depth ?? '')" col="3" />
                                    <x-forms.input name="details[weight]" label="{{ __('Weight') }}" :value="old('details.weight', $item->details->weight ?? '')" col="3" />

                                    <x-forms.input name="details[material]" label="{{ __('Material') }}" :value="old('details.material', $item->details->material ?? '')" col="4" />
                                    <x-forms.input name="details[color]" label="{{ __('Color') }}" :value="old('details.color', $item->details->color ?? '')" col="4" />
                                    <x-forms.input name="details[size]" label="{{ __('Size') }}" :value="old('details.size', $item->details->size ?? '')" col="4" />

                                    <x-forms.input name="details[shape]" label="{{ __('Shape') }}" :value="old('details.shape', $item->details->shape ?? '')" col="4" />
                                    <x-forms.input name="details[type]" label="{{ __('Type') }}" :value="old('details.type', $item->details->type ?? '')" col="4" />
                                    <x-forms.input name="details[brand]" label="{{ __('Brand') }}" :value="old('details.brand', $item->details->brand ?? '')" col="4" />

                                    <x-forms.input name="details[model]" label="{{ __('Model') }}" :value="old('details.model', $item->details->model ?? '')" col="6" />
                                    <x-forms.input name="details[serial_number]" label="{{ __('Serial Number') }}" :value="old('details.serial_number', $item->details->serial_number ?? '')" col="6" />
                                                                                                                 
                                    <x-forms.textarea name="details[other_details]" label="{{ __('Other Details') }}" :value="old('details.other_details', $item->details->other_details ?? '')" col="12" />
                                </div>
                            </div>
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
