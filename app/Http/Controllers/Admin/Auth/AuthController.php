<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'username' => 'required',
            'password' => 'required|min:8',
        ]);

        $admin = new Admin();
        $admin->nama = $request->nama;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);

        if (!$admin->save()) {
            dd("error");
        }
    }


    public function login(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);


        $login = [
            'username' => $request->username,
            'password' => $request->password
        ];

        // dd($login);

        if (Auth::guard('admin')->attempt($login)) {
            // dd("masuk jon");
            return redirect()->route('dashboard');
            // dd(Auth::guard('admin')->user());
        } else {
            // dd("error jon");

            // Session::flash('error', "Sepertinya ada yang salah..");

            return redirect()->back()->with('error', "Sepertinya ada yang salah..");
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('login.view')->with('success', "Berhasil Logout!");
    }

    public function login_form()
    {
        return view('admin.login.login');
    }
}
