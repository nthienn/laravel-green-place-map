@extends('layouts.master')

@section('title')
    <title>Bản Đồ Địa Điểm Xanh</title>
@endsection

@section('content')
    <section>
        @include('components.category')

        <h3 class="heading">Tìm kiếm: <span>{{ $key_word }}</span></h3>

        <div class="map" style="width:100%; height:400px; margin-bottom:32px;">
            @php
                require_once 'map/GreenPlace.php';
                $edu = new search();
                $coll = $edu->getCollegesBlankLatLng();
                $coll = json_encode($coll, true);
                echo '<div id="data">' . $coll . '</div>';
                
                $allData = $edu->getColleges();
                $allData = json_encode($allData, true);
                echo '<div id="allData">' . $allData . '</div>';
            @endphp
            <div id="map" style="width:100%; height:100%;"></div>
        </div>

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
