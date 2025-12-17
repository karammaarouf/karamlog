@extends('layouts.app')
@section('title')
    {{__('Deleted Groups')}}
@endsection
@section('breadcrumb')
    {{ __('Groups') }}
@endsection
@section('breadcrumbActive')
    {{ __('Deleted Groups') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-end align-items-center">
          @if(isset($groups) && $groups->count() > 0)
              @can('restore-groups')
                  <x-buttons.restore-form :action="route('groups.restoreAll')" 
                      text="{{ __('Restore All') }}"
                      confirmTitle="{{ __('Restore all groups?') }}"
                      confirmText="{{ __('This will reinstate all deleted groups.') }}"
                      confirmButtonText="{{ __('Yes, restore all!') }}"
                      class="btn btn-outline-success btn-sm me-2"
                  />
              @endcan
              @can('force-delete-groups')
                  <x-buttons.delete-form :action="route('groups.forceDeleteAll')" 
                      text="{{ __('Delete All') }}"
                      confirmTitle="{{ __('Are you sure?') }}"
                      confirmText="{{ __('You won\'t be able to revert this! All groups will be permanently deleted.') }}"
                      confirmButtonText="{{ __('Yes, delete all!') }}"
                      class="btn btn-outline-danger btn-sm me-2"
                  />
              @endcan
          @endif
          <x-buttons.back :action="route('groups.index')" />
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
                @canany(['restore-groups', 'force-delete-groups'])
                <th>{{ __('actions') }}</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse(($groups ?? collect()) as $group)
                <tr>
                  <td>{{ $group->id }}</td>
                  <td>{{ $group->name }}</td>
                  <td>{{ $group->description }}</td>
                  <td>{{ optional($group->deleted_at)->format('Y-m-d H:i') }}</td>
                  @canany(['restore-groups', 'force-delete-groups'])
                  <td>
                    @can('restore-groups')
                    <x-buttons.restore-form :action="route('groups.restore', $group)" />
                    @endcan
                    @can('force-delete-groups')
                    <x-buttons.delete-form :action="route('groups.forceDelete', $group)" />
                    @endcan 
                  </td>
                  @endcan
                </tr>
              @empty
                <tr>
                  <td colspan="6">{{ __('No deleted groups found') }}</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      @if (isset($groups) && $groups instanceof \Illuminate\Pagination\LengthAwarePaginator && $groups->count())
          <div class="card-footer">
              @include('layouts.partials.pagination', ['page' => $groups])
          </div>
      @endif
    </div>
  </div>
</div>
@endsection
