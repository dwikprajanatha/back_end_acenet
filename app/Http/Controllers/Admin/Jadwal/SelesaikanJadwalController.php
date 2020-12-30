<?php

namespace App\Http\Controllers\Admin\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelesaikanJadwalController extends Controller
{

    public function list_jadwal(Request $request)
    {

        $listSPK = DB::table('tb_spk')
            ->where('status', 0)
            ->orderBy('tgl_pekerjaan', 'asc')->get();

        // $listSPK = DB::table('tb_spk')->get();

        // dd($listSPK);


        $data = [
            'title' => 'Jadwal semua',
            'header_title' => 'List Jadwal',
            'lists' => $listSPK,
        ];

        return view('admin.selesaikan.list_selesai')->with($data);
    }

    public function batalkan(Request $request)
    {
        DB::table('tb_spk')->where('id', $request->id)->update(['status' => 2]);
    }

    public function selesaikan(Request $request)
    {
        DB::table('tb_spk')->where('id', $request->id)->update(['status' => 1]);
    }
}
