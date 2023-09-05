<!-- Begin Page Content -->
@extends('admin.layouts.admin')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    <title>Chi tiết địa điểm xanh cần duyệt</title>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <a href="{{ route('approves') }}" class="place_link"><h1 class="h3 mb-4 text-gray-800">Chi Tiết Địa Điểm Xanh</h1></a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    @foreach ($places as $place)
                        <div class="action">
                            <h3 class="font-weight-bold text-primary">{{ $place->placeName }}</h3>
                            <div>
                                <form action="{{ route('approve', [$place->id_place]) }}" method="POST" class="action_form">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn btn-success btn-icon-split approve_place">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text font-weight-bold">Duyệt Địa Điểm</span>
                                    </button>
                                </form>
                                <a href="" class="btn btn-danger btn-icon-split delete_place"
                                    data-url="{{ route('delete_approve', [$place->id_place]) }}">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text font-weight-bold">Chưa Đủ Điều Kiện</span>
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <h4 class="font-weight-bold text-secondary">Nhà cung cấp</h4>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $place->name }}</td>
                                <td>{{ $place->username }}</td>
                                <td>{{ $place->email }}</td>
                                <td>{{ $place->phone }}</td>
                                <td>{{ $place->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <h4 class="font-weight-bold text-secondary">Địa điểm xanh</h4>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Loại Địa điểm</th>
                                <th>Tên Địa điểm</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $place->type }}</td>
                                <td>{{ $place->placeName }}</td>
                                <td>{{ $place->address }}</td>
                                <td>
                                    @if ($place->status == 0)
                                        Đang hoạt động
                                    @else
                                        Đã đóng cửa
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <h4 class="font-weight-bold text-secondary">Hình ảnh</h4>
                    <div class="main">
                        <span class="control prev">
                            <i class="fas fa-fw fa-angle-left"></i>
                        </span>
                        <span class="control next">
                            <i class="fas fa-fw fa-angle-right"></i>
                        </span>
                        <div class="img-wrap">
                            <img src="" alt="">
                        </div>
                    </div>
                    <div class="list-img">
                        <div>
                            <img src="{{ asset('uploads/' . $place->image) }}" alt="">
                        </div>
                        @foreach ($images as $value)
                            <div>
                                <img src="{{ asset('uploads/' . $value->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <h4 class="font-weight-bold text-secondary">Mô tả</h4>
                    <p>{{ $place->description }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <h4 class="font-weight-bold text-secondary">Tiêu chí</h4>
                    <div class="criterias">
                        @foreach ($criterias as $value)
                            <div class="criteria">
                                <i class="fas fa-check"></i>
                                <p>{{ $value->criteria }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.approve_place').click(function(e) {
            e.preventDefault();
            var urlRequest = $('.action_form').attr('action');
            var link = $('.place_link').attr('href');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Xác nhận duyệt địa điểm xanh!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, duyệt!',
                cancelButtonText: 'Huỷ'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'PUT',
                        url: urlRequest,
                        success: function(response) {
                            Swal.fire(
                                'Thành công!',
                                'Địa điểm xanh đã được duyệt.',
                                'success'
                            ).then(() => {
                                window.location.href = link
                            })
                        }
                    });
                }
            })
        });

        $('.delete_place').click(function(e) {
            e.preventDefault();
            var urlRequest = $(this).data('url');
            var link = $('.place_link').attr('href');

            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Xác nhận không duyệt địa điểm này!",
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
                                'Địa điểm xanh này không được duyệt.',
                                'success'
                            ).then(() => {
                                window.location.href = link
                            })
                        }
                    });
                }
            })
        });
    </script>
@endsection
<!-- /.container-fluid -->
