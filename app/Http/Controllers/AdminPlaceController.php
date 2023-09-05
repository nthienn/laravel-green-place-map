<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Image;
use App\Models\Criteria;
use App\Models\Rating;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class AdminPlaceController extends Controller
{
    public function show_places()
    {
        $places = Place::where('id_approve', 1)
                        ->join('users', 'users.id_user', '=', 'places.id_user')
                        ->join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                        ->get();
        return view('admin.places.index')->with(compact('places'));
    }

    public function show_place_detail($id_place)
    {
        $places = Place::where('id_place', $id_place)
                        ->join('users', 'users.id_user', '=', 'places.id_user')
                        ->join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                        ->get();
        $images = Image::where('id_place', $id_place)->get();
        $criterias = Criteria::where('id_place', $id_place)->get();
        return view('admin.places.detail')->with(compact('places', 'images', 'criterias'));
    }

    public function delete_place($id_place)
    {
        $place = Place::find($id_place);
        $path = public_path('uploads/' . $place->image);
        if (file_exists($path)) {
            unlink($path);
        }

        $images = Image::where('id_place', $id_place)->get();
        foreach ($images as $image) {
            $path = public_path('uploads/' . $image->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        Rating::where('id_place', $id_place)->join('comments', 'comments.id_rating', '=', 'ratings.id_rating')->delete();
        Image::where('id_place', $id_place)->delete();
        Criteria::where('id_place', $id_place)->delete();
        Place::find($id_place)->delete();
        return redirect()->back()->with('status', 'Xoá địa điểm xanh thành công');
    }

    public function show_approves()
    {
        $places = Place::where('id_approve', 2)
                        ->join('users', 'users.id_user', '=', 'places.id_user')
                        ->join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                        ->get();
        return view('admin.places.approve')->with(compact('places'));
    }

    public function show_approve_detail($id_place)
    {
        $places = Place::where('id_place', $id_place)
                        ->join('users', 'users.id_user', '=', 'places.id_user')
                        ->join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                        ->get();
        $images = Image::where('id_place', $id_place)->get();
        $criterias = Criteria::where('id_place', $id_place)->get();
        return view('admin.places.approve-detail')->with(compact('places', 'images', 'criterias'));
    }

    public function approve_place($id_place)
    {
        Place::where('id_place', $id_place)
                ->join('users', 'users.id_user', '=', 'places.id_user')
                ->update(['id_approve' => 1, 'id_role' => 1]);

        $place = Place::where('id_place', $id_place)
                        ->join('users', 'users.id_user', '=', 'places.id_user')
                        ->first();

        $mail = [
            'title' => 'Địa điểm xanh đã được duyệt',
            'content' => 'Xin chào '.$place->name.'! Chúng tôi xin thông báo rằng Địa điểm xanh '.$place->placeName.' của bạn đã được duyệt thành công. Cảm ơn bạn đã cung cấp Địa điểm xanh.'
        ];

        Mail::to($place->email)->send(new Email($mail));

        return response()->json();
    }

    public function delete_approve($id_place)
    {
        $place = Place::where('id_place', $id_place)
                        ->join('users', 'users.id_user', '=', 'places.id_user')
                        ->first();

        $mail = [
            'title' => 'Địa điểm xanh không được duyệt',
            'content' => 'Xin chào '.$place->name.'! Chúng tôi rất tiếc phải thông báo rằng địa điểm '.$place->placeName.' của bạn chưa đủ điều kiện để trở thành Địa điểm xanh. Cảm ơn bạn đã cung cấp địa điểm.'
        ];

        Mail::to($place->email)->send(new Email($mail));

        $path = public_path('uploads/' . $place->image);
        if (file_exists($path)) {
            unlink($path);
        }

        $images = Image::where('id_place', $id_place)->get();
        foreach ($images as $image) {
            $path = public_path('uploads/' . $image->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        Image::where('id_place', $id_place)->delete();
        Criteria::where('id_place', $id_place)->delete();
        Place::find($id_place)->delete();

        return response()->json();
    }
}
