@extends('layouts.app')
@section('title')
    {{ 'تفاصيل مستخدم' }}
@endsection
@section('subTitle')
    {{ 'تفاصيل مستخدم' }}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ 'عرض' }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">تفاصيل المستخدم</h5>
        <div>
          @isset($user)
            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">تعديل</a>
          @endisset
          <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary ms-2">رجوع</a>
        </div>
      </div>
      <div class="card-body">
        @isset($user)
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width: 200px">#</th>
                <td>{{ $user->id }}</td>
              </tr>
              <tr>
                <th>الاسم</th>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <th>البريد الإلكتروني</th>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <th>موثّق البريد</th>
                <td>{{ $user->email_verified_at ? 'نعم' : 'لا' }}</td>
              </tr>
              <tr>
                <th>نشط</th>
                <td>{{ $user->is_active ? 'نعم' : 'لا' }}</td>
              </tr>
              <tr>
                <th>الأدوار</th>
                <td>
                  @if($user->roles && $user->roles->count())
                    @foreach($user->roles as $role)
                      <span class="badge bg-info me-1">{{ $role->name }}</span>
                    @endforeach
                  @else
                    <span class="text-muted">لا توجد أدوار</span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>تاريخ الإنشاء</th>
                <td>{{ \Illuminate\Support\Carbon::parse($user->created_at)->format('Y-m-d H:i') }}</td>
              </tr>
              <tr>
                <th>تاريخ التحديث</th>
                <td>{{ \Illuminate\Support\Carbon::parse($user->updated_at)->format('Y-m-d H:i') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        @else
          <p class="text-muted">لا توجد بيانات مستخدم لعرضها.</p>
        @endisset
      </div>
    </div>
  </div>
</div>
@endsection