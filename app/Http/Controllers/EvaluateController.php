<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Place;

class EvaluateController extends Controller
{
    public function show_comments()
    {
        $ratings = Rating::join('users', 'users.id_user', '=', 'ratings.id_user')
                            ->join('places', 'places.id_place', '=', 'ratings.id_place')
                            ->join('comments', 'comments.id_rating', '=', 'ratings.id_rating')
                            ->get();
        return view('admin.comments.index')->with(compact('ratings'));
    }

    public function hide_comment($id_comment)
    {
        Comment::where('id_comment', $id_comment)->update(['status' => 0]);
        return redirect()->back()->with('success_hide', 'Đánh giá thành công');
    }

    public function show_comment($id_comment)
    {
        Comment::where('id_comment', $id_comment)->update(['status' => 1]);
        return redirect()->back()->with('success_show', 'Đánh giá thành công');
    }

    public function evaluate(Request $request, $id_place)
    {
        $validated = $request->validate(
            [
                'comment' => 'required|max:255'
            ],
            [
                'comment.required' => 'Vui lòng nhập bình luận'
            ]
        );

        $rating = new Rating();
        $rating->id_user = session()->get('id_user');
        $rating->id_place = $id_place;
        $rating->rating = $request->rating;
        $rating->save();

        $comment = new Comment();
        $comment->id_rating = $rating->id_rating;
        $comment->content = $validated['comment'];
        $comment->date = date('Y-m-d');
        $comment->status = 1;
        $comment->save();

        $avg_rating = Rating::where('id_place', $id_place)->avg('rating');
        $avg_rating = round($avg_rating, 1);
        Place::where('id_place', $id_place)->update(['star' => $avg_rating]);

        return redirect()->back()->with('success', 'Đánh giá thành công');
    }
}
