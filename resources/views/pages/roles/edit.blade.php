@extends('layouts.app')

@section('title', 'Edit Role')
@section('subTitle', 'Update role details and permissions')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header"><h5>Edit Role: {{ $role->name }}</h5></div>
      <div class="card-body">
        <form method="POST" action="{{ route('roles.update', $role) }}">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Group Name</label>
            <input type="text" name="group_name" class="form-control" value="{{ old('group_name', $role->group_name) }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2">{{ old('description', $role->description) }}</textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Active</label>
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $role->is_active) ? 'checked' : '' }}>
          </div>
          <div class="mb-3">
            <label class="form-label">Permissions</label>
            <select name="permission_ids[]" class="form-select" multiple size="8">
              @php $selected = $role->permissions->pluck('id')->all(); @endphp
              @foreach($permissions as $p)
                <option value="{{ $p->id }}" {{ in_array($p->id, $selected) ? 'selected' : '' }}>{{ $p->group_name }} :: {{ $p->name }}</option>
              @endforeach
            </select>
          </div>
          <button class="btn btn-primary" type="submit">Update</button>
          <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection