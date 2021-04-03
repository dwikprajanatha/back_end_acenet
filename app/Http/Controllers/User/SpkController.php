<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SpkController extends Controller
{

    public function getSPK(Request $request)
    {

        try {

            $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
                ->join('tb_admin', 'tb_spk.id_admin', '=', 'tb_admin.id')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->select(
                    'tb_spk.*',
                    'tb_customer.no_pelanggan',
                    'tb_customer.nama',
                    'tb_customer.jenis_layanan',
                    'tb_customer.no_telp',
                    'tb_customer.alamat',
                    'tb_customer.tgl_instalasi',
                    'tb_customer.tgl_trial',
                    'tb_admin.nama_admin'
                )
                ->where('tb_spk.status', 0)
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

            $dateNow = date('Y-m-d', strtotime('+1 days'));
            $twoWeeks = date('Y-m-d', strtotime('+2 weeks'));

            $data = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
                ->join('tb_admin', 'tb_spk.id_admin', '=', 'tb_admin.id')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->select(
                    'tb_spk.*',
                    'tb_customer.no_pelanggan',
                    'tb_customer.nama',
                    'tb_customer.jenis_layanan',
                    'tb_customer.no_telp',
                    'tb_customer.alamat',
                    'tb_customer.tgl_instalasi',
                    'tb_customer.tgl_trial',
                    'tb_admin.nama_admin'
                )
                ->where('tb_spk.status', 0)
                ->where('tb_ikr.id_teknisi', $request->id_teknisi)->whereBetween('tgl_pekerjaan', [$dateNow, $twoWeeks])->get();

            foreach ($data as $d) {
                // dd($d->id);
                $d->jam_mulai = date("H:i", strtotime($d->jam_mulai));
                $d->jam_selesai = date("H:i", strtotime($d->jam_selesai));
            }
        } catch (\Exception $e) {

            $$json_data = [
                "success" => false,
                "message" => "something went wrong",
                'data' => []
            ];
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

            //get tanda tangan
            // $data->ttdTeknisi = Storage::url(DB::table('tb_tanda_tangan')->select('path')->where([['id_spk', $request->id_spk], ['role', 'Teknisi']])->first());
            // $data->ttdCustomer = Storage::url(DB::table('tb_tanda_tangan')->select('path')->where([['id_spk', $request->id_spk], ['role', 'Customer']])->first());

            if ($data->status == 1) {

                $pathTeknisi = DB::table('tb_tanda_tangan')->select('path')->where([['id_spk', $request->id_spk], ['role', 'Teknisi']])->first();
                $pathCustomer = DB::table('tb_tanda_tangan')->select('path')->where([['id_spk', $request->id_spk], ['role', 'Customer']])->first();
                $pathFotoBukti = DB::table('tb_foto_bukti')->select('path')->where('id_spk', $request->id_spk)->first();
                

                $data->ttdTeknisi = Storage::disk('public')->url($pathTeknisi->path);
                $data->ttdCustomer = Storage::disk('public')->url($pathCustomer->path);
                $data->fotoBukti = Storage::disk('public')->url($pathFotoBukti->path);

            } else {

                $data->ttdTeknisi = null;
                $data->ttdCustomer = null;
                $data->fotoBukti = null;
            }

            $json_data = [
                "success" => true,
                "message" => "Success",
                'data' => $data
            ];
        } catch (Exception $e) {

            $json_data = [
                "success" => false,
                "message" => "something went wrong",
                'data' => []
            ];
        }

        return response()->json($json_data);
    }


    public function submitSPK(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_spk' => 'required|numeric',
            'signCustomer' => 'required|mimes:jpg,png,jpeg|max:2048',
            'signTeknisi' => 'required|mimes:jpg,png,jpeg|max:2048',
            'fotoBukti' => 'required|mimes:jpg,png,jpeg|max:2048',
            'keterangan' => 'required|string',
            'download_data' => 'required|string',
            'upload_data' => 'required|string',
            'jam_selesai' => 'required|string',
        ]);



        $signCustomerPath = Storage::disk('public')->putFile('ttd_customer', $request->file('signCustomer'));

        $signTeknisiPath = Storage::disk('public')->putFile('ttd_teknisi', $request->file('signTeknisi'));

        $fotoBukti = Storage::disk('public')->putFile('foto_bukti', $request->file('fotoBukti'));

        $ttdTeknisi = DB::table('tb_tanda_tangan')->insert([
            ['id_spk' => $request->id_spk, 'role' => "Customer", 'path' => $signCustomerPath, 'status' => 1],
            ['id_spk' => $request->id_spk, 'role' => "Teknisi", 'path' => $signTeknisiPath, 'status' => 1],
        ]);

        $up_foto_bukti = DB::table('tb_foto_bukti')->insert(
          ['id_spk' => $request->id_spk, 'path' => $fotoBukti, 'status' => 1]  
        );

        $spk = DB::table('tb_spk')->where('id', $request->id_spk)
            ->update([
                'jam_selesai' => $request->jam_selesai,
                'ket_lanjutan' => $request->keterangan,
                'download_speed' => $request->download_data,
                'upload_speed' => $request->upload_data,
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
                ->select(
                    'tb_spk.*',
                    'tb_customer.no_pelanggan',
                    'tb_customer.nama',
                    'tb_customer.jenis_layanan',
                    'tb_customer.no_telp',
                    'tb_customer.alamat',
                    'tb_customer.tgl_instalasi',
                    'tb_customer.tgl_trial',
                    'tb_admin.nama_admin'
                )
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

    public function getProfile(Request $request)
    {

        $user = DB::table('tb_teknisi')->where('id', Auth::guard('api')->user()->id)->first();

        $data = [
            'id' => $user->id,
            'nama' => $user->nama,
            'username' => $user->username,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'no_telp' => $user->no_telp,
        ];

        $json_data = [
            "success" => true,
            "message" => "Success",
            'data' => $data
        ];

        return response()->json($json_data);
    }

    public function logout()
    {
        // dd($request->id_teknisi);
        DB::table('tb_teknisi')->where('id', Auth::user()->id)->update(['device_id' => null]);

        $json_data = [
            "success" => true,
            "message" => "Success",
            'data' => [],
        ];

        return response()->json($json_data);
    }
}
