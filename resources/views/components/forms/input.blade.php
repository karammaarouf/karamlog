@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'model' => null,
    'id' => null,
    'help' => null,
    'col' => 12,
    'required' => false,
    'textColor' => 'text-dark',
    'placeholder' => null,
])

@php
    $id = $id ?? $name . '_input';
    $rawValue = $value ?? ($model ? data_get($model, $name) : null);

    if ($type === 'date' && $rawValue instanceof \DateTimeInterface) {
        $rawValue = $rawValue->format('Y-m-d');
    }

    $current = old($name, $rawValue);
@endphp

<div class="col-md-{{ $col }}">
    <div class="mb-3">
        @if($label)
            <label class="form-label {{ $textColor }}" for="{{ $id }}">{{ $label }}@if($required) <span class="text-danger">*</span> @endif</label>
        @endif

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            placeholder="{{ $placeholder ?? '' }}"
            value="{{ $type === 'password' ? '' : ($current ?? '') }}"
            @if($required) required @endif
            @if($type === 'number') step="0.01" @endif
            {{ $attributes->merge(['class' => 'form-control']) }}
        >

        @error($name)
            <div class="text-danger small">{{ $message }}</div>
        @enderror

        @if($help)
            <div class="form-text">{{ $help }}</div>
        @endif
    </div>
</div>