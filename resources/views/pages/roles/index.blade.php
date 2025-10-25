@extends('layouts.app')

@section('title', 'Roles')
@section('subTitle', 'Manage roles and assign permissions')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><h5>Create Role</h5></div>
      <div class="card-body">
        <form method="POST" action="{{ route('roles.store') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Group Name</label>
            <input type="text" name="group_name" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Active</label>
            <input type="checkbox" name="is_active" value="1" checked>
          </div>
          <div class="mb-3">
            <label class="form-label">Permissions</label>
            <select name="permission_ids[]" class="form-select" multiple size="6">
              @foreach($permissions as $p)
                <option value="{{ $p->id }}">{{ $p->group_name }} :: {{ $p->name }}</option>
              @endforeach
            </select>
          </div>
          <button class="btn btn-primary" type="submit">Create</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><h5>Roles List</h5></div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Group</th>
              <th>Active</th>
              <th>Permissions</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($roles as $role)
              <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->group_name }}</td>
                <td>{{ $role->is_active ? 'Yes' : 'No' }}</td>
                <td>
                  @foreach($role->permissions as $p)
                    <span class="badge bg-secondary">{{ $p->name }}</span>
                  @endforeach
                </td>
                <td>
                  <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                  <form method="POST" action="{{ route('roles.destroy', $role) }}" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete role?')">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="5">No roles found.</td></tr>
            @endforelse
          </tbody>
        </table>
        {{ $roles->links() }}
      </div>
    </div>
  </div>
</div>
@endsection