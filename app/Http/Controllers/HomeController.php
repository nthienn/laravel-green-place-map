<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Image;
use App\Models\Criteria;
use App\Models\Rating;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $places = Place::join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                        ->where('id_approve', 1)
                        ->orderBy('star', 'DESC')
                        ->limit(5)
                        ->get();
        return view('home')->with(compact('places'));
    }

    public function show_places()
    {
        $places = Place::join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                        ->where('id_approve', 1)
                        ->orderBy('star', 'DESC')
                        ->paginate(40);
        return view('pages.places')->with(compact('places'));
    }

    public function show_places_type($name_type, $id_type)
    {
        $places = Place::where('id_place_type', $id_type)
                        ->where('id_approve', 1)
                        ->orderBy('star', 'DESC')
                        ->paginate(40);
        $type = PlaceType::where('id_place_type', $id_type)->first();
        return view('pages.places-type')->with(compact('places', 'type'));
    }

    public function search(Request $request)
    {
        $key_word = $request->key_word;
        $places = Place::join('place_types', 'place_types.id_place_type', '=', 'places.id_place_type')
                        ->where('id_approve', 1)
                        ->where('placeName', 'LIKE', "%$key_word%")
                        ->orWhere('address', 'LIKE', "%$key_word%")
                        ->orderBy('star', 'DESC')
                        ->paginate(40);
        return view('pages.search')->with(compact('places', 'key_word'));
    }

    public function show_place_detail($id_place)
    {
        $place = Place::where('id_place', $id_place)
                        ->withCount('ratings')
                        ->get();
        $user = User::join('places', 'places.id_user', '=', 'users.id_user')
                        ->where('id_place', $id_place)
                        ->first();
        $images = Image::where('id_place', $id_place)->get();
        $criterias = Criteria::where('id_place', $id_place)->get();
        $ratings = Rating::where('id_place', $id_place)
                        ->join('users', 'users.id_user', '=', 'ratings.id_user')
                        ->join('comments', 'comments.id_rating', '=', 'ratings.id_rating')
                        ->get();
        $user_rating = Rating::where('id_place', $id_place)
                            ->where('id_user', session()->get('id_user'))
                            ->exists();
        return view('pages.place-detail')->with(compact('place', 'user', 'images', 'criterias', 'ratings', 'user_rating'));
    }
}
