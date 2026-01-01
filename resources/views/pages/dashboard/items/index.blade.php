@extends('layouts.app')
@section('title')
    {{ __('Items List') }}
@endsection
@section('breadcrumb')
    {{ __('Items') }}
@endsection
@section('breadcrumbActive')
    {{ __('Items List') }}
@endsection
@section('content')
    <x-cards.container>
        <x-cards.card :value="$itemsCount ?? 0" label="{{ __('Total Items') }}" icon="shopping-bag" roundColor="primary" trendText="+0%"
            trendClass="font-primary" />
        <x-cards.card :value="$activeItems ?? 0" label="{{ __('Active Items') }}" icon="eye" roundColor="success" />
        <x-cards.card :value="$inactiveItems ?? 0" label="{{ __('Inactive Items') }}" icon="eye-off" roundColor="danger" />
    </x-cards.container>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="items.index" placeholder="{{ __('search items') }}" />
                        @can('create-items')
                            <x-buttons.create :action="route('items.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($items) && $items->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th>{{ __('quantity') }}</th>
                                    <th>{{ __('groups') }}</th>
                                    <th>{{ __('categories') }}</th>
                                    <th>{{ __('status') }}</th>
                                    @canany(['update-items', 'delete-items'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(($items ?? collect()) as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                           <span class="badge badge-light-{{ $item->quantity > 0 ? 'success' : 'danger' }}">{{ $item->quantity }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-{{ $item->groups_count ? 'primary' : 'secondary' }}">{{ $item->groups_count }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-{{ $item->categories_count ? 'primary' : 'secondary' }}">{{ $item->categories_count }}</span>
                                        </td>
                                        <td>
                                            @can('update-items')
                                                <x-buttons.toggle-active :model="$item" action="items.toggleActive" />
                                            @else
                                                <span
                                                    class="badge badge-light-{{ $item->is_active ? 'success' : 'danger' }}">{{ $item->is_active ? __('active') : __('inactive') }}</span>
                                            @endcan
                                        </td>
                                        @canany(['update-items', 'delete-items'])
                                            <td>
                                                @can('view-items')
                                                    <x-buttons.show :action="route('items.show', $item)" />
                                                @endcan
                                                @can('update-items')
                                                    <x-buttons.edit :action="route('items.edit', $item)" />
                                                @endcan
                                                @can('delete-items')
                                                    <x-buttons.delete-form :action="route('items.destroy', $item)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                            <x-table.tfoot :page="$items" />
                        </table>
                    </div>
                    @else
                    <x-table.empty :message="__('There are no items to display.')" />
                    @endif
                </div>
                @if (isset($items) && $items->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $items])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
