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
<table class="table table-striped">
    <thead>
        <tr>
            <th>{{ __('Users.id') }}</th>
            <th>{{ __('Users.name') }}</th>
            <th>{{ __('Users.email') }}</th>
            <th>{{ __('Users.role') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection