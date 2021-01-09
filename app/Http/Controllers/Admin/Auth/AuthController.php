<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|min:8',
        ]);


        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            redirect()->route('dashboard');
        } else {
            redirect()->back();
        }
    }
}
