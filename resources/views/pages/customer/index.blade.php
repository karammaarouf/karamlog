@extends('layouts.customer-app')

@section('title', __('Shop'))

@section('content')
<div class="container-fluid product-wrapper bg-light">
    <!-- Search Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('customer.index') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white"><i class="iconly-Search icli"></i></span>
                            <input type="text" name="search" class="form-control form-control-lg" placeholder="{{ __('Search for items...') }}" value="{{ request('search') }}">
                            <button class="btn btn-primary px-4" type="submit">{{ __('Search') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filters (Groups & Categories) -->
        <div class="col-xl-3 col-lg-4 col-md-12 mb-4">
            <!-- Groups Card -->
            @if($groups->count() > 0)
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 pb-0">
                    <h5 class="mb-0 text-primary fw-bold"><i class="iconly-Filter icli me-2"></i>{{ __('Groups') }}</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('customer.index', array_merge(request()->except('group'), ['group' => null])) }}" 
                           class="btn btn-sm {{ !request('group') ? 'btn-primary' : 'btn-outline-primary' }} w-100 text-start">
                           <i class="iconly-Category icli me-2"></i>{{ __('All Groups') }}
                        </a>
                        @foreach($groups as $group)
                            <a href="{{ route('customer.index', array_merge(request()->except('group'), ['group' => $group->id])) }}" 
                               class="btn btn-sm {{ request('group') == $group->id ? 'btn-primary' : 'btn-outline-primary' }} w-100 text-start">
                                <i class="iconly-Folder icli me-2"></i>{{ $group->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Categories Card -->
            @if($categories->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 pb-0">
                    <h5 class="mb-0 text-primary fw-bold"><i class="iconly-Paper icli me-2"></i>{{ __('Categories') }}</h5>
                </div>
                <div class="card-body">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link {{ !request('category') ? 'active' : '' }} mb-2" 
                           href="{{ route('customer.index', array_merge(request()->except('category'), ['category' => null])) }}">
                           <i class="iconly-Discovery icli me-2"></i>{{ __('All Categories') }}
                        </a>
                        @foreach($categories as $category)
                            <a class="nav-link {{ request('category') == $category->id ? 'active' : '' }} mb-2" 
                               href="{{ route('customer.index', array_merge(request()->except('category'), ['category' => $category->id])) }}">
                                <i class="iconly-Document icli me-2"></i>{{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Items Grid -->
        <div class="col-xl-9 col-lg-8 col-md-12">
            <div class="row">
                <div class="col-12 mb-3">
                    <h4 class="fw-bold text-dark">{{ __('Items') }} <span class="badge bg-light-primary text-dark border">{{ $items->total() }}</span></h4>
                </div>
                @forelse($items as $item)
                    <div class="col-xl-4 col-md-6 col-sm-12 mb-4">
                        <div class="card h-100 shadow-sm border-0 hover-card project-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge {{ $item->quantity > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                        {{ $item->quantity > 0 ? __('In Stock') : __('Out of Stock') }}
                                    </span>
                                    <h5 class="text-primary fw-bold mb-0">${{ number_format($item->price, 2) }}</h5>
                                </div>
                                <h5 class="card-title fw-bold text-dark text-truncate mb-2" title="{{ $item->name }}">{{ $item->name }}</h5>
                                <p class="card-text text-muted small mb-3 text-truncate" title="{{ $item->description }}">{{ $item->description }}</p>
                                
                                <div class="mt-auto">
                                    <button class="btn btn-outline-primary w-100 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#itemModal{{ $item->id }}">
                                        <i class="iconly-Show icli me-2"></i> {{ __('View Details') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item Details Modal -->
                    <div class="modal fade" id="itemModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title fw-bold text-primary">{{ $item->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="bg-light p-4 rounded-3 text-center h-100 d-flex align-items-center justify-content-center">
                                                <!-- Placeholder for item image -->
                                                <i class="iconly-Image icli text-muted display-1"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="text-primary fw-bold mb-3">${{ number_format($item->price, 2) }}</h4>
                                            <p class="text-muted mb-4">{{ $item->description }}</p>
                                            
                                            <div class="mb-3">
                                                <span class="badge {{ $item->quantity > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                                                    {{ $item->quantity > 0 ? __('In Stock') : __('Out of Stock') }}
                                                </span>
                                            </div>

                                            @if($item->details)
                                            <div class="mt-4">
                                                <h6 class="fw-bold mb-2 border-bottom pb-2">{{ __('Specifications') }}</h6>
                                                <div class="row g-2">
                                                    @foreach($item->details->toArray() as $key => $value)
                                                        @if($value && !in_array($key, ['id', 'item_id', 'created_at', 'updated_at']))
                                                            <div class="col-6">
                                                                <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem;">{{ str_replace('_', ' ', $key) }}</small>
                                                                <span class="fw-medium">{{ $value }}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card shadow-sm border-0 p-5 text-center">
                            <div class="card-body">
                                <img src="{{ asset('assets/images/no-data.png') }}" alt="No Items" class="img-fluid mb-3" style="max-width: 200px; opacity: 0.7;">
                                <h4 class="text-muted">{{ __('No items found') }}</h4>
                                <p class="text-muted mb-0">{{ __('Try adjusting your search or filters.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $items->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles that complement Bootstrap but don't override its core dark/light logic */
    .product-wrapper {
        padding-top: 20px;
    }
    
    .hover-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    
    /* Nav pills customization using CSS variables for better theme compatibility */
    .nav-pills .nav-link {
        color: var(--bs-body-color);
        transition: all 0.3s;
    }
    
    .nav-pills .nav-link:hover:not(.active) {
        background-color: var(--bs-secondary-bg);
        color: var(--bs-primary);
    }
    
    .nav-pills .nav-link.active {
        background-color: var(--bs-primary);
        color: #fff;
    }
</style>
@endsection
