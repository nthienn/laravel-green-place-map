@extends('layouts.master')

@section('title')
    <title>Cập nhật thông tin cá nhân</title>
@endsection

@section('content')
    <section>
        <div class="form-information">
            <form method="POST" action="{{ route('user.update', [$user->id_user]) }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <h3 class="information-heading">Thông tin cá nhân</h3>

                        <div class="information-group">
                            <label for="username" class="information-label">Username</label>
                            <input id="username" type="text" value="{{ $user->username }}" name="username"
                                class="information-control @error('username') is-invalid @enderror">
                        </div>
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-group">
                            <label for="fullname" class="information-label">Họ và tên</label>
                            <input id="fullname" type="text" value="{{ $user->name }}" name="fullname"
                                class="information-control @error('fullname') is-invalid @enderror">
                        </div>
                        @error('fullname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-group">
                            <label for="email" class="information-label">Email</label>
                            <input id="email" type="text" value="{{ $user->email }}" name="email"
                                class="information-control @error('email') is-invalid @enderror">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-group">
                            <label for="phone" class="information-label">Số điện thoại</label>
                            <input id="phone" type="text" value="{{ $user->phone }}" name="phone"
                                class="information-control @error('phone') is-invalid @enderror">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-group">
                            <label for="address" class="information-label">Địa chỉ</label>
                            <input id="address" type="text" value="{{ $user->address }}" name="address"
                                class="information-control @error('address') is-invalid @enderror">
                        </div>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-action">
                            <button type="submit" class="information-update">Cập nhật thông tin</button>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            </form>
        </div>
    </section>

    @if (session()->has('success'))
        <script>
            Swal.fire(
                'Thành công!',
                'Thông tin tài khoản của bạn đã được cập nhật.',
                'success'
            )
        </script>
    @endif
@endsection
