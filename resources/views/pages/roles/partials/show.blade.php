@extends('layouts.app')
@section('title')
    {{ __('role details') }}
@endsection
@section('subTitle')
    {{ __('role details') }}
@endsection
@section('breadcrumb')
    {{ __('roles') }}
@endsection
@section('breadcrumbActive')
    {{__('show')}}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{__('role details')}}</h5>
        <div>
          @isset($role)
          <x-buttons.edit :action="route('roles.edit', $role)" />
          @endisset
          <x-buttons.back :action="route('roles.index')" />
        </div>
      </div>
      <div class="card-body">
        @isset($role)
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width: 200px">#</th>
                <td>{{ $role->id }}</td>
              </tr>
              <tr>
                <th>{{__('name')}}</th>
                <td>{{ $role->name }}</td>
              </tr>
              <tr>
                <th>{{__('created at')}}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($role->created_at)->format('Y-m-d H:i') }}</td>
              </tr>
              <tr>
                <th>{{__('updated at')}}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($role->updated_at)->format('Y-m-d H:i') }}</td>
              </tr>
              <tr>
                <th>{{ __('permissions') }}</th>
                <td>
                  @php $groups = $role->permissions->groupBy('group_name'); @endphp
                  <div class="row">
                    @forelse($groups as $group => $perms)
                      <div class="col-md-3">
                        <div class="card h-100 border border-1">
                          <div class="card-header">
                            <h6 class="mb-0">{{ __($group) }}</h6>
                          </div>
                          <div class="card-body">
                            @foreach($perms as $permission)
                              <div><span class="badge bg-primary me-1">{{ $permission->name }}</span></div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    @empty
                      <span class="text-muted">{{ __('No permissions') }}</span>
                    @endforelse
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        @else
          <p class="text-muted">{{__('no role data to display')}}</p>
        @endisset
      </div>
    </div>
  </div>
</div>
@endsection