<?php

namespace App\Http\Controllers\Admin\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManajemenAkunController extends Controller
{
    public function index()
    {
        $list_user = DB::table('tb_teknisi')->select('id', 'nama', 'email', 'jabatan', 'no_telp')->get();

        $data = [
            'title' => 'Manajemen Akun',
            'header_title' => 'List Akun Teknisi',
            'lists' => $list_user,
        ];

        return view('admin.akun.list_akun')->with($data);
    }

    public function edit(Request $request)
    {
        $user = DB::table('tb_teknisi')->select('id', 'nama', 'username', 'email', 'jabatan', 'no_telp')->where('id', $request->id)->first();

        $data = [
            'title' => 'Manajemen Akun',
            'header_title' => 'Edit Akun Teknisi',
            'user' => $user,
        ];

        return view('admin.akun.edit_akun')->with($data);
    }

    public function create()
    {
        $data = [
            'title' => 'Manajemen Akun',
            'header_title' => 'Tambah Akun Teknisi',
        ];

        return view('admin.akun.tambah_akun')->with($data);
    }

    public function delete(Request $request)
    {
        # code...
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email',
            'jabatan' => 'required',
            'no_telp' => 'required|min:10',
            'username' => 'required|unique:tb_teknisi,email',
        ]);

        if ($validator->fails()) {
            dd($validator);
        }

        DB::beginTransaction();

        try {

            DB::table('tb_teknisi')->insert([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'avatar' => null,
                'jabatan' => $request->jabatan,
                'no_telp' => $request->no_telp,
            ]);

            DB::commit();

            return redirect()->route('teknisi.index')->with('success', 'Akun Berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('error', 'Sepertinya ada yang salah!');
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email',
            'jabatan' => 'required',
            'no_telp' => 'required|min:10',
            'id_teknisi' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator);
        }

        DB::beginTransaction();

        try {

            DB::table('tb_teknisi')->where('id', $request->id_teknisi)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'avatar' => null,
                'jabatan' => $request->jabatan,
                'no_telp' => $request->no_telp,
            ]);

            DB::commit();

            return redirect()->route('teknisi.index')->with('success', 'Akun Berhasil di update!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('error', 'Sepertinya ada yang salah!');
        }
    }


    public function password(Request $request)
    {

        $user_id = $request->id;

        $data = [
            'title' => 'Manajemen Akun',
            'header_title' => 'Reset Password Akun Teknisi',
            'user_id' => $user_id,
        ];

        return view('admin.akun.reset_password')->with($data);
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
            'id_teknisi' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator);
        }

        DB::beginTransaction();

        try {

            DB::table('tb_teknisi')->where('id', $request->id_teknisi)->update([
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return redirect()->route('teknisi.index')->with('success', 'Password berhasil diubah!');
        } catch (\Exception $e) {

            DB::rollBack();

            dd($e);
            return redirect()->back()->with('error', 'Sepertinya ada yang salah!');
        }
    }
}
