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
                <div class="card h-100 border-1 shadow-none">
                    <div class="card-body d-flex flex-column p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="card-title mb-0 text-truncate fw-bold" style="max-width: 70%;" title="{{ $item->name }}">{{ $item->name }}</h6>
                            @if($item->quantity <= 0)
                                <span class="badge bg-light text-danger border border-danger px-2 py-1" style="font-size: 0.7rem;">{{ __('Out') }}</span>
                            @endif
                        </div>
                        
                        <p class="text-muted small text-truncate mb-4">{{ $item->description }}</p>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top border-light">
                            <h5 class="mb-0 text-primary fw-bold">${{ number_format($item->price, 2) }}</h5>
                            
                            @if($item->quantity > 0)
                                <button class="btn btn-primary btn-sm px-3 rounded-3" title="{{ __('Add to Cart') }}">
                                    <i class="iconly-Buy icli"></i>
                                </button>
                            @endif
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
