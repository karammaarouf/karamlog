@props(['title', 'value', 'percentage', 'text' => __('Compare to last month'), 'id', 'data', 'categories', 'color' => null])

<div class="col-xl-4 col-md-12 box-col-12">
    <div class="card overflow-hidden">
        <div class="chart-widget-top">
            <div class="row card-body pb-0 m-0">
                <div class="col-xl-9 col-lg-8 col-9 p-0">
                    <h3 class="mb-2">{{ $title }}</h3>
                    <h3>{{ $value }}</h3>
                    <span>{{ $text }}</span>
                </div>
                <div class="col-xl-3 col-lg-4 col-3 text-end p-0">
                    <h6 class="{{ $percentage >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $percentage >= 0 ? '+' : '' }}{{ number_format($percentage, 1) }}%
                    </h6>
                </div>
            </div>
            <div>
                <div id="{{ $id }}"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof initDashboardChart === 'function') {
                initDashboardChart("#{{ $id }}", @json($data), @json($categories), "{{ $color }}");
            }
        });
    </script>
@endpush
