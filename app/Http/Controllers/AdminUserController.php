<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function show_suppliers()
    {
        $suppliers = User::where('id_role', 1)->withCount('places')->get();
        return view('admin.users.supplier')->with(compact('suppliers'));
    }

    public function show_members()
    {
        $members = User::where('id_role', 2)->get();
        return view('admin.users.member')->with(compact('members'));
    }

    public function authorize_supplier($id_user)
    {
        User::where('id_user', $id_user)->update(['id_role' => 2]);
        return response()->json();
    }

    public function delete_member($id_user)
    {
        User::where('id_user', $id_user)->delete();
        return response()->json();
    }
}
