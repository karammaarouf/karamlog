@extends('layouts.app')

@section('title', 'Permissions')
@section('subTitle', 'Manage application permissions')

@section('content')
<div class="row">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header"><h5>Create Permission</h5></div>
      <div class="card-body">
        <form method="POST" action="{{ route('permissions.store') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Group Name</label>
            <input type="text" name="group_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Active</label>
            <input type="checkbox" name="is_active" value="1" checked>
          </div>
          <button class="btn btn-primary" type="submit">Create</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card">
      <div class="card-header"><h5>Permissions List</h5></div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Group</th>
              <th>Active</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($permissions as $perm)
              <tr>
                <td>{{ $perm->name }}</td>
                <td>{{ $perm->group_name }}</td>
                <td>{{ $perm->is_active ? 'Yes' : 'No' }}</td>
                <td>
                  <a href="{{ route('permissions.edit', $perm) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                  <form method="POST" action="{{ route('permissions.destroy', $perm) }}" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete permission?')">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="4">No permissions found.</td></tr>
            @endforelse
          </tbody>
        </table>
        {{ $permissions->links() }}
      </div>
    </div>
  </div>
</div>
@endsection