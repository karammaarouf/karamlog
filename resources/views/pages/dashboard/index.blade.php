@extends('layouts.app')

@section('title', __('Dashboard'))
@section('breadcrumb')
    {{ __('Dashboard') }}
@endsection
@section('breadcrumbActive')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <div class="row">
        <x-widgets.chart 
            title="{{ __('Total Inventory Value') }}"
            value="${{ number_format($itemData['total_value'], 2) }}"
            :percentage="$itemData['percentage_change']"
            text="{{ __('Compare to last month') }}"
            id="chart-widget1"
            :data="$itemData['chart_data']"
            :categories="$itemData['categories']"
        />
        <x-widgets.chart 
            title="{{ __('Total Users') }}"
            value="{{ number_format($userData['total_users'], 0) }}"
            :percentage="$userData['percentage_change']"
            text="{{ __('Compare to last month') }}"
            id="chart-widget2"
            :data="$userData['chart_data']"
            :categories="$userData['categories']"
            color="#FF5733"
        />
        <x-widgets.chart 
            title="{{ __('Total Groups') }}"
            value="{{ number_format($groupData['total_groups'], 0) }}"
            :percentage="$groupData['percentage_change']"
            text="{{ __('Compare to last month') }}"
            id="chart-widget3"
            :data="$groupData['chart_data']"
            :categories="$groupData['categories']"
            color="#33FF57"
        />
        <div class="col-md-12 box-col-12">
            <div class="card overflow-hidden">
                <div class="card-header card-no-border pb-0">
                    <h3>{{ __('Monthly History') }}</h3>
                </div>
                <div class="bar-chart-widget">
                    <div class="bottom-content card-body">
                        <div class="row">
                            <div class="col-12">
                                <div id="chart-widget4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var monthlyHistoryData = @json($monthlyHistoryData);
    </script>
    <script src="{{ asset('assets/js/dashboard-chart-init.js') }}"></script>
@endpush
