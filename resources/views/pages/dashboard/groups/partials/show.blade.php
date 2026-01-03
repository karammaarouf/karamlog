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
                <th>{{__('items')}}</th>
                <td><span class="badge badge-light-{{ $group->items->count() > 0 ? 'primary' : 'secondary' }}">{{ $group->items->count() }}</span></td>
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
    <div class="card">
      <div class="card-header">
        <h3>{{ __('Items') . ' (' . $group->items->count() . ')' }}</h3>
      </div>
      <div class="card-body">
        @if($group->items->count() > 0)
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>{{ __('name') }}</th>
                <th>{{ __('description') }}</th>
                <th>{{ __('status') }}</th>
                <th>{{ __('quantity') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($group->items as $item)
              <tr>
                <td><a href="{{ route('items.show', $item) }}">{{ $item->name }}</a></td>
                <td>{{ $item->description }}</td>
                <td class="text-{{ $item->is_active ? 'success' : 'danger' }}">{{ $item->is_active ? __('active') : __('inactive') }}</td>
                <td><span class="badge badge-light-{{ $item->quantity > 0 ? 'success' : 'danger' }}">{{ $item->quantity }}</span></td>
              </tr>
              @endforeach
        </tbody>
      </table>
    </div>
    @else
      <x-table.empty />
    @endif
  </div>
</div>
@endsection
