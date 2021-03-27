<?php

namespace App\Http\Controllers\Admin\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class maintenanceBTSController extends Controller
{
    public function index(Request $request)
    {
        $listSPK = DB::table('tb_spk')->join('tb_maintenance_bts', 'tb_maintenance_bts.id_spk', '=', 'tb_spk.id')
            ->join('tb_bts', 'tb_maintenance_bts.id_bts', '=', 'tb_bts.id')
            ->select('tb_spk.id', 'tb_spk.no_spk', 'tb_bts.nama_bts', 'tb_bts.lokasi', 'tb_spk.tgl_pekerjaan', 'tb_spk.ket_pekerjaan')
            ->where('tb_spk.jenis_pekerjaan', 3)
            ->where('tb_spk.status', 0)
            ->get();

        // dd($listSPK);

        $data = [
            'title' => 'Maintenance BTS',
            'header_title' => 'List SPK Maintenance BTS',
            'lists' => $listSPK,
        ];

        return view('admin.jadwal.bts.list_jadwal')->with($data);
    }

    public function detail(Request $request)
    {
        $spk = DB::table('tb_spk')->where('id', $request->id)->first();

        $ikr = DB::table('tb_ikr')->join('tb_teknisi', 'tb_ikr.id_teknisi', '=', 'tb_teknisi.id')
            ->select('tb_teknisi.id', 'tb_teknisi.nama')
            ->where('tb_ikr.id_spk', $request->id)->get();

        $bts = DB::table('tb_maintenance_bts')->join('tb_bts', 'tb_maintenance_bts.id_bts', '=', 'tb_bts.id')
            ->select('tb_bts.id', 'tb_bts.nama_bts', 'tb_bts.lokasi')
            ->where('tb_maintenance_bts.id_spk', $request->id)->get();


        $spk->tgl_pekerjaan = date('d/m/Y', strtotime($spk->tgl_pekerjaan));
        $spk->jam_mulai = date('H:i', strtotime($spk->jam_mulai));
        $spk->jam_selesai = date('H:i', strtotime($spk->jam_selesai));

        $data = [
            'title' => 'Maintenance BTS',
            'header_title' => 'List SPK Maintenance BTS',
            'spk' => $spk,
            'listBTS' => $bts,
            'listTeknisi' => $ikr,
        ];

        // dd($data);

        return view('admin.jadwal.bts.detail_jadwal')->with($data);
    }

    public function create(Request $request)
    {

        $listTeknisi = DB::table('tb_teknisi')->select('id', 'nama')->get();
        $listBTS = DB::table('tb_bts')->select('id', 'nama_bts')->get();

        try {
            $no_spk = DB::table('tb_spk')->select('no_spk')->max('no_spk');
            $no_spk += 1;
            $formatted_no_spk = sprintf("%06d", $no_spk);
        } catch (\Throwable $th) {
            //first time no_spk
            $formatted_no_spk = sprintf("%08d", 1);
        }

        $data = [
            'title' => 'Maintenance BTS',
            'header_title' => 'Buat SPK Maintenance BTS',
            'listBTS' => $listBTS,
            'teknisi' => $listTeknisi,
            'no_spk' => $formatted_no_spk,
        ];

        return view('admin.jadwal.bts.buat_jadwal')->with($data);
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bts' => 'required|array|min:1',
            'no_spk' => 'required',
            'tgl_pekerjaan' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'jenis_perbaikan' => 'required',
            'ket_pekerjaan' => 'nullable|string',
            'teknisi' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            //return back with error
        }

        DB::beginTransaction();
        try {

            $id_spk = DB::table('tb_spk')->insertGetId([
                'id_customer' => null,
                'id_admin' => 1, #Auth()->id
                'no_spk' => $request->no_spk,
                'attn' => null,
                'ket_pekerjaan' => $request->ket_pekerjaan,
                'tgl_pekerjaan' => date('Y-m-d', strtotime($request->tgl_pekerjaan)),
                'jenis_pekerjaan' => $request->jenis_perbaikan,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'status' => 0,
            ]);

            foreach ($request->teknisi as $id_tek) {
                $ikr = DB::table('tb_ikr')->insert([
                    'id_spk' => $id_spk, 'id_teknisi' => $id_tek,
                ]);
            }

            foreach ($request->id_bts as $bts) {
                $bts = DB::table('tb_maintenance_bts')->insert([
                    'id_spk' => $id_spk, 'id_bts' => $bts,
                ]);
            }

            DB::commit();

            $this->pushNotif($arr_device_id, "Pekerjaan Baru!", "SPK telah ditambahkan, Segera periksa!");

            return redirect()->route('bts')->with('success', 'SPK berhasil dibuat!');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            dd($e);
            return redirect()->route('bts')->with('error', 'Sepertinya ada yang salah..');
        }
    }


    public function edit(Request $request)
    {
        $spk = DB::table('tb_spk')->where('id', $request->id)->first();

        $ikr = DB::table('tb_ikr')->where('tb_ikr.id_spk', $request->id)->get();

        $btsID = DB::table('tb_maintenance_bts')->join('tb_bts', 'tb_maintenance_bts.id_bts', '=', 'tb_bts.id')
            ->select('tb_bts.id')
            ->where('tb_maintenance_bts.id_spk', $request->id)->get()->toArray();

        $listTeknisi = DB::table('tb_teknisi')->get();

        $arr_bts = [];

        foreach ($btsID as $bts) {
            array_push($arr_bts, $bts->id);
        }

        $arr_ikr = [];

        foreach ($ikr as $i) {
            array_push($arr_ikr, $i->id_teknisi);
        }

        // dd($arr_bts);
        // dd($request->id);

        $listBTS = DB::table('tb_bts')->get();

        $spk->tgl_pekerjaan = date('d/m/Y', strtotime($spk->tgl_pekerjaan));
        $spk->jam_mulai = date('H:i', strtotime($spk->jam_mulai));
        $spk->jam_selesai = date('H:i', strtotime($spk->jam_selesai));

        $data = [
            'title' => 'Maintenance BTS',
            'header_title' => 'List SPK Maintenance BTS',
            'spk' => $spk,
            'bts_old' => $arr_bts,
            'listBTS' => $listBTS,
            'ikr' => $arr_ikr,
            'list_teknisi' => $listTeknisi,

        ];

        // dd($data);

        return view('admin.jadwal.bts.edit_jadwal')->with($data);
    }


    public function update(Request $request)
    {

        // dd($request->id_bts[0]);
        $validator = Validator::make($request->all(), [
            'id_bts' => 'required|array|min:1',
            'no_spk' => 'required',
            'tgl_pekerjaan' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'jenis_perbaikan' => 'required',
            'ket_pekerjaan' => 'nullable|string',
            'teknisi' => 'required|array|min:1',
            'id_spk' => 'required',
        ]);

        // dd($request->all());
        if ($validator->fails()) {
            // back to form shows error
        }

        DB::beginTransaction();
        try {

            //update SPK
            DB::table('tb_spk')->where('id', $request->id_spk)
                ->update([
                    'id_customer' => null,
                    'id_admin' => 1, #Auth()->id
                    'no_spk' => $request->no_spk,
                    'ket_pekerjaan' => $request->ket_pekerjaan,
                    'tgl_pekerjaan' => date('Y-m-d', strtotime($request->tgl_pekerjaan)),
                    'jenis_pekerjaan' => $request->jenis_perbaikan,
                    'jam_mulai' => $request->jam_mulai,
                    'jam_selesai' => $request->jam_selesai,
                ]);

            //update BTS
            $id_bts_old = DB::table('tb_maintenance_bts')->where('id_spk', $request->id_spk)->select('id_bts')->get()->toArray();

            $arr_id_bts_old = [];

            // $id_maintenance_bts = DB::table('tb_maintenance_bts')->where('id_spk', $request->id_spk)->select('id')->get()->toArray();
            // // dd($id_maintenance_bts);

            // foreach ($id_maintenance_bts as $id) {
            //     dd($id->id);
            // }

            array_push($arr_id_bts_old, $id_bts_old[0]->id_bts);

            if (sizeof($id_bts_old) < sizeof($request->id_bts)) {
                foreach ($request->id_bts as $new_id_bts) {
                    if (!in_array($new_id_bts, $arr_id_bts_old)) {
                        DB::table('tb_maintenance_bts')->insert([
                            'id_spk' => $request->id_spk,
                            'id_bts' => $new_id_bts,
                        ]);
                    }
                }
            } else if (sizeof($id_bts_old) == sizeof($request->id_bts)) {

                $id_maintenance_bts = DB::table('tb_maintenance_bts')->where('id_spk', $request->id_spk)->select('id')->first();

                foreach ($request->id_bts as $new_id_bts) {
                    // dd($id_bts_old);
                    if (!in_array($new_id_bts, $arr_id_bts_old)) {
                        DB::table('tb_maintenance_bts')->where('id', $id_maintenance_bts)->update(['id_bts' => $new_id_bts]);
                    }
                }
            } else if (sizeof($id_bts_old) > sizeof($request->id_bts)) {

                $id_maintenance_bts = DB::table('tb_maintenance_bts')->where('id_spk', $request->id_spk)->select('id')->get()->toArray();

                $arr_id_maintenance_bts = [];

                foreach ($id_maintenance_bts as $id) {
                    array_push($arr_id_maintenance_bts, $id->id);
                }

                $size_old_bts_id = sizeof($id_bts_old);

                $index = 0;
                foreach ($request->id_bts as $new_id_bts) {
                    DB::table('tb_maintenance_bts')->where('id', $arr_id_maintenance_bts[$index])->update(['id_bts' => $new_id_bts]);
                    $index++;
                }

                while ($index < $size_old_bts_id) {
                    DB::table('tb_maintenance_bts')->delete($arr_id_maintenance_bts[$index]);
                    $index++;
                }
            }


            //Update Teknisi
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
            return redirect()->route('bts')->with('success', 'Update Berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('bts')->with('error', 'Sepertinya ada yang salah..');
        }
    }
}
