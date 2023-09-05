@extends('layouts.master')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    <title>Địa điểm xanh của bạn</title>
@endsection

@section('content')
    <section>
        @foreach ($place as $value)
            <div class="place-detail">
                <a href="{{ route('place.index') }}" class="place_link">
                    <h3 class="heading">Địa điểm xanh của bạn</h3>
                </a>
                <div class="row">
                    <h3 class="col-6 place-detail-name">{{ $value->placeName }}</h3>
                    <div class="col-2"></div>
                    <div class="col-4 form-action">
                        <a href="{{ route('place.edit', [$value->id_place]) }}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text font-weight-bold">Cập Nhật Địa Điểm</span>
                        </a>
                        <form action="{{ route('place.destroy', [$value->id_place]) }}" method="POST" class="action_form">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-icon-split delete_place">
                                <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text font-weight-bold">Xoá Địa Điểm</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="address">
                    <i class="fa-solid fa-location-dot"></i>
                    <p class="place-detail-address">{{ $value->address }}</p>
                </div>
                <div class="place-detail-rating">
                    <div class="rating">
                        @if ($value->star == 0)
                            <span>Chưa có đánh giá</span>
                        @else
                            <span>{{ $value->star }}</span>
                        @endif
                        @php
                            $stars = 1;
                        @endphp
                        @while ($stars <= 5)
                            @if ($value->star < $stars)
                                <i class="fa-solid fa-star" style="color: #99999980;"></i>
                            @else
                                <i class="fa-solid fa-star" style="color: #ffce3d;"></i>
                            @endif
                            @php
                                $stars++;
                            @endphp
                        @endwhile
                    </div>
                    <span class="status">
                        @if ($value->status == 1)
                            Đang hoạt động
                        @else
                            Đã đóng cửa
                        @endif
                    </span>
                </div>
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
                        <img src="{{ asset('uploads/' . $value->image) }}" alt="">
                    </div>
                    @foreach ($images as $image)
                        <div>
                            <img src="{{ asset('uploads/' . $image->image) }}" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="description">
                    <h4>Mô tả</h4>
                    <p>{{ $value->description }}</p>
                </div>
                <div class="criterias-detail">
                    <h4>Tiêu chí</h4>
                    <div class="criterias">
                        @foreach ($criterias as $criteria)
                            <div class="criteria">
                                <i class="fas fa-check"></i>
                                <p>{{ $criteria->criteria }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="map" style="width:100%; height:400px; margin-bottom:32px;">
                    @php
                        require_once 'map/GreenPlace.php';
                        $edu = new detail();
                        $coll = $edu->getCollegesBlankLatLng();
                        $coll = json_encode($coll, true);
                        echo '<div id="data">' . $coll . '</div>';
                        
                        $allData = $edu->getColleges($value->id_place);
                        $allData = json_encode($allData, true);
                        echo '<div id="allData">' . $allData . '</div>';
                    @endphp
                    <div id="map" style="width:100%; height:100%;"></div>
                </div>
            </div>
        @endforeach
    </section>

    <script>
        $('.delete_place').click(function(e) {
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
                text: "Xác nhận xoá địa điểm xanh!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xoá!',
                cancelButtonText: 'Huỷ'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: urlRequest,
                        success: function(response) {
                            Swal.fire(
                                'Thành công!',
                                'Địa điểm xanh của bạn đã được xoá.',
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
