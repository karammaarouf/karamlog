@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @php
        $isEdit = isset($user) && $user->exists;
        $title = $isEdit ? 'تعديل مستخدم' : 'إضافة مستخدم جديد';
        $action = $isEdit ? route('users.update', $user) : route('users.store');
        $method = $isEdit ? 'PUT' : 'POST';
    @endphp

    <div class="row mb-3">
        <div class="col">
            <h2 class="h5">{{ $title }}</h2>
        </div>
    </div>

    <div class="row">
        <x-form :action="$action" :method="$method" class="row g-3" novalidate>
            <x-input name="name" label="الاسم" :model="$user" required />

            <x-input name="email" type="email" label="البريد الإلكتروني" :model="$user" required />

            @if(!$isEdit)
                <x-input name="password" type="password" label="كلمة المرور" required help="الحد الأدنى 8 أحرف" />
                <x-input name="password_confirmation" type="password" label="تأكيد كلمة المرور" required />
            @endif

            <x-checkbox name="is_active" label="نشط؟" :model="$user" />

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </x-form>
    </div>
</div>
@endsection