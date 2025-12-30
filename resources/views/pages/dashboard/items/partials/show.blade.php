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
                <td>{{ $item->discount }} %</td>
              </tr>
              <tr>
                <th>{{__('description')}}</th>
                <td>{{ $item->description ?? __('No description') }}</td>
              </tr>
              <tr>
                <th>{{__('status')}}</th>
                <td class="text-{{ $item->is_active ? 'success' : 'danger' }}">{{ $item->is_active ? __('active') : __('inactive') }}</td>
              </tr>
              <tr>
                <th>{{__('categories')}}</th>
                <td>
                  @forelse($item->categories as $category)
                   <span class="badge badge-light-primary">{{ $category->name }}</span>
                  @empty
                  <span class="badge badge-light-secondary">{{ __('no categories') }}</span>
                  @endforelse</td>
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

    @if(isset($item) && $item->details)
    <div class="card mt-3">
        <div class="card-header">
            <h5>{{ __('Item Specifications') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        @if($item->details->width) <tr> <th style="width: 200px">{{ __('Width') }}</th> <td>{{ $item->details->width }}</td> </tr> @endif
                        @if($item->details->height) <tr> <th>{{ __('Height') }}</th> <td>{{ $item->details->height }}</td> </tr> @endif
                        @if($item->details->depth) <tr> <th>{{ __('Depth') }}</th> <td>{{ $item->details->depth }}</td> </tr> @endif
                        @if($item->details->weight) <tr> <th>{{ __('Weight') }}</th> <td>{{ $item->details->weight }}</td> </tr> @endif

                        @if($item->details->material) <tr> <th>{{ __('Material') }}</th> <td>{{ $item->details->material }}</td> </tr> @endif
                        @if($item->details->color) <tr> <th>{{ __('Color') }}</th> <td>{{ $item->details->color }}</td> </tr> @endif
                        @if($item->details->size) <tr> <th>{{ __('Size') }}</th> <td>{{ $item->details->size }}</td> </tr> @endif

                        @if($item->details->shape) <tr> <th>{{ __('Shape') }}</th> <td>{{ $item->details->shape }}</td> </tr> @endif
                        @if($item->details->type) <tr> <th>{{ __('Type') }}</th> <td>{{ $item->details->type }}</td> </tr> @endif
                        @if($item->details->brand) <tr> <th>{{ __('Brand') }}</th> <td>{{ $item->details->brand }}</td> </tr> @endif

                        @if($item->details->model) <tr> <th>{{ __('Model') }}</th> <td>{{ $item->details->model }}</td> </tr> @endif
                        @if($item->details->serial_number) <tr> <th>{{ __('Serial Number') }}</th> <td>{{ $item->details->serial_number }}</td> </tr> @endif

                        @if($item->details->other_details) <tr> <th>{{ __('Other Details') }}</th> <td>{{ $item->details->other_details }}</td> </tr> @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
  </div>
</div>
@endsection
