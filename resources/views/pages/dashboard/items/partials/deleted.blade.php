@extends('layouts.app')
@section('title')
    {{ __('Deleted Items') }}
@endsection
@section('breadcrumb')
    {{ __('Items') }}
@endsection
@section('breadcrumbActive')
    {{ __('Deleted Items') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end align-items-center">
                        <x-buttons.back :action="route('items.index')" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th>{{ __('deleted at') }}</th>
                                    <th>{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($items ?? collect()) as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->deleted_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            @can('restore-items')
                                                <x-buttons.restore-form :action="route('items.restore', $item)" />
                                            @endcan
                                            @can('force-delete-items')
                                                <x-buttons.delete-form :action="route('items.forceDelete', $item)" />
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No deleted items found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if (isset($items) && $items->count())
                                <x-table.tfoot :page="$items" />
                            @endif
                        </table>
                    </div>
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
