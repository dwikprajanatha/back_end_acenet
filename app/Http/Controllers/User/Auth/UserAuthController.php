<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|unique:App\User,username',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:App\User,email',
            'jabatan' => 'required',
            'no_telp' => 'required',
        ]);


        $user = new User();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        $user->no_telp = $request->no_telp;

        if (!$user->save()) {
            dd("error");
        }
    }

    public function login(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:8',

        ]);


        // if ($validate->fails()) {
        //     return response()->json($request);
        // }

        // $guard = Auth::guard('teknisi');

        $login = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::guard('teknisi')->attempt($login)) {

            $data = [
                'nama' => Auth::user()->nama,
                'avatar' => Auth::user()->avatar,
                'id' => Auth::user()->id,
                'access_token' => Auth::user()->createToken('MyApp')->accessToken,
            ];

            $response = [
                'success' => true,
                'messages' => 'Success',
                'data' => $data
            ];

            return response()->json($response);
        } else {

            $response = [
                'success' => false,
                'messages' => 'Login Invalid',
                'data' => []
            ];

            return response()->json($response);
        }
    }

    public function errorLogin(Request $request)
    {
        $response = [
            'success' => false,
            'messages' => 'Please Login',
            'data' => null
        ];

        return response()->json($response);
    }
}
