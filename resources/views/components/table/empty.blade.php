@props([
    'message' => __('There are no data to display.'),
    'icon' => 'fa-solid fa-folder-open text-primary',
    'label' => __('No Data Found')
    ])

<div class="text-center p-5">
    <div class="mb-3">
        <div class="bg-light-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
            <i class="{{ $icon }}" style="font-size: 30px;"></i>
        </div>
    </div>
    <h5 class="f-w-600 mb-1">{{ $label }}</h5>
    <p class="text-muted mb-0">{{ $message }}</p>
</div>