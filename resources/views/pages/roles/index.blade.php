@extends('layouts.app')
@section('title')
    {{ __('roles') }}
@endsection
@section('subTitle')
    {{ __('roles') }}
@endsection
@section('breadcrumb')
    {{ __('roles') }}
@endsection
@section('breadcrumbActive')
    {{ __('roles') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{ __('roles') }}</h5>
                        <x-buttons.create :action="route('roles.create')" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('permissions') }}</th>
                                    <th>{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{$role->permissions->count()}}</td>
                                        <td>
                                            <x-buttons.show :action="route('roles.show', $role)" />
                                            <x-buttons.edit :action="route('roles.edit', $role)" />
                                            <x-buttons.delete-form :action="route('roles.destroy', $role)" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No roles found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($roles->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $roles])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection