@extends('layouts.app')
@section('title')
    {{ __('Categories List') }}
@endsection
@section('breadcrumb')
    {{ __('Categories') }}
@endsection
@section('breadcrumbActive')
    {{ __('Categories List') }}
@endsection
@section('content')
    <x-cards.container>
        <x-cards.card :value="$categoriesCount" label="{{ __('Total Categories') }}" icon="menu" roundColor="primary" trendText="+0%"
            trendClass="font-primary" />
        <x-cards.card :value="$activeCategories" label="{{ __('Active Categories') }}" icon="eye" iconLib="feather"
            roundColor="success" />
        <x-cards.card :value="$inactiveCategories" label="{{ __('Inactive Categories') }}" icon="eye-off" iconLib="feather"
            roundColor="danger" />
    </x-cards.container>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="categories.index" placeholder="{{ __('search categories') }}" />
                        @can('create-categories')
                            <x-buttons.create :action="route('categories.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('description') }}</th>
                                    <th>{{ __('status') }}</th>
                                    @canany(['update-categories', 'delete-categories'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            @can('update-categories')
                                                <x-buttons.toggle-active :model="$category" action="categories.toggleActive" />
                                            @else
                                                <span
                                                    class="badge bg-{{ $category->is_active ? 'success' : 'danger' }}">{{ $category->is_active ? __('active') : __('inactive') }}</span>
                                            @endcan
                                        </td>
                                        @canany(['update-categories', 'delete-categories'])
                                            <td>
                                                @can('update-categories')
                                                    <x-buttons.edit :action="route('categories.edit', $category)" />
                                                @endcan
                                                @can('delete-categories')
                                                    <x-buttons.delete-form :action="route('categories.destroy', $category)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No categories found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($categories->count())
                                <x-table.tfoot :page="$categories" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($categories->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $categories])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
