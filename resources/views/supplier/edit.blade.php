@extends('layouts.master')

@section('title')
    <title>Cập nhật địa điểm xanh</title>
@endsection

@section('content')
    <section>
        <div class="form-information">
            <form method="POST" action="{{ route('place.update', [$place->id_place]) }}" enctype="multipart/form-data"
                class="action_form">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <h3 class="information-heading">Địa Điểm Xanh của bạn</h3>

                        <div class="information-group">
                            <label for="placeName" class="information-label">Tên địa điểm</label>
                            <input id="placeName" type="text" name="placeName"
                                class="information-control @error('placeName') is-invalid @enderror"
                                value="{{ $place->placeName }}">
                        </div>
                        @error('placeName')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-group">
                            <label for="address" class="information-label">Địa chỉ</label>
                            <input id="address" type="text" class="information-control" value="{{ $place->address }}"
                                disabled>
                        </div>

                        <div class="information-group">
                            <label for="image" class="information-label">Hình ảnh</label>
                            <input id="image" type="file" name="image" class="information-control">
                        </div>

                        <div class="information-group">
                            <label for="images" class="information-label">Hình ảnh chi tiết</label>
                            <input id="images" type="file" name="images[]" multiple="multiple"
                                class="information-control">
                        </div>

                        <div class="information-group">
                            <label for="type" class="information-label">Loại địa điểm</label>
                            <input id="type" type="text" class="information-control" value="{{ $type->type }}"
                                disabled>
                        </div>

                        <div class="information-group">
                            <label for="desc" class="information-label">Mô tả</label>
                            <textarea id="desc" rows="10" cols="30" name="desc" class="@error('desc') is-invalid @enderror">{{ $place->description }}</textarea>
                        </div>
                        @error('desc')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="information-group">
                            <label for="status" class="information-label">Trạng thái</label>
                            <select name="status">
                                @php
                                    $status = ['Đã đóng cửa', 'Đang hoạt động'];
                                @endphp
                                @for ($i = 0; $i < count($status); $i++)
                                    <option {{ $place->status == $i ? 'selected' : '' }} value="{{ $i }}">
                                        {{ $status[$i] }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="criterias-detail">
                            <label for="" class="information-label" style="margin-top: 20px">Tiêu chí</label>
                            <div class="criterias">
                                @foreach ($criterias as $criteria)
                                    <div class="criteria">
                                        <i class="fas fa-check"></i>
                                        <p>{{ $criteria->criteria }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="information-action">
                            <button type="submit" class="information-register update_place">Cập nhật địa điểm</button>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </form>
        </div>
    </section>

    @if (session()->has('success'))
        <script>
            Swal.fire(
                'Thành công!',
                'Địa điểm xanh của bạn đã được cập nhật.',
                'success'
            )
        </script>
    @endif
@endsection
