@extends('layouts.master')

@section('title')
    <title>Thông tin cá nhân</title>
@endsection

@section('content')
    <section>
        <div class="form-information">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <h3 class="information-heading">Thông tin cá nhân</h3>
                    @foreach ($user as $profile)                       
                    <div class="information-group">
                        <label for="username" class="information-label">Username</label>
                        <label for="username" class="information-personal">{{ $profile->username }}</label>
                    </div>
                    <div class="information-group">
                        <label for="name" class="information-label">Họ và tên</label>
                        <label for="name" class="information-personal">{{ $profile->name }}</label>
                    </div>
                    <div class="information-group">
                        <label for="email" class="information-label">Email</label>
                        <label for="email" class="information-personal">{{ $profile->email }}</label>
                    </div>
                    <div class="information-group">
                        <label for="phone" class="information-label">Số điện thoại</label>
                        <label for="phone" class="information-personal">{{ $profile->phone }}</label>
                    </div>
                    <div class="information-group">
                        <label for="address" class="information-label">Địa chỉ</label>
                        <label for="address" class="information-personal">{{ $profile->address }}</label>
                    </div>
                    <div class="information-action">
                        <button class="information-update">
                            <a href="{{ route('user.edit', [$profile->id_user]) }}">Cập nhật thông tin</a>
                        </button>
                        <button class="information-convert">
                            <a href="{{ route('change_password', [$profile->id_user]) }}">Đổi mật khẩu</a>
                        </button>
                    </div>
                    @endforeach
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>
@endsection
