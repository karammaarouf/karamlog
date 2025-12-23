@extends('layouts.customer-app')

@section('title', __('Shop'))
@section('subTitle', __('Browse our collection'))

@section('content')
    <!-- Search Section -->
    <div class="row mb-4">
        <div class="col-12">
            <form action="{{ route('customer.index') }}" method="GET" class="card shadow-sm">
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="{{ __('Search for items...') }}" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit"><i class="iconly-Search icli"></i> {{ __('Search') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Groups Section -->
    @if($groups->count() > 0)
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <h4>{{ __('Groups') }}</h4>
        </div>
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('customer.index', array_merge(request()->except('group'), ['group' => null])) }}" 
                   class="btn {{ !request('group') ? 'btn-primary' : 'btn-outline-primary' }}">
                    {{ __('All Groups') }}
                </a>
                @foreach($groups as $group)
                    <a href="{{ route('customer.index', array_merge(request()->except('group'), ['group' => $group->id])) }}" 
                       class="btn {{ request('group') == $group->id ? 'btn-primary' : 'btn-outline-primary' }}">
                        {{ $group->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Categories Section -->
    @if($categories->count() > 0)
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <h4>{{ __('Categories') }}</h4>
        </div>
        <div class="col-12">
            <div class="nav nav-pills" id="pills-tab" role="tablist">
                <a class="nav-link {{ !request('category') ? 'active' : '' }}" 
                   href="{{ route('customer.index', array_merge(request()->except('category'), ['category' => null])) }}">
                   {{ __('All Categories') }}
                </a>
                @foreach($categories as $category)
                    <a class="nav-link {{ request('category') == $category->id ? 'active' : '' }}" 
                       href="{{ route('customer.index', array_merge(request()->except('category'), ['category' => $category->id])) }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Items Grid -->
    <div class="row">
        <div class="col-12 mb-2">
            <h4>{{ __('Items') }}</h4>
        </div>
        @forelse($items as $item)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 shadow-sm">
                    {{-- <img src="{{ $item->image_url ?? asset('assets/images/product/1.png') }}" class="card-img-top p-3" alt="{{ $item->name }}" style="height: 200px; object-fit: contain;"> --}}
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text text-muted text-truncate">{{ $item->description }}</p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="h5 mb-0 text-primary">${{ number_format($item->price, 2) }}</span>
                                @if($item->quantity > 0)
                                    <span class="badge bg-success">{{ __('In Stock') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('Out of Stock') }}</span>
                                @endif
                            </div>
                            <button class="btn btn-primary w-100">{{ __('View Details') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    {{ __('No items found matching your criteria.') }}
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $items->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
