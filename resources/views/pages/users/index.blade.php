@extends('layouts.app')
@section('title')
    {{__('Users.list')}}
@endsection
@section('subTitle')
    {{ __('Users.list') }}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ __('Users') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header"><h5>{{ __('Users.list') }}</h5></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('email') }}</th>
                <th>{{ __('email_verified_at') }}</th>
                <th>{{ __('is_active') }}</th>
                <th>{{ __('actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->email_verified_at ? __('yes') : __('no') }}</td>
                  <td>{{ $user->is_active ? __('yes') : __('no') }}</td>
                  <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary">{{ __('edit') }}</a>
                    <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline-block">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Are you sure you want to delete this user?') }}')">{{ __('delete') }}</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">{{ __('No users found') }}</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection