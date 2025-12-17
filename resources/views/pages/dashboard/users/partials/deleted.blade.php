@extends('layouts.app')
@section('title')
    {{__('Deleted Users')}}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ __('Deleted Users') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-end align-items-center">
          @if(isset($users) && $users->count() > 0)
              @can('restore-users')
                  <x-buttons.restore-form :action="route('users.restoreAll')" 
                      text="Restore All"
                      confirmTitle="Restore all items?"
                      confirmText="This will reinstate all deleted items."
                      confirmButtonText="Yes, restore all!"
                      class="btn btn-outline-success btn-sm me-2"
                  />
              @endcan
              @can('force-delete-users')
                  <x-buttons.delete-form :action="route('users.forceDeleteAll')" 
                      text="Delete All"
                      confirmTitle="Are you sure?"
                      confirmText="You won't be able to revert this! All items will be permanently deleted."
                      confirmButtonText="Yes, delete all!"
                      class="btn btn-outline-danger btn-sm me-2"
                  />
              @endcan
          @endif
          <x-buttons.back :action="route('users.index')" />
        </div>
      </div>
      <div class="card-body">
        @if(isset($users) && $users->count() > 0)
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('email') }}</th>
                <th>{{ __('roles') }}</th>
                <th>{{ __('deleted_at') }}</th>
                @canany(['restore-users', 'force-delete-users'])
                <th>{{ __('actions') }}</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @if ($user->roles->count() > 0)
                        @foreach ($user->roles as $role)
                            <span class="badge badge-light-primary">{{ $role->name }}</span>
                        @endforeach
                    @else
                        <span class="badge badge-light-secondary">{{ __('No roles assigned') }}</span>
                    @endif
                  </td>
                  <td>{{ optional($user->deleted_at)->format('Y-m-d H:i') }}</td>
                  @canany(['restore-users', 'force-delete-users'])
                  <td>
                    @can('restore-users')
                    <x-buttons.restore-form :action="route('users.restore', $user)" />
                    @endcan
                    @can('force-delete-users')
                    <x-buttons.delete-form :action="route('users.forceDelete', $user)" />
                    @endcan 
                  </td>
                  @endcan
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <x-table.empty :message="__('There are no deleted users to display.')" />
        @endif
      </div>
      @if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->count())
          <div class="card-footer">
              @include('layouts.partials.pagination', ['page' => $users])
          </div>
      @endif
    </div>
  </div>
</div>
@endsection