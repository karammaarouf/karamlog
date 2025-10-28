@extends('layouts.app')
@section('title')
    {{ __('user details') }}
@endsection
@section('subTitle')
    {{ __('user details') }}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{__('show')}}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{__('user details')}}</h5>
        <div>
          @isset($user)
            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">{{__('edit')}}</a>
          @endisset
          <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary ms-2">{{__('back')}}</a>
        </div>
      </div>
      <div class="card-body">
        @isset($user)
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width: 200px">#</th>
                <td>{{ $user->id }}</td>
              </tr>
              <tr>
                <th>{{__('name')}}</th>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <th>{{__('email')}}</th>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <th>{{__('email verified')}}</th>
                <td>{{ $user->email_verified_at ? __('yes') : __('no') }}</td>
              </tr>
              <tr>
                <th>{{__('active')}}</th>
                <td>{{ $user->is_active ? __('yes') : __('no') }}</td>
              </tr>
              <tr>
                <th>{{__('roles')}}</th>
                <td>
                  @if($user->roles && $user->roles->count())
                    @foreach($user->roles as $role)
                      <span class="badge bg-info me-1">{{ $role->name }}</span>
                    @endforeach
                  @else
                    <span class="text-muted">{{__('no roles')}}</span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>{{__('created at')}}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($user->created_at)->format('Y-m-d H:i') }}</td>
              </tr>
              <tr>
                <th>{{__('updated at')}}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($user->updated_at)->format('Y-m-d H:i') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        @else
          <p class="text-muted">{{__('no user data to display')}}</p>
        @endisset
      </div>
    </div>
  </div>
</div>
@endsection