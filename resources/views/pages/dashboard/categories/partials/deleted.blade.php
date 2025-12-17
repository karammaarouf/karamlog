@extends('layouts.app')
@section('title')
    {{__('Deleted Categories')}}
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
          <x-buttons.back :action="route('categories.index')" />
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
                <th>{{ __('deleted_at') }}</th>
                @canany(['restore-categories', 'force-delete-categories'])
                <th>{{ __('actions') }}</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse(($categories ?? collect()) as $category)
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
              @empty
                <tr>
                  <td colspan="6">{{ __('No deleted categories found') }}</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
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
