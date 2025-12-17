@extends('layouts.app')
@section('title')
    {{ __('Item Details') }}
@endsection
@section('breadcrumb')
    {{ __('Items') }}
@endsection
@section('breadcrumbActive')
    {{__('item details')}}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-end align-items-center">
        <div>
          @isset($item)
          @can('update-items')
          <x-buttons.edit :action="route('items.edit', $item)" />
          @endcan 
          @endisset
          <x-buttons.back :action="route('items.index')" />
        </div>
      </div>
      <div class="card-body">
        @isset($item)
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width: 200px">#</th>
                <td>{{ $item->id }}</td>
              </tr>
              <tr>
                <th>{{__('name')}}</th>
                <td>{{ $item->name }}</td>
              </tr>
              <tr>
                <th>{{__('code')}}</th>
                <td>{{ $item->code }}</td>
              </tr>
              <tr>
                <th>{{__('price')}}</th>
                <td>{{ $item->price }}</td>
              </tr>
              <tr>
                <th>{{__('quantity')}}</th>
                <td>{{ $item->quantity }}</td>
              </tr>
              <tr>
                <th>{{__('discount')}}</th>
                <td>{{ $item->discount }}</td>
              </tr>
              <tr>
                <th>{{__('description')}}</th>
                <td>{{ $item->description ?? __('No description') }}</td>
              </tr>
              <tr>
                <th>{{__('status')}}</th>
                <td>{{ $item->is_active ? __('active') : __('inactive') }}</td>
              </tr>
              <tr>
                <th>{{__('created at')}}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</td>
              </tr>
              <tr>
                <th>{{__('updated at')}}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($item->updated_at)->format('Y-m-d H:i') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        @else
          <p class="text-muted">{{__('no item data to display')}}</p>
        @endisset
      </div>
    </div>
  </div>
</div>
@endsection
