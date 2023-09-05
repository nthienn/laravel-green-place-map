@extends('layouts.master')

@section('title')
    <title>Đổi mật khẩu</title>
@endsection

@section('content')
    <section>
        <div class="form-information">
            <form method="POST" action="{{ route('update_password') }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <h3 class="information-heading">Đổi mật khẩu</h3>

                        <div class="information-group">
                            <label for="password" class="information-label">Mật khẩu hiện tại</label>
                            <input id="password" type="password" name="password"
                                class="information-control-pass @error('password') is-invalid @enderror">
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="information-group">
                            <label for="password_new" class="information-label">Mật khẩu mới</label>
                            <input id="password_new" type="password" name="password_new"
                                class="information-control-pass @error('password_new') is-invalid @enderror">
                        </div>
                        @error('password_new')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-group">
                            <label for="password_confirmation" class="information-label">Nhập lại mật khẩu</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="information-control-pass @error('password_confirmation') is-invalid @enderror">
                        </div>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-action">
                            <button type="submit" class="information-convert">Đổi mật khẩu</button>
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
                'Mật khẩu tài khoản của bạn đã được đổi.',
                'success'
            )
        </script>
    @endif
@endsection
