<!-- Begin Page Content -->
@extends('admin.layouts.admin')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    <title>Quản lý đánh giá</title>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Đánh giá</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Địa điểm</th>
                                <th>Bình luận</th>
                                <th>Đánh giá sao</th>
                                <th>Thời gian</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tên</th>
                                <th>Địa điểm</th>
                                <th>Bình luận</th>
                                <th>Đánh giá sao</th>
                                <th>Thời gian</th>
                                <th>Quản lý</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($ratings as $rating)
                                <tr>
                                    <td>{{ $rating->name }}</td>
                                    <td>{{ $rating->placeName }}</td>
                                    <td>{{ $rating->content }}</td>
                                    <td>{{ $rating->rating }}</td>
                                    <td>{{ $rating->date }}</td>
                                    <td>
                                        @if ($rating->status == 1)
                                            <form action="{{ route('hide_comment', [$rating->id_comment]) }}" method="POST" class="action_hide">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn btn-secondary btn-icon-split hide_comment">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </span>
                                                    <span class="text font-weight-bold">Ẩn bình luận</span>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('show_comment', [$rating->id_comment]) }}" method="POST" class="action_show">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn btn-light btn-icon-split show_comment">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </span>
                                                    <span class="text font-weight-bold">Hiện bình luận</span>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success_hide'))
        <script>
            Swal.fire(
                'Thành công!',
                'Bình luận đã bị ẩn.',
                'success'
            )
        </script>
    @endif

    @if (session()->has('success_show'))
        <script>
            Swal.fire(
                'Thành công!',
                'Bình luận đã được hiện.',
                'success'
            )
        </script>
    @endif
@endsection
<!-- /.container-fluid -->
