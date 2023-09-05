@extends('layouts.master')

@section('title')
    <title>Địa điểm xanh của bạn</title>
@endsection

@section('content')
    <section>
        <h3 class="heading"><span>Địa điểm xanh</span> của bạn</h3>
        <div class="map" style="width:100%; height:400px; margin-bottom:32px;">
            @php
                require_once 'map/GreenPlace.php';
                $edu = new places();
                $coll = $edu->getCollegesBlankLatLng();
                $coll = json_encode($coll, true);
                echo '<div id="data">' . $coll . '</div>';
                
                $allData = $edu->getColleges();
                $allData = json_encode($allData, true);
                echo '<div id="allData">' . $allData . '</div>';
            @endphp
            <div id="map" style="width:100%; height:100%;"></div>
        </div>
        <div class="card shadow mb-4 mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" style="font-size: 18px;">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên địa điểm</th>
                                <th>Loại địa điểm</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($places as $place)
                                <tr>
                                    <td>
                                        <img src="{{ asset('uploads/' . $place->image) }}" alt="" style="width: 100px">
                                    </td>
                                    <td>{{ $place->placeName }}</td>
                                    <td>{{ $place->type }}</td>
                                    <td>{{ $place->address }}</td>
                                    <td>{{ $place->approve }}</td>
                                    <td>
                                        <a href="{{ route('place.show', [$place->id_place]) }}"
                                            class="btn btn-info btn-icon-split">
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
    </section>
@endsection
