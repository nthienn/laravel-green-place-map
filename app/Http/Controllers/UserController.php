<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('userName');
        $password = $request->input('passWord');

        if ($request->input('captcha') != $request->input('captcha-rand')) {
            return redirect()->back()->with('error', 'Captcha không hợp lệ');
        } else {
            $result = User::where('username', $username)->where('password', md5($password))->first();
            if ($result) {
                $request->session()->put('id_user', $result->id_user);
                $request->session()->put('name', $result->name);
                $request->session()->put('id_role', $result->id_role);
                return redirect('/');
            } else {
                return redirect()->back()->with('status', 'Username hoặc mật khẩu không chính xác');
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('id_user');
        $request->session()->forget('name');
        $request->session()->forget('id_role');
        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id_user', session()->get('id_user'))->get();
        return view('pages.profile')->with(compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'username' => 'required|unique:users|max:100',
                'fullname' => 'required|max:100',
                'email' => 'required|unique:users|max:100',
                'phone' => 'required|unique:users|max:10',
                'address' => 'required|max:100',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|max:100|same:password'
            ],
            [
                'username.required' => 'Username không được để trống',
                'username.unique' => 'Username đã tồn tại',
                'fullname.required' => 'Tên không được để trống',
                'phone.required' => 'Số điện thoại không được để trống',
                'phone.unique' => 'Số điện thoại đã được đăng ký',
                'phone.max' => 'Số điện thoại không quá 10 số',
                'email.required' => 'Email không được để trống',
                'email.unique' => 'Email đã được đăng ký',
                'address.required' => 'Địa chỉ không được để trống',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
                'password_confirmation.same' => 'Mật khẩu nhập lại không chính xác'
            ]
        );

        $user = new User();
        $user->name = $validated['fullname'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->username = $validated['username'];
        $user->password = md5($validated['password']);
        $user->id_role = 2;

        $user->save();
        return redirect()->back()->with('success', 'Đăng ký thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('pages.profile-edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'username' => 'required|max:100',
                'fullname' => 'required|max:100',
                'email' => 'required|max:100',
                'phone' => 'required|max:10',
                'address' => 'required|max:100'
            ],
            [
                'username.required' => 'Username không được để trống',
                'fullname.required' => 'Tên không được để trống',
                'phone.required' => 'Số điện thoại không được để trống',
                'phone.max' => 'Số điện thoại không quá 10 số',
                'email.required' => 'Email không được để trống',
                'address.required' => 'Địa chỉ không được để trống'
            ]
        );

        $user = User::find($id);
        $user->name = $validated['fullname'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->username = $validated['username'];

        $user->save();
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function change_password()
    {
        return view('pages.profile-password');
    }

    public function update_password(Request $request)
    {
        $validated = $request->validate(
            [
                'password' => 'required',
                'password_new' => 'required|min:6',
                'password_confirmation' => 'required|same:password_new'
            ],
            [
                'password.required' => 'Mật khẩu không được để trống',
                'password_new.required' => 'Vui lòng nhập mật khẩu mới',
                'password_new.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
                'password_confirmation.same' => 'Mật khẩu nhập lại không chính xác'
            ]
        );

        $password = md5($validated['password']);
        $password_new = md5($validated['password_new']);

        $user = User::where('id_user', session()->get('id_user'))->first();
        if ($password == $user->password) {
            $user->password = $password_new;
            $user->save();
            return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
        } else {
            return redirect()->back()->with('error', 'Mật khẩu không chính xác');
        }
    }

    public function forgot_password(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|exists:users'
            ],
            [
                'email.required' => 'Vui lòng nhập Email',
                'email.exists' => 'Email chưa đăng ký tài khoản'
            ]
        );

        $user = User::where('email', $validated['email'])->first();

        if ($user->email == $request->email) {
            $new_password = substr(md5(rand(0, 999999)), 0, 6);
            $password = md5($new_password);
            $user->password = $password;
            $user->save();

            $mail = [
                'title' => 'Đặt lại mật khẩu thành công',
                'content' => 'Xin chào '.$user->name.'! Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn. Mật khẩu mới của bạn là: '.$new_password.''
            ];

            Mail::to($user->email)->send(new Email($mail));

            return redirect()->back()->with('success_send_email', 'Lấy lại mật khẩu thành công');
        }
    }
}
