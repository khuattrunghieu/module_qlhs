<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Models\RoleUser;


class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function plogin(LoginRequest $request)
    {
        $login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($login)
        {
            return redirect()->route('admin.index');
        }
        return back()->with('message', 'Sai tên tài khoản hoặc mật khẩu, vui lòng đăng nhập lại');
    }

    public function register()
    {
        $accounts = Account::all();
        return view('admin.auth.register', compact('accounts'));
    }

    public function pregister(RegisterRequest $request)
    {
        $data_user = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => $request->account,
            'password' => Hash::make($request->password)
        ];
        $user_id = User::create($data_user);
        $roles = [1, 5, 9, 13];
        foreach($roles as $role)
        {
            RoleUser::create([
                'role_id' => $role,
                'user_id' => $user_id->id,
            ]);
        }
        return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
