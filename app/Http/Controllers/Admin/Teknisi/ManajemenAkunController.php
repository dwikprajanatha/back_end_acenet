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
        $list_user = DB::table('tb_teknisi')->select('id', 'nama', 'email', 'jabatan', 'no_telp')->where('status', 1)->get();

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
        DB::table('tb_teknisi')->where('id', $request->id)->update(['status', 0]);
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email',
            'jabatan' => 'required',
            'no_telp' => 'required|min:10',
            'username' => 'required|unique:tb_teknisi,email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
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

            $request->session()->flash('success', 'Akun Berhasil Ditambahkan!');
            return redirect()->route('teknisi.index');
        } catch (\Exception $e) {

            DB::rollBack();
            dd($e);
            $request->session()->flash('error', 'Oops.. Sepertinya ada yang salah!');
            return redirect()->back();
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
            return redirect()->back()->withInput()->withErrors($validator);
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

            $request->session()->flash('success', 'Akun Berhasil di Update!');
            return redirect()->route('teknisi.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('error', 'Oops.. Sepertinya ada yang salah!');
            return redirect()->back();
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
            redirect()->back()->withErrors($validator);
        }

        DB::beginTransaction();

        try {

            DB::table('tb_teknisi')->where('id', $request->id_teknisi)->update([
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            $request->session()->flash('success', 'Password berhasil di reset!');
            return redirect()->route('teknisi.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $request->session()->flash('error', 'Oops.. Sepertinya ada yang salah!');
            return redirect()->back();
        }
    }
}
