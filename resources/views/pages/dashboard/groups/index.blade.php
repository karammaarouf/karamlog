@extends('layouts.app')
@section('title')
    {{ __('Groups List') }}
@endsection
@section('breadcrumb')
    {{ __('Groups') }}
@endsection
@section('breadcrumbActive')
    {{ __('Groups List') }}
@endsection
@section('content')
    <x-cards.container>
        <x-cards.card :value="$groupsCount ?? 0" label="{{ __('Total Groups') }}" icon="menu" roundColor="primary" trendText="+0%"
            trendClass="font-primary" />
        <x-cards.card :value="$activeGroups ?? 0" label="{{ __('Active Groups') }}" icon="eye" roundColor="success" />
        <x-cards.card :value="$inactiveGroups ?? 0" label="{{ __('Inactive Groups') }}" icon="eye-off" roundColor="danger" />
    </x-cards.container>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="groups.index" placeholder="{{ __('search groups') }}" />
                        @can('create-groups')
                            <x-buttons.create :action="route('groups.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('description') }}</th>
                                    <th>{{ __('status') }}</th>
                                    @canany(['update-groups', 'delete-groups'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($groups ?? collect()) as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->description }}</td>
                                        <td>
                                            @can('update-groups')
                                                <x-buttons.toggle-active :model="$group" action="groups.toggleActive" />
                                            @else
                                                <span
                                                    class="badge badge-light-{{ $group->is_active ? 'success' : 'danger' }}">{{ $group->is_active ? __('active') : __('inactive') }}</span>
                                            @endcan
                                        </td>
                                        @canany(['update-groups', 'delete-groups'])
                                            <td>
                                                @can('show-groups')
                                                    <x-buttons.show :action="route('groups.show', $group)" />
                                                @endcan
                                                @can('update-groups')
                                                    <x-buttons.edit :action="route('groups.edit', $group)" />
                                                @endcan
                                                @can('delete-groups')
                                                    <x-buttons.delete-form :action="route('groups.destroy', $group)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No groups found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if (isset($groups) && $groups->count())
                                <x-table.tfoot :page="$groups" />
                            @endif
                        </table>
                    </div>
                </div>
                @if (isset($groups) && $groups->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $groups])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
