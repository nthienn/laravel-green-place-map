@extends('layouts.master')

@foreach ($place as $value)
    @section('title')
        <title>{{ $value->placeName }}</title>
    @endsection

    @section('content')
        <section>
            @include('components.category')

            <div class="place-detail">
                <div class="row">
                    <div class="col-7">
                        <input type="hidden" name="id_place" value="{{ $value->id_place }}">
                        <h3 class="place-detail-name">{{ $value->placeName }}</h3>
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
                    </div>
                    <div class="col-1"></div>
                    <div class="col-4 supplier">
                        <h5>Liên hệ với Nhà cung cấp</h5>
                        <div class="supplier-name">
                            @if ($user)
                                <img src="{{ asset('home/img/avatar.svg') }}" alt="">
                                <p>{{ $user->name }}</p>
                                <button class="supplier-call">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>{{ $user->phone }}</span>
                                </button>
                            @endif
                        </div>
                    </div>
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
                <div class="comments">
                    <div class="comments-heading">
                        <h4>Bài đánh giá</h4>
                        <div class="rating">
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
                            @if ($value->star == 0)
                                <span>Chưa có đánh giá</span>
                            @else
                                <span>{{ $value->star }} ({{ $value->ratings_count }} lượt đánh giá)</span>
                            @endif
                        </div>
                    </div>
                    <ul>
                        @foreach ($ratings as $rating)
                            <li class="comment">
                                <div class="comment-user">
                                    <img src="{{ asset('home/img/avatar.png') }}" alt="">
                                    <div class="name">
                                        <p><strong>{{ $rating->name }}</strong></p>
                                        <div class="stars">
                                            <div class="star">
                                                @php
                                                    $stars = 1;
                                                @endphp
                                                @while ($stars <= 5)
                                                    @if ($rating->rating < $stars)
                                                        <i class="fa-solid fa-star" style="color: #99999980;"></i>
                                                    @else
                                                        <i class="fa-solid fa-star" style="color: #ffce3d;"></i>
                                                    @endif
                                                    @php
                                                        $stars++;
                                                    @endphp
                                                @endwhile
                                            </div>
                                            <span>{{ $rating->date }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    @if ($rating->status == 1)
                                        <p>{{ $rating->content }}</p>
                                    @else
                                        <p class="comment-hide">Bình luận bị ẩn</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @if (session()->has('id_user'))
                        @if ($user_rating)
                            <h4>Cảm ơn bạn đã đánh giá địa điểm</h4>
                        @else
                            <form method="POST" action="{{ route('evaluate', [$value->id_place]) }}">
                                @csrf
                                <h4>Viết bài đánh giá</h4>
                                <div id="rateYo"></div>
                                <input type="hidden" id="rating" name="rating">
                                <div class="comment-send">
                                    <input type="text" placeholder="Để lại bình luận của bạn" name="comment"
                                        class="@error('comment') is-invalid @enderror">
                                    <button type="submit">Gửi đánh giá</button>
                                </div>
                                @error('comment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </form>
                        @endif
                    @else
                        <p class="comment-alert">
                            Vui lòng đăng nhập để gửi đánh giá
                            <a href="{{ route('user.create') }}">Đăng nhập</a>
                        </p>
                    @endif
                </div>
            </div>
        </section>

        <script>
            $(function() {
                $("#rateYo").rateYo({
                    rating: 5,
                    fullStar: true,
                    starWidth: "40px",
                    multiColor: {
                        "startColor": "#FF0000", //RED
                        "endColor": "#00FF00" //GREEN
                    },
                    onSet: function(rating) {
                        $('#rating').val(rating);
                    }
                })
            });
        </script>

        @if (session()->has('success'))
            <script>
                Swal.fire(
                    'Thành công!',
                    'Đánh giá của bạn đã được ghi lại.',
                    'success'
                )
            </script>
        @endif
    @endsection
@endforeach
