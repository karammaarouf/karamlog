@extends('layouts.app')
@section('title')
    {{__('Users.deleted')}}
@endsection
@section('subTitle')
    {{ __('Users.deleted') }}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ __('Deleted') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h5>{{ __('Users.deleted') }}</h5>
          <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">{{ __('back') }}</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('email') }}</th>
                <th>{{ __('roles') }}</th>
                <th>{{ __('deleted_at') }}</th>
                <th>{{ __('actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                  <td>{{ optional($user->deleted_at)->format('Y-m-d H:i') }}</td>
                  <td>
                    <form method="POST" action="{{ route('users.restore', $user->id) }}" style="display:inline-block">
                      @csrf
                      @method('PUT')
                      <button class="btn btn-sm btn-outline-success" onclick="return confirm('{{ __('Are you sure to restore this user?') }}')">{{ __('restore') }}</button>
                    </form>
                    <form method="POST" action="{{ route('users.forceDelete', $user->id) }}" style="display:inline-block">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Are you sure to permanently delete this user?') }}')">{{ __('force delete') }}</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">{{ __('No deleted users found') }}</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
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