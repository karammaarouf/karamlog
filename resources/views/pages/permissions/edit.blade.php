@extends('layouts.app')

@section('title', 'Edit Permission')
@section('subTitle', 'Update permission details')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><h5>Edit Permission: {{ $permission->name }}</h5></div>
      <div class="card-body">
        <form method="POST" action="{{ route('permissions.update', $permission) }}">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Group Name</label>
            <input type="text" name="group_name" class="form-control" value="{{ old('group_name', $permission->group_name) }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2">{{ old('description', $permission->description) }}</textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Active</label>
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $permission->is_active) ? 'checked' : '' }}>
          </div>
          <button class="btn btn-primary" type="submit">Update</button>
          <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection