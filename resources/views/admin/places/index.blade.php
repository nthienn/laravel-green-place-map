<!-- Begin Page Content -->
@extends('admin.layouts.admin')

@section('title')
    <title>Danh sách địa điểm xanh</title>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Địa Điểm Xanh</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nhà cung cấp</th>
                                <th>Loại địa điểm</th>
                                <th>Tên Địa điểm</th>
                                <th>Số Sao</th>
                                <th>Trạng thái</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nhà cung cấp</th>
                                <th>Loại địa điểm</th>
                                <th>Tên Địa điểm</th>
                                <th>Số Sao</th>
                                <th>Trạng thái</th>
                                <th>Quản lý</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($places as $place)
                                <tr>
                                    <td>{{ $place->name }}</td>
                                    <td>{{ $place->type }}</td>
                                    <td>{{ $place->placeName }}</td>
                                    <td>{{ $place->star }}</td>
                                    <td>
                                        @if ($place->status == 1)
                                            Đang hoạt động
                                        @else
                                            Đã đóng cửa
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('place_detail', [$place->id_place]) }}" class="btn btn-info btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <span class="text font-weight-bold">Xem chi tiết</span>
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
@endsection
<!-- /.container-fluid -->
