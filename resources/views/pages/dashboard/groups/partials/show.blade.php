@extends('layouts.app')
@section('title')
    {{ __('Group Details') }}
@endsection
@section('breadcrumb')
    {{ __('Groups') }}
@endsection
@section('breadcrumbActive')
    {{ __('group details') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-end align-items-center">
        <div>
          @isset($group)
          @can('update-groups')
          <x-buttons.edit :action="route('groups.edit', $group)" />
          @endcan 
          @endisset
          <x-buttons.back :action="route('groups.index')" />
        </div>
      </div>
      <div class="card-body">
        @isset($group)
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width: 200px">#</th>
                <td>{{ $group->id }}</td>
              </tr>
              <tr>
                <th>{{ __('name') }}</th>
                <td>{{ $group->name }}</td>
              </tr>
              <tr>
                <th>{{ __('description') }}</th>
                <td>{{ $group->description }}</td>
              </tr>
              <tr>
                <th>{{ __('status') }}</th>
                <td class="text-{{ $group->is_active ? 'success' : 'danger' }}">{{ $group->is_active ? __('active') : __('inactive') }}</td>
              </tr>
              <tr>
                <th>{{ __('created at') }}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($group->created_at)->format('Y-m-d H:i') }}</td>
              </tr>
              <tr>
                <th>{{ __('updated at') }}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($group->updated_at)->format('Y-m-d H:i') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        @else
          <p class="text-muted">{{ __('no group data to display') }}</p>
        @endisset
      </div>
    </div>
  </div>
</div>
@endsection
