<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Image;
use App\Models\Criteria;
use App\Models\Rating;
use App\Models\User;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::where('id_user', session()->get('id_user'))
                        ->join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                        ->join('approves', 'approves.id_approve', '=', 'places.id_approve')
                        ->get();
        return view('supplier.index')->with(compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = PlaceType::orderBy('id_place_type', 'ASC')->get();
        return view('supplier.create')->with(compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'placeName' => 'required|max:255',
                'address' => 'required|max:255',
                'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                'images' => 'required',
                'type' => 'required',
                'desc' => 'required|max:255',
                'lat' => 'required',
                'lng' => 'required',
                'criteria' => 'required'
            ],
            [
                'placeName.required' => 'Tên địa điểm không được để trống',
                'image.required' => 'Hình ảnh đại diện không được để trống',
                'images.required' => 'Hình ảnh chi tiết không được để trống',
                'address.required' => 'Địa điểm không được để trống',
                'desc.required' => 'Mô tả không được để trống',
                'lat.required' => 'Vui lòng nhập vĩ độ',
                'lng.required' => 'Vui lòng nhập kinh độ',
            ]
        );

        $place = new Place();
        $place->placeName = $validated['placeName'];
        $place->lat = $validated['lat'];
        $place->lng = $validated['lng'];
        $place->address = $validated['address'];

        $get_image = $request->image;
        $name_image = time() . '.' . $get_image->getClientOriginalExtension();
        $get_image->move(public_path('uploads'), $name_image);
        $place->image = $name_image;

        $place->description = $validated['desc'];
        $place->status = 1;
        $place->star = 0;
        $place->id_place_type = $validated['type'];
        $place->id_user = session()->get('id_user');
        $place->id_approve = 2;

        $place->save();

        $files = $request->images;
        foreach ($files as $file) {
            $name_image = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $name_image);

            $images = new Image();
            $images->id_place = $place->id_place;
            $images->image = $name_image;
            $images->save();
        }

        $criterias = $request->criteria;
        foreach ($criterias as $value) {
            $criteria = new Criteria();
            $criteria->id_place = $place->id_place;
            $criteria->criteria = $value;
            $criteria->save();
        }

        User::where('id_user', session()->get('id_user'))->update(['id_role' => 1]);

        return redirect()->back()->with('success', 'Đăng ký địa điểm xanh thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $place = Place::where('id_place', $id)->get();
        $images = Image::where('id_place', $id)->get();
        $criterias = Criteria::where('id_place', $id)->get();
        return view('supplier.detail')->with(compact('place', 'images', 'criterias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $place = Place::find($id);
        $type = Place::where('id_place', $id)
                    ->join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                    ->first();
        $criterias = Criteria::where('id_place', $id)->get();
        return view('supplier.edit')->with(compact('place', 'type', 'criterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'placeName' => 'required|max:255',
                'desc' => 'required|max:255'
            ],
            [
                'placeName.required' => 'Tên địa điểm không được để trống',
                'desc.required' => 'Mô tả không được để trống'
            ]
        );

        $place = Place::find($id);
        $place->placeName = $validated['placeName'];
        $place->description = $validated['desc'];
        $place->status = $request->status;

        $get_image = $request->image;
        if ($get_image) {
            $path = public_path('uploads/' . $place->image);
            if (file_exists($path)) {
                unlink($path);
            }
            $name_image = time() . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads'), $name_image);
            $place->image = $name_image;
        }

        $place->save();

        $files = $request->images;
        if ($files) {
            $images = Image::where('id_place', $id)->get();
            foreach ($images as $image) {
                $path = public_path('uploads/' . $image->image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            Image::where('id_place', $id)->delete();
            foreach ($files as $file) {
                $name_image = $file->getClientOriginalName();
                $file->move(public_path('uploads'), $name_image);

                $images = new Image();
                $images->id_place = $place->id_place;
                $images->image = $name_image;
                $images->save();
            }
        }

        return redirect()->back()->with('success', 'Cập nhật địa điểm xanh thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $place = Place::find($id);
        $path = public_path('uploads/' . $place->image);
        if (file_exists($path)) {
            unlink($path);
        }

        $images = Image::where('id_place', $id)->get();
        foreach ($images as $image) {
            $path = public_path('uploads/' . $image->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        Rating::where('id_place', $id)->join('comments', 'comments.id_rating', '=', 'ratings.id_rating')->delete();
        Image::where('id_place', $id)->delete();
        Criteria::where('id_place', $id)->delete();
        Place::find($id)->delete();
        
        return response()->json();
    }
}
