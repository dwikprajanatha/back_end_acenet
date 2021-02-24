<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\FCM_Push;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    use FCM_Push;

    public function index(Request $request)
    {
        // $arr_device_id = array(
        //     "dyPF8HL9TwqbUHfweUswjH:APA91bHRKawTI05cYi7Ow05iznFhSQuirf0gT5TwsASVzlvUq2wxjWeHHP6kf5uWhVAUs-swflsuTRyVy8sdxXjG2jz_t6t1SmJpTLV5G0MFQ1IgQQNhrH-79ilgOqIX2t0rnhiOMYHJ",
        // );

        // dd($this->pushNotif($arr_device_id, "Acenet Scheduling Teknisi", "Pekerjaan Baru! Ayo Cek Sekarang!"));

        // Session::flush();

        $today = date('Y-m-d');

        //hitung instalasi baru
        $count_instalasi_baru = DB::table('tb_spk')->where('jenis_pekerjaan', 1)->where('tb_spk.status', 0)->whereDate('tgl_pekerjaan', $today)->count();

        //hitung maintenance client
        $count_maintenance_client = DB::table('tb_spk')->where('jenis_pekerjaan', 2)->where('tb_spk.status', 0)->whereDate('tgl_pekerjaan', $today)->count();

        //hitung maintenance BTS
        $count_maintenance_bts = DB::table('tb_spk')->where('jenis_pekerjaan', 3)->where('tb_spk.status', 0)->whereDate('tgl_pekerjaan', $today)->count();

        //hitung pencabutan perangkat
        $count_pencabutan = DB::table('tb_spk')->where('jenis_pekerjaan', 4)->where('tb_spk.status', 0)->whereDate('tgl_pekerjaan', $today)->count();

        //list pekerjaan
        $list_pekerjaan = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->where('tb_spk.status', 0)->whereDate('tgl_pekerjaan', $today)
            ->select('tb_spk.id', 'tb_spk.no_spk', 'tb_spk.attn', 'tb_spk.jenis_pekerjaan', 'tb_customer.nama', 'tb_customer.jenis_layanan')
            ->orderBy('tgl_pekerjaan', 'asc')->get();

        $data = [
            'title' => 'Dasboard',
            'instalasi_baru' => $count_instalasi_baru,
            'maintenance_client' => $count_maintenance_client,
            'maintenance_bts' => $count_maintenance_bts,
            'pencabutan' => $count_pencabutan,
            'list_pekerjaan' => $list_pekerjaan,
        ];

        // dd($list_pekerjaan);

        // dd(Auth::guard('admin')->user()->nama_admin);

        return view('admin.dashboard')->with($data);
    }
}
