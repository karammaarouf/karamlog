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
            <label class="form-label" for="{{ $id }}">{{ $label }}</label>
        @endif

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ $type === 'password' ? '' : ($current ?? '') }}"
            @if($required) required @endif
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