@extends('layouts.app')
@section('title')
    {{__('Items.list')}}
@endsection
@section('subTitle')
    {{ __('Items.list') }}
@endsection
@section('breadcrumb')
    {{ __('Items') }}
@endsection
@section('breadcrumbActive')
    {{ __('Items List') }}  
@endsection
@section('content')
{{ __('Items List') }}
@endsection