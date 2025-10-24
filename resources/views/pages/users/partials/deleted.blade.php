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
deleted users
@endsection