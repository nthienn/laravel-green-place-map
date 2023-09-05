<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        if ($request->session()->has('id_admin')) {
            return view('admin.home');
        } else {
            return view('admin.login');
        }
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = Admin::where('username', $username)->where('password', md5($password))->first();

        if ($result) {
            $request->session()->put('id_admin', $result->id_admin);
            $request->session()->put('username', $result->username);
            return redirect('/admin');
        } else {
            return redirect()->back()->with('status', 'Username hoặc mật khẩu không chính xác');
        }
    }

    public function logout(Request $request) {
        $request->session()->forget('id_admin');
        $request->session()->forget('username');
        return redirect('/admin');
    }
}
