<!-- Begin Page Content -->
@extends('admin.layouts.admin')

@section('title')
    <title>Quản lý tài khoản thành viên</title>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Thành Viên</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tên</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Quản lý</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->username }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->address }}</td>
                                    <td>
                                        <a href="" class="btn btn-danger btn-icon-split delete_member"
                                            data-url="{{ route('delete_member', [$member->id_user]) }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text font-weight-bold">Xoá tài khoản</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.delete_member').click(function(e) {
            e.preventDefault();
            var urlRequest = $(this).data('url');

            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Xác nhận xoá tài khoản thành viên!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xoá!',
                cancelButtonText: 'Huỷ'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: urlRequest,
                        success: function(response) {
                            Swal.fire(
                                'Thành công!',
                                'Tài khoản thành viên đã bị xoá.',
                                'success'
                            ).then(() => {
                                window.location.reload()
                            })
                        }
                    });
                }
            })
        });
    </script>
@endsection
<!-- /.container-fluid -->
