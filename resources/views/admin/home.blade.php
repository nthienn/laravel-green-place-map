<!-- Begin Page Content -->
@extends('admin.layouts.admin')

@section('script')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDloBT6ba_jvl5PEkU-Uu12MtnA1aM_Rxw&callback=loadMap"></script>
@endsection

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bản đồ địa điểm xanh</h1>
        </div>

        <div class="map" style="width:100%; height:517px;">
            @php
                require_once 'map/GreenPlace.php';
                $edu = new greenPlaceMap();
                $coll = $edu->getCollegesBlankLatLng();
                $coll = json_encode($coll, true);
                echo '<div id="data">' . $coll . '</div>';
                
                $allData = $edu->getAllColleges();
                $allData = json_encode($allData, true);
                echo '<div id="allData">' . $allData . '</div>';
            @endphp
            <div id="map" style="width:100%; height:100%;"></div>
        </div>
    </div>
@endsection
<!-- /.container-fluid -->
