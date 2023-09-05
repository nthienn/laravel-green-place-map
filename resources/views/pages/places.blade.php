@extends('layouts.master')

@section('title')
    <title>Địa điểm xanh nổi bật</title>
@endsection

@section('content')
    <section>
        <!-- Category -->
        <div class="category">
            <ul class="category-list">
                <li class="category-item">
                    <a href="{{ route('places-outstanding') }}" class="category-link active">
                        <i class="fa-solid fa-fire"></i>
                        <span>Nổi bật</span>
                    </a>
                </li>
                <li class="category-item">
                    <a href="{{ route('places-type', ['name' => 'coffee', 'id' => 1]) }}" class="category-link">
                        <i class="fa-solid fa-mug-hot"></i>
                        <span>Quán Cafe</span>
                    </a>
                </li>
                <li class="category-item">
                    <a href="{{ route('places-type', ['name' => 'restaurant', 'id' => 2]) }}" class="category-link">
                        <i class="fa-solid fa-utensils"></i>
                        <span>Nhà hàng</span>
                    </a>
                </li>
                <li class="category-item">
                    <a href="{{ route('places-type', ['name' => 'travel', 'id' => 3]) }}" class="category-link">
                        <i class="fa-solid fa-umbrella-beach"></i>
                        <span>Khu du lịch</span>
                    </a>
                </li>
            </ul>
        </div>

        <h3 class="heading">Danh sách <span>địa điểm xanh</span></h3>
        <div class="row">
            @foreach ($places as $place)
                <div class="col-3">
                    <a href="{{ route('place-detail', [$place->id_place]) }}" class="place">
                        <img src="{{ asset('uploads/' . $place->image) }}" alt="" class="place-img">
                        <div class="place-info">
                            <h4 class="place-name">{{ $place->placeName }}</h4>
                            <p class="place-address">{{ $place->address }}</p>
                            <div class="place-action">
                                <div class="place-rating">
                                    @php
                                        $stars = 1;
                                    @endphp
                                    @while ($stars <= 5)
                                        @if ($place->star < $stars)
                                            <i class="fa-solid fa-star" style="color: #99999980;"></i>
                                        @else
                                            <i class="fa-solid fa-star" style="color: #ffce3d;"></i>
                                        @endif
                                        @php
                                            $stars++;
                                        @endphp
                                    @endwhile
                                </div>
                                <span class="place-status">
                                    @if ($place->status == 1)
                                        Đang hoạt động
                                    @else
                                        Đã đóng cửa
                                    @endif
                                </span>
                            </div>
                            <p class="place-type">Loại địa điểm: <span>{{ $place->type }}</span></p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{ $places->links('components.pagination') }}

    </section>
@endsection
