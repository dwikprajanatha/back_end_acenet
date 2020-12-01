<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use DB;
use Exception;

class SpkController extends Controller
{

    public function getSPK(Request $request)
    {

        try {

            $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
                ->join('tb_admin', 'tb_spk.id_admin', '=', 'tb_admin.id')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->select('tb_spk.*', 'tb_customer.*', 'tb_admin.nama_admin')->where('tb_spk.status', 0)
                ->where('tb_ikr.id_teknisi', $request->id_teknisi)->whereDate('tgl_pekerjaan', date('Y-m-d'))->get();


            foreach ($data as $d) {
                $d->jam_mulai = date("H:i", strtotime($d->jam_mulai));
                $d->jam_selesai = date("H:i", strtotime($d->jam_selesai));
            }


            $json_data = [
                "success" => true,
                "message" => "Success",
                'data' => $data
            ];

            return response()->json($json_data);
        } catch (\Throwable $th) {


            $json_data = [
                "success" => false,
                "message" => "something went wrong",
                'data' => []
            ];

            return response()->json($json_data);
        }
    }


    public function upComingSPK(Request $request)
    {

        try {

            $dateNow = date('Y-m-d');
            $twoWeeks = date('Y-m-d', strtotime('+2 weeks'));

            $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
                ->join('tb_admin', 'tb_spk.id_admin', '=', 'tb_admin.id')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->select('tb_spk.*', 'tb_customer.*', 'tb_admin.nama_admin')->where('tb_spk.status', 0)
                ->where('tb_ikr.id_teknisi', $request->id_teknisi)->whereBetween('tgl_pekerjaan', [$dateNow, $twoWeeks])->get();

            foreach ($data as $d) {
                // dd($d->id);
                $d->jam_mulai = date("H:i", strtotime($d->jam_mulai));
                $d->jam_selesai = date("H:i", strtotime($d->jam_selesai));
            }
        } catch (\Exception $e) {

            $data = [];
        }

        $json_data = [
            "success" => true,
            "message" => "Success",
            'data' => $data
        ];

        return response()->json($json_data);
    }


    public function getDetailSPK(Request $request)
    {

        try {

            $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
                ->where('tb_spk.id', $request->id_spk)->first();

            $ikr = DB::table("tb_ikr")->join("tb_teknisi", "tb_teknisi.id", "=", "tb_ikr.id_teknisi")
                ->where('id_spk', $request->id_spk)->select('tb_teknisi.nama', 'tb_teknisi.id')->get();;


            $data->jam_mulai = date("H:i", strtotime($data->jam_mulai));
            $data->jam_selesai = date("H:i", strtotime($data->jam_selesai));


            $data->teknisi = $ikr;
        } catch (Exception $e) {

            $data = null;
        }


        $json_data = [
            "success" => true,
            "message" => "Success",
            'data' => $data
        ];

        return response()->json($json_data);
    }


    public function submitSPK(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_spk' => 'required|numeric',
            'signCustomer' => 'required|mimes:jpg,png,jpeg|max:2048',
            'signTeknisi' => 'required|mimes:jpg,png,jpeg|max:2048',
            'keterangan' => 'required|string',
            'download_data' => 'required|string',
            'upload_data' => 'required|string',
        ]);


        $signCustomerPath = Storage::putFile('ttd_customer', $request->file('signCustomer'));

        $signTeknisiPath = Storage::putFile('ttd_teknisi', $request->file('signTeknisi'));

        $ttdTeknisi = DB::table('tb_tanda_tangan')->insert([
            ['id_spk' => $request->id_spk, 'role' => "Customer", 'path' => $signCustomerPath, 'status' => 1],
            ['id_spk' => $request->id_spk, 'role' => "Teknisi", 'path' => $signTeknisiPath, 'status' => 1],
        ]);

        $spk = DB::table('tb_spk')->where('id', $request->id_spk)
            ->update([
                'ket_lanjutan' => $request->keterangan,
                'download_speed' => $request->download_speed,
                'upload_speed' => $request->upload_speed,
                'status' => 1,
            ]);

        $json_data = [
            "success" => true,
            "message" => "Success",
            'data' => []
        ];

        return response()->json($json_data);
    }

    public function jobCount(Request $request)
    {

        $monthlyCount = DB::table('tb_spk')->join('tb_ikr', 'tb_spk.id', '=', 'tb_ikr.id_spk')
            ->where('tb_ikr.id_teknisi', $request->id_teknisi)->whereMonth('tb_spk.tgl_pekerjaan', date('n'))
            ->where('tb_spk.status', 1)->count();


        $mingguAwal = date('Y-m-d', strtotime('monday this week'));
        $mingguAkhir = date('Y-m-d', strtotime('sunday this week'));

        $weeklyCount = DB::table('tb_spk')->join('tb_ikr', 'tb_spk.id', '=', 'tb_ikr.id_spk')
            ->where('tb_ikr.id_teknisi', $request->id_teknisi)->whereBetween('tb_spk.tgl_pekerjaan', [$mingguAwal, $mingguAkhir])
            ->where('tb_spk.status', 1)->count();


        $json_data = [
            "success" => true,
            "message" => "Success",
            'data' => [
                'monthly_count' => $monthlyCount,
                'weekly_count' => $weeklyCount,
            ]
        ];

        return response()->json($json_data);
    }

    public function listJobDone(Request $request)
    {
        try {

            $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
                ->join('tb_admin', 'tb_spk.id_admin', '=', 'tb_admin.id')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->select('tb_spk.*', 'tb_customer.*', 'tb_admin.nama_admin')
                ->where('tb_ikr.id_teknisi', $request->id_teknisi)->where('tb_spk.status', 1)
                ->whereMonth('tb_spk.tgl_pekerjaan', date('n'))->get();


            foreach ($data as $d) {
                $d->jam_mulai = date("H:i", strtotime($d->jam_mulai));
                $d->jam_selesai = date("H:i", strtotime($d->jam_selesai));
            }


            $json_data = [
                "success" => true,
                "message" => "Success",
                'data' => $data
            ];

            return response()->json($json_data);
        } catch (\Throwable $th) {


            $json_data = [
                "success" => false,
                "message" => "something went wrong",
                'data' => []
            ];

            return response()->json($json_data);
        }
    }
}
