<?php

namespace App\Http\Controllers\Admin\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class maintenanceBTSController extends Controller
{
    public function index(Request $request)
    {
        // $listSPK = DB::table('tb_spk')->join();

        // // dd($listSPK);

        // $data = [
        //     'title' => 'Maintenance BTS',
        //     'header_title' => 'List SPK Maintenance BTS',
        //     'lists' => $listSPK,
        // ];

        // return view('admin.jadwal.pencabutan.list_jadwal')->with($data);
    }
}
