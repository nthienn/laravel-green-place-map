<!-- Begin Page Content -->
@extends('admin.layouts.admin')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    <title>Quản lý tài khoản nhà cung cấp</title>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Nhà Cung Cấp</h1>
        
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
                                <th>Số địa điểm</th>
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
                                <th>Số địa điểm</th>
                                <th>Quản lý</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->username }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->places_count }}</td>
                                    <td>
                                        <form action="{{ route('authorize_supplier', [$supplier->id_user]) }}"
                                            method="POST" class="action_form">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-warning btn-icon-split authorize_supplier">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-flag"></i>
                                                </span>
                                                <span class="text font-weight-bold">Phân quyền</span>
                                            </button>
                                        </form>
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
        $('.authorize_supplier').click(function(e) {
            e.preventDefault();
            var urlRequest = $('.action_form').attr('action');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Xác nhận phân quyền nhà cung cấp xuống thành viên!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, phân quyền!',
                cancelButtonText: 'Huỷ'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'PUT',
                        url: urlRequest,
                        success: function(response) {
                            Swal.fire(
                                'Thành công!',
                                'Nhà cung cấp đã bị phân quyền xuống thành viên.',
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
