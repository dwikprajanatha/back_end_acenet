<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class LaporanTahunan implements FromView
{

    use Exportable;

    public function view(): View
    {

        $arr_spk = DB::table('tb_spk')
            ->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->select(
                'tb_spk.id',
                'tb_spk.no_spk',
                'tb_spk.tgl_pekerjaan',
                'tb_spk.jenis_pekerjaan',
                'tb_customer.nama',
                'tb_customer.no_pelanggan',
                'tb_customer.jenis_layanan',
                'tb_customer.alamat'
            )->whereYear('tb_spk.tgl_pekerjaan', date('Y'))
            ->where('tb_spk.status', 1)
            ->get();

        // dd($arr_spk);

        foreach ($arr_spk as $spk) {
            $ikr = DB::table('tb_ikr')
                ->join('tb_teknisi', 'tb_ikr.id_teknisi', '=', 'tb_teknisi.id')
                ->select('tb_teknisi.nama')
                ->where('tb_ikr.id_spk', $spk->id)
                ->get()->toArray();

            $spk->ikr = $ikr;
        }


        return view('excel.laporanTemplate', [
            'data' => $arr_spk
        ]);
    }
}
