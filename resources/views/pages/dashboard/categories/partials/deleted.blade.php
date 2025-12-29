@extends('layouts.app')
@section('title')
    {{ __('Deleted Categories') }}
@endsection
@section('breadcrumb')
    {{ __('Categories') }}
@endsection
@section('breadcrumbActive')
    {{ __('Deleted Categories') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end align-items-center">
                        @if (isset($categories) && $categories->count() > 0)
                            @can('restore-categories')
                                <x-buttons.restore-form :action="route('categories.restoreAll')" text="{{ __('Restore All') }}"
                                    confirmTitle="{{ __('Restore all categories?') }}"
                                    confirmText="{{ __('This will reinstate all deleted categories.') }}"
                                    confirmButtonText="{{ __('Yes, restore all!') }}"
                                    class="btn btn-outline-success btn-sm me-2" />
                            @endcan
                            @can('force-delete-categories')
                                <x-buttons.delete-form :action="route('categories.forceDeleteAll')" text="{{ __('Delete All') }}"
                                    confirmTitle="{{ __('Are you sure?') }}"
                                    confirmText="{{ __('You won\'t be able to revert this! All categories will be permanently deleted.') }}"
                                    confirmButtonText="{{ __('Yes, delete all!') }}"
                                    class="btn btn-outline-danger btn-sm me-2" />
                            @endcan
                        @endif
                        <x-buttons.back :action="route('categories.index')" />
                    </div>
                </div>
                <div class="card-body">
                    @if (isset($categories) && $categories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('description') }}</th>
                                        <th>{{ __('deleted_at') }}</th>
                                        @canany(['restore-categories', 'force-delete-categories'])
                                            <th>{{ __('actions') }}</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories ?? collect() as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>{{ optional($category->deleted_at)->format('Y-m-d H:i') }}</td>
                                            @canany(['restore-categories', 'force-delete-categories'])
                                                <td>
                                                    @can('restore-categories')
                                                        <x-buttons.restore-form :action="route('categories.restore', $category)" />
                                                    @endcan
                                                    @can('force-delete-categories')
                                                        <x-buttons.delete-form :action="route('categories.forceDelete', $category)" />
                                                    @endcan
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <x-table.empty :message="__('There are no deleted categories to display.')" />
                    @endif
                </div>
                @if (isset($categories) && $categories instanceof \Illuminate\Pagination\LengthAwarePaginator && $categories->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $categories])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
