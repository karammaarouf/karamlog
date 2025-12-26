@extends('layouts.customer-app')

@section('title', __('Shop'))

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
                <div class="project-box font-dark bg-light-primary">
                    <span class="badge {{ $item->quantity > 0 ? 'badge-primary' : 'badge-danger' }}">{{ $item->quantity > 0 ? __('In Stock') : __('Out of Stock') }}</span>
                    <h5 class="f-w-500 mb-2 text-primary text-truncate">{{ $item->name }}</h5>
                    <div class="d-flex mb-2 align-items-center">
                        <p class="font-light text-truncate">{{ $item->description }}</p>
                    </div>
                    <div class="row details">
                        <div class="col-6"><span>{{ __('Price') }}</span></div>
                        <div class="col-6 font-primary">${{ number_format($item->price, 2) }}</div>
                    </div>
                    <div class="project-status mt-4">
                        <div class="d-flex align-items-center gap-1 mb-2">
                             <button class="btn btn-primary btn-sm w-100" {{ $item->quantity <= 0 ? 'disabled' : '' }}>
                                <i class="iconly-Buy icli me-1"></i> {{ __('Add to Cart') }}
                            </button>
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
