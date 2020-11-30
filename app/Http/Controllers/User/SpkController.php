<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use DB;

class SpkController extends Controller
{

    public function getSPK(Request $request)
    {

        try {

            $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
                ->join('tb_admin', 'tb_spk.id_admin', '=', 'tb_admin.id')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->select('tb_spk.*', 'tb_customer.*', 'tb_admin.nama_admin')
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

        $dateNow = date('d-m-Y');
        $twoWeeks = date('d-m-Y', strtotime('+2 week', $dateNow));

        $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->join('tb_admin', 'tb_spk.id_admin', '=', 'tb_admin.id')
            ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
            ->select('tb_spk.*', 'tb_customer.*', 'tb_admin.nama_admin')
            ->where('tb_ikr.id_teknisi', $request->id_teknisi)->whereBetween('tgl_perbaikan', [$dateNow, $twoWeeks])->get();

        //ambil data customer dan admin
        // foreach ($data as $d) {
        //     $customer = DB::table('tb_customer')->where('id')
        // }

        foreach ($data as $d) {
            // dd($d->id);
            $d->jam_mulai = date("H:i", strtotime($d->jam_mulai));
            $d->jam_selesai = date("H:i", strtotime($d->jam_selesai));
        }

        // dd($data);

        $json_data = [
            "success" => true,
            "message" => "Success",
            'data' => $data
        ];

        return response()->json($json_data);
    }


    public function getDetailSPK(Request $request)
    {
        $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->where('tb_spk.id', $request->id_spk)->first();

        $ikr = DB::table("tb_ikr")->join("tb_teknisi", "tb_teknisi.id", "=", "tb_ikr.id_teknisi")
            ->where('id_spk', $request->id_spk)->select('tb_teknisi.nama', 'tb_teknisi.id')->get();;

        // $arr_teknisi = [];
        // dd($ikr[0]->nama);
        // if (sizeof($ikr) > 1) {
        //     foreach ($ikr as $i) {
        //         // dd($i);
        //         array_push($arr_teknisi, $i->nama);
        //     }
        // } else {
        //     array_push($arr_teknisi, $ikr[0]->nama);
        // }

        $data->jam_mulai = date("H:i", strtotime($data->jam_mulai));
        $data->jam_selesai = date("H:i", strtotime($data->jam_selesai));


        $data->teknisi = $ikr;

        // dd($data);

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
            ]);

        $json_data = [
            "success" => true,
            "message" => "Success",
            'data' => []
        ];

        return response()->json($json_data);
    }
}
