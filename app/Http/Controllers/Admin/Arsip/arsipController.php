<?php

namespace App\Http\Controllers\Admin\Arsip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class arsipController extends Controller
{
    public function selesai(Request $request)
    {
        $listSPK = DB::table('tb_spk')->where('status', 1)->get();

        $data = [
            'title' => 'Arsip',
            'header_title' => 'Arsip Jadwal Selesai',
            'lists' => $listSPK,
        ];

        return view('admin.arsip.arsip')->with($data);
    }

    public function dibatalkan(Request $request)
    {
        $listSPK = DB::table('tb_spk')->where('status', 2)->get();

        $data = [
            'title' => 'Arsip',
            'header_title' => 'Arsip Jadwal dibatalkan',
            'lists' => $listSPK,
        ];

        return view('admin.arsip.arsip')->with($data);
    }
}
