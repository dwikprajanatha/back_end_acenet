<?php

namespace App\Http\Controllers\Admin\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class maintenanceController extends Controller
{
    public function index(Request $request)
    {

        $listSPK = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->join('tb_ap', 'tb_customer.id_ap', '=', 'tb_ap.id')
            ->join('tb_bts', 'tb_ap.id_bts', '=', 'tb_bts.id')
            ->where('tb_spk.status', 0)->where('jenis_pekerjaan', 2)
            ->select('tb_spk.id', 'tb_spk.no_spk', 'tb_customer.nama', 'tb_spk.attn', 'tb_customer.no_telp', 'tb_customer.alamat', 'tb_spk.tgl_pekerjaan', 'tb_customer.jenis_layanan', 'tb_bts.nama_bts', 'tb_ap.nama_ap')
            ->orderBy('tgl_pekerjaan', 'asc')->get();

        // dd($listSPK);

        $data = [
            'title' => 'Maintenance',
            'header_title' => 'List SPK Maintenance',
            'lists' => $listSPK,
        ];

        return view('admin.jadwal.maintenance.list_jadwal')->with($data);
    }

    public function create(Request $request)
    {
        // dd($request);

        $listCustomer = DB::table('tb_customer')->get();

        $listTeknisi = DB::table('tb_teknisi')->get();

        try {
            $no_spk = DB::table('tb_spk')->select('no_spk')->max('no_spk');
            $no_spk += 1;
            $formatted_no_spk = sprintf("%06d", $no_spk);
        } catch (\Throwable $th) {
            //first time no_spk
            $formatted_no_spk = sprintf("%08d", 1);
        }


        $data = [
            'title' => 'Maintenance',
            'header_title' => 'Buat SPK Maintenance',
            'customers' => $listCustomer,
            'teknisi' => $listTeknisi,
            'no_spk' => $formatted_no_spk,
        ];

        return view('admin.jadwal.maintenance.buat_jadwal')->with($data);
    }

    public function getDataCustomer(Request $request)
    {
        $data = DB::table('tb_customer')->join('tb_ap', 'tb_customer.id_ap', '=', 'tb_ap.id')
            ->join('tb_bts', 'tb_ap.id_bts', '=', 'tb_bts.id')
            ->where('tb_customer.id', $request->id)->first();

        $json = [
            'nama' => $data->nama,
            'no_pelanggan' => $data->no_pelanggan,
            'bts' => $data->nama_bts,
            'ap' => $data->nama_ap,
        ];

        return response()->json($json);
    }

    public function post(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|numeric',
            'no_spk' => 'required',
            'attn' => 'nullable',
            'tgl_pekerjaan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'nullable',
            'jenis_perbaikan' => 'required',
            'ket_pekerjaan' => 'nullable',
            'teknisi' => 'array|min:1',
        ]);

        // $customer = DB::table('tb_customer')->find($request->nama_pelanggan);

        if ($validator->fails()) {
            // back to form shows error
        }


        DB::beginTransaction();

        try {

            $spk_id = DB::table('tb_spk')->insertGetId([
                'id_customer' => $request->nama_pelanggan,
                'id_admin' => 1, #Auth()->id
                'no_spk' => $request->no_spk,
                'ket_pekerjaan' => $request->ket_pekerjaan,
                'tgl_pekerjaan' => date('Y-m-d', strtotime($request->tgl_pekerjaan)),
                'jenis_pekerjaan' => $request->jenis_perbaikan,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'status' => 0,
            ]);

            // $arr_device_id = [];

            $ikr = [];

            foreach ($request->teknisi as $tek) {
                array_push($ikr, [
                    'id_spk' => $spk_id,
                    'id_teknisi' => $tek,
                ]);

                // $device_id = DB::table('tb_teknisi')->where('id', $tek)->select('device_id')->first();
                // array_push($arr_device_id, $device_id);
            }

            $ikr = DB::table('tb_ikr')->insert($ikr);

            DB::commit();
            
            // $this->pushNotif($arr_device_id, "Pekerjaan Baru!", "SPK telah ditambahkan, Segera periksa!");

            return redirect()->route('maintenance')->with('success', 'SPK Berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('maintenance')->with('error', 'Sepertinya ada yang salah..');
        }
    }

    public function detail(Request $request)
    {
        $detailSPK = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->join('tb_ap', 'tb_customer.id_ap', '=', 'tb_ap.id')
            ->join('tb_bts', 'tb_ap.id_bts', '=', 'tb_bts.id')
            ->select(
                'tb_spk.*',
                'tb_customer.nama',
                'tb_customer.no_pelanggan',
                'tb_bts.nama_bts',
                'tb_ap.nama_ap'
            )->where('tb_spk.id', $request->id)->first();

        $detailSPK->tgl_pekerjaan = date('d/m/Y', strtotime($detailSPK->tgl_pekerjaan));
        $detailSPK->jam_mulai = date('H:i', strtotime($detailSPK->jam_mulai));
        $detailSPK->jam_selesai = date('H:i', strtotime($detailSPK->jam_selesai));

        $ikr = DB::table('tb_ikr')->join('tb_spk', 'tb_ikr.id_spk', '=', 'tb_spk.id')
            ->join('tb_teknisi', 'tb_ikr.id_teknisi', '=', 'tb_teknisi.id')
            ->where('id_spk', $request->id)->get();

        $data = [
            'title' => 'Maintenance',
            'header_title' => 'Detail SPK Maintenance',
            'spk' => $detailSPK,
            'teknisi' => $ikr,
        ];

        return view('admin.jadwal.maintenance.detail_jadwal')->with($data);
    }

    public function edit(Request $request)
    {
        $detailSPK = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->join('tb_ap', 'tb_customer.id_ap', '=', 'tb_ap.id')
            ->join('tb_bts', 'tb_ap.id_bts', '=', 'tb_bts.id')
            ->where('tb_spk.id', $request->id)->first();

        $detailSPK->tgl_pekerjaan = date('d/m/Y', strtotime($detailSPK->tgl_pekerjaan));
        $detailSPK->jam_mulai = date('H:i', strtotime($detailSPK->jam_mulai));
        $detailSPK->jam_selesai = date('H:i', strtotime($detailSPK->jam_selesai));

        $ikr = DB::table('tb_ikr')->join('tb_spk', 'tb_ikr.id_spk', '=', 'tb_spk.id')
            ->join('tb_teknisi', 'tb_ikr.id_teknisi', '=', 'tb_teknisi.id')
            ->where('id_spk', $request->id)->select('tb_ikr.id_teknisi')->get();

        $dataCustomer = DB::table('tb_customer')->select('nama', 'id')->get();
        $teknisi = DB::table('tb_teknisi')->select('nama', 'id')->get();

        $arr_ikr = [];

        foreach ($ikr as $i) {
            array_push($arr_ikr, $i->id_teknisi);
        }

        // dd($arr_ikr);

        $data = [
            'title' => 'Maintenance',
            'header_title' => 'Edit SPK Maintenance',
            'spk' => $detailSPK,
            'ikr' => $arr_ikr,
            'customers' => $dataCustomer,
            'teknisi' => $teknisi,
            'id_spk' => $request->id,
        ];


        // print_r($ikr[0]);
        // dd($data);

        return view('admin.jadwal.instalasi.edit_jadwal')->with($data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|numeric',
            'no_spk' => 'required',
            'attn' => 'nullable',
            'tgl_pekerjaan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'nullable',
            'jenis_perbaikan' => 'required',
            'ket_pekerjaan' => 'nullable',
            'teknisi' => 'array|min:1',
            'id_spk' => 'required',
        ]);

        // $customer = DB::table('tb_customer')->find($request->nama_pelanggan);

        if ($validator->fails()) {
            // back to form shows error
        }


        DB::beginTransaction();

        try {

            DB::table('tb_spk')->where('id', $request->id_spk)
                ->update([
                    'id_customer' => $request->nama_pelanggan,
                    'id_admin' => 1, #Auth()->id
                    'no_spk' => $request->no_spk,
                    'ket_pekerjaan' => $request->ket_pekerjaan,
                    'tgl_pekerjaan' => date('Y-m-d', strtotime($request->tgl_pekerjaan)),
                    'jenis_pekerjaan' => $request->jenis_perbaikan,
                    'jam_mulai' => $request->jam_mulai,
                    'jam_selesai' => $request->jam_selesai,
                ]);

            $id_ikr = DB::table('tb_ikr')->where('id_spk', $request->id_spk)->select('id')->get();
            // dd($request->id_spk);

            $arr_id_tek = array($request->teknisi);
            $arr_id_tek = $arr_id_tek[0];

            // dd($arr_id_tek);

            // dd(sizeof($id_ikr));

            $countData = sizeof($id_ikr);

            if ($countData < sizeof($request->teknisi)) {

                $count = 0;
                foreach ($id_ikr as $id) {
                    // var_dump($request->teknisi[$count]);
                    // var_dump($id->id);

                    // echo ($arr_id_tek[$count]);
                    DB::table('tb_ikr')->where('id', $id->id)->update(['id_teknisi' => $arr_id_tek[$count]]);
                    $count++;
                }

                for ($i = $count; $i < sizeof($request->teknisi); $i++) {
                    // echo ($x);
                    DB::table('tb_ikr')->insert(['id_teknisi' => $arr_id_tek[$i], 'id_spk' => $request->id_spk]);
                }
                // foreach ($request->teknisi as $teknisi_id) {
                //     DB::table('tb_ikr')->insert(['id_teknisi' => $teknisi_id, 'id_spk' => $request->id]);
                // }
            } else if ($countData == sizeof($request->teknisi)) {
                $count = 0;
                foreach ($id_ikr as $id) {
                    // var_dump($request->teknisi[$count]);
                    // var_dump($id->id);

                    // echo ($arr_id_tek[$count]);
                    DB::table('tb_ikr')->where('id', $id->id)->update(['id_teknisi' => $arr_id_tek[$count]]);
                    $count++;
                }
            } else if ($countData > sizeof($request->teknisi)) {
                $count = 0;
                foreach ($id_ikr as $id) {

                    if ($count < sizeof($request->teknisi)) {
                        DB::table('tb_ikr')->where('id', $id->id)->update(['id_teknisi' => $arr_id_tek[$count]]);
                        $count++;
                    } else {
                        DB::table('tb_ikr')->delete($id->id);
                    }
                }
            }

            DB::commit();

            return redirect()->route('maintenance')->with('success', 'SPK Berhasil diupdate!');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('maintenance')->with('error', 'Sepertinya ada yang salah..');
        }
    }

    public function batal(Request $request)
    {

        try {
            DB::table('tb_spk')->where('id', $request->id)->update(['status' => 2]);

            return redirect()->route('maintenance')->with('success', 'SPK berhasil dibatalkan!');
        } catch (Exception $e) {

            dd($e);
            return redirect()->route('maintenance')->with('error', 'Sepertinya ada yang salah..');
        }
    }
}
