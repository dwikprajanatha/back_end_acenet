<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Exports\LaporanTahunan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class laporanController extends Controller
{
    public function laporanTahunan()
    {

        $year_now = date('Y');

        // dd($year_now);

        //hitung instalasi baru
        $count_instalasi_baru = DB::table('tb_spk')->where('jenis_pekerjaan', 1)->where('tb_spk.status', 1)->whereYear('tgl_pekerjaan', $year_now)->count();

        //hitung maintenance client
        $count_maintenance_client = DB::table('tb_spk')->where('jenis_pekerjaan', 2)->where('tb_spk.status', 1)->whereYear('tgl_pekerjaan', $year_now)->count();

        //hitung maintenance BTS
        $count_maintenance_bts = DB::table('tb_spk')->where('jenis_pekerjaan', 3)->where('tb_spk.status', 1)->whereYear('tgl_pekerjaan', $year_now)->count();

        //hitung pencabutan perangkat
        $count_pencabutan = DB::table('tb_spk')->where('jenis_pekerjaan', 4)->where('tb_spk.status', 1)->whereYear('tgl_pekerjaan', $year_now)->count();

        //list pekerjaan
        $list_pekerjaan = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->where('tb_spk.status', 1)->whereYear('tgl_pekerjaan', $year_now)
            ->select('tb_spk.id', 'tb_spk.no_spk', 'tb_spk.attn', 'tb_spk.jenis_pekerjaan', 'tb_customer.nama', 'tb_customer.jenis_layanan')
            ->orderBy('tgl_pekerjaan', 'asc')->get();

        $data = [
            'title' => 'Laporan Tahunan',
            'periode' => 'Setahun',
            'instalasi_baru' => $count_instalasi_baru,
            'maintenance_client' => $count_maintenance_client,
            'maintenance_bts' => $count_maintenance_bts,
            'pencabutan' => $count_pencabutan,
            'list_pekerjaan' => $list_pekerjaan,
        ];

        return view('admin.laporan.laporan')->with($data);
    }


    public function laporanBulanan()
    {

        $month_now = date('m');

        // dd($month_now);

        //hitung instalasi baru
        $count_instalasi_baru = DB::table('tb_spk')->where('jenis_pekerjaan', 1)->where('tb_spk.status', 1)->whereMonth('tgl_pekerjaan', $month_now)->count();

        //hitung maintenance client
        $count_maintenance_client = DB::table('tb_spk')->where('jenis_pekerjaan', 2)->where('tb_spk.status', 1)->whereMonth('tgl_pekerjaan', $month_now)->count();

        //hitung maintenance BTS
        $count_maintenance_bts = DB::table('tb_spk')->where('jenis_pekerjaan', 3)->where('tb_spk.status', 1)->whereMonth('tgl_pekerjaan', $month_now)->count();

        //hitung pencabutan perangkat
        $count_pencabutan = DB::table('tb_spk')->where('jenis_pekerjaan', 4)->where('tb_spk.status', 1)->whereMonth('tgl_pekerjaan', $month_now)->count();

        //list pekerjaan
        $list_pekerjaan = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->where('tb_spk.status', 1)->whereMonth('tgl_pekerjaan', $month_now)
            ->select('tb_spk.id', 'tb_spk.no_spk', 'tb_spk.attn', 'tb_spk.jenis_pekerjaan', 'tb_customer.nama', 'tb_customer.jenis_layanan')
            ->orderBy('tgl_pekerjaan', 'asc')->get();

        $data = [
            'title' => 'Laporan Bulanan',
            'periode' => 'Sebulan',
            'instalasi_baru' => $count_instalasi_baru,
            'maintenance_client' => $count_maintenance_client,
            'maintenance_bts' => $count_maintenance_bts,
            'pencabutan' => $count_pencabutan,
            'list_pekerjaan' => $list_pekerjaan,
        ];

        return view('admin.laporan.laporan')->with($data);
    }


    public function laporanMingguan()
    {
        $day = date('w');
        $firstDay = date('Y-m-d', strtotime('-' . $day . ' days'));
        $lastDay = date('Y-m-d', strtotime('+' . (6 - $day) . ' days'));

        // dd($firstDay, $lastDay);

        // dd($month_now);

        //hitung instalasi baru
        $count_instalasi_baru = DB::table('tb_spk')->where('jenis_pekerjaan', 1)->where('tb_spk.status', 1)->whereBetween('tgl_pekerjaan', [$firstDay, $lastDay])->count();

        //hitung maintenance client
        $count_maintenance_client = DB::table('tb_spk')->where('jenis_pekerjaan', 2)->where('tb_spk.status', 1)->whereBetween('tgl_pekerjaan', [$firstDay, $lastDay])->count();

        //hitung maintenance BTS
        $count_maintenance_bts = DB::table('tb_spk')->where('jenis_pekerjaan', 3)->where('tb_spk.status', 1)->whereBetween('tgl_pekerjaan', [$firstDay, $lastDay])->count();

        //hitung pencabutan perangkat
        $count_pencabutan = DB::table('tb_spk')->where('jenis_pekerjaan', 4)->where('tb_spk.status', 1)->whereBetween('tgl_pekerjaan', [$firstDay, $lastDay])->count();

        //list pekerjaan
        $list_pekerjaan = DB::table('tb_spk')->join('tb_customer', 'tb_spk.id_customer', '=', 'tb_customer.id')
            ->where('tb_spk.status', 1)->whereBetween('tgl_pekerjaan', [$firstDay, $lastDay])
            ->select('tb_spk.id', 'tb_spk.no_spk', 'tb_spk.attn', 'tb_spk.jenis_pekerjaan', 'tb_customer.nama', 'tb_customer.jenis_layanan')
            ->orderBy('tgl_pekerjaan', 'asc')->get();

        $data = [
            'title' => 'Laporan Mingguan',
            'periode' => 'Seminggu',
            'instalasi_baru' => $count_instalasi_baru,
            'maintenance_client' => $count_maintenance_client,
            'maintenance_bts' => $count_maintenance_bts,
            'pencabutan' => $count_pencabutan,
            'list_pekerjaan' => $list_pekerjaan,
        ];

        return view('admin.laporan.laporan')->with($data);
    }


    //MENAMBAH BRIGHTNESS
    function adjustBrightness($hex, $steps)
    {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
        }

        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';

        foreach ($color_parts as $color) {
            $color   = hexdec($color); // Convert to decimal
            $color   = max(0, min(255, $color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }

        return $return;
    }

    //RANDOM COLOR
    function random_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }


    public function exportExcel(Request $request)
    {

        $filename = 'Laporan_Tahunan_' . date('Y') . '.xlsx';

        return Excel::download(new LaporanTahunan, $filename);
    }

    public function exportPDF(Request $request)
    {

        $filename = 'Laporan_Tahunan_' . date('Y') . '.pdf';

        return (new LaporanTahunan)->download($filename, \Maatwebsite\Excel\Excel::DOMPDF);
    }


    public function test()
    {
        $arr_data = [];

        $bulan = date('M', strtotime("first month of year"));
        // dd($bulan);

        for ($i = 1; $i <= 12; $i++) {

            $dataPerbulan = DB::table('tb_spk')->where('status', 1)->whereMonth('tgl_pekerjaan', $i)->whereYear('tgl_pekerjaan', date('Y'))->count('id');
            // $bulan = date('M', strtotime('+' . $i . 'months'));
            array_push($arr_data, [$bulan, $dataPerbulan]);

            $bulan = date('M', strtotime($bulan . '+ 1 months'));
        }

        // return response()->json($arr_data);

        dd($arr_data);
    }


    // API START HERE
    public function lineChartTahunan(Request $request)
    {

        $arr_data = [];

        $bulan = date('M', strtotime("first month of year"));
        // dd($bulan);

        for ($i = 1; $i <= 12; $i++) {

            $dataPerbulan = DB::table('tb_spk')->where('status', 1)->whereMonth('tgl_pekerjaan', $i)->whereYear('tgl_pekerjaan', date('Y'))->count('id');
            // $bulan = date('M', strtotime('+' . $i . 'months'));
            array_push($arr_data, [$bulan, $dataPerbulan]);

            $bulan = date('M', strtotime($bulan . '+ 1 months'));
        }

        return response()->json($arr_data);

        // dd($arr_data);
    }


    public function donutChartTahunan(Request $request)
    {
        $arr_data = [];

        $arr_teknisi = DB::table('tb_teknisi')->select('id')->orderBy('id', 'asc')->get();

        foreach ($arr_teknisi as $teknisi) {

            $totalSPK = DB::table('tb_spk')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->whereYear('tgl_pekerjaan', date('Y'))
                ->where('tb_spk.status', 1)
                ->where('tb_ikr.id_teknisi', $teknisi->id)
                ->count();

            $namaTeknisi = DB::table('tb_teknisi')->select('nama')->find($teknisi->id);


            $warna_awal = $this->random_color();
            $warna_selected = $this->adjustBrightness($warna_awal, 20);


            array_push($arr_data, [$warna_awal, $warna_selected, $namaTeknisi->nama, $totalSPK]);
        }

        return response()->json($arr_data);
    }


    public function lineChartBulanan(Request $request)
    {
        $arr_data = [];

        $day = date('w');
        $week_start = date('Y-m-d', strtotime('-' . $day . ' days'));
        $week_end = date('Y-m-d', strtotime('+' . (6 - $day) . ' days'));

        // echo ($week_start . '   ' . $week_end);
        // echo ("<br>");


        for ($i = 1; $i <= 4; $i++) {

            $data_perminggu = DB::table('tb_spk')->where('status', 1)->whereBetween('tgl_pekerjaan', [$week_start, $week_end])->count('id');

            $minggu = 'Minggu ke - ' . $i;
            array_push($arr_data, [$minggu, $data_perminggu]);

            //ubah tanggal
            // date_add(date_create($week_start), date_interval_create_from_date_string('1 week'));
            // date_add(date_create($week_end), date_interval_create_from_date_string('1 week'));

            $week_start = date('Y-m-d', strtotime($week_start . "+ 1 week"));
            $week_end = date('Y-m-d', strtotime($week_end . "+ 1 week"));

            // echo ($week_start . '   ' . $week_end);
            // echo ("<br>");
        }

        // dd($arr_data);
        return response()->json($arr_data);
    }


    public function donutChartBulanan(Type $var = null)
    {
        $arr_data = [];

        $arr_teknisi = DB::table('tb_teknisi')->select('id')->orderBy('id', 'asc')->get();

        foreach ($arr_teknisi as $teknisi) {

            $totalSPK = DB::table('tb_spk')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->whereYear('tgl_pekerjaan', date('Y'))
                ->whereMonth('tgl_pekerjaan', date('m'))
                ->where('tb_spk.status', 1)
                ->where('tb_ikr.id_teknisi', $teknisi->id)
                ->count();

            $namaTeknisi = DB::table('tb_teknisi')->select('nama')->find($teknisi->id);


            $warna_awal = $this->random_color();
            $warna_selected = $this->adjustBrightness($warna_awal, 20);


            array_push($arr_data, [$warna_awal, $warna_selected, $namaTeknisi->nama, $totalSPK]);
        }

        return response()->json($arr_data);
    }


    public function lineChartMingguan(Request $request)
    {
        $arr_data = [];

        $day_in_number = date('w');
        $day = date('Y-m-d', strtotime('-' . $day_in_number . ' days'));
        // $week_end = date('Y-m-d', strtotime('+' . (6 - $day) . ' days'));

        // echo ($week_start . '   ' . $week_end);
        // echo ("<br>");


        for ($i = 0; $i < 7; $i++) {

            $data_perhari = DB::table('tb_spk')->where('status', 1)->whereDate('tgl_pekerjaan', $day)->count('id');

            array_push($arr_data, [date('D', strtotime($day)), $data_perhari]);
            //ubah tanggal
            // date_add(date_create($week_start), date_interval_create_from_date_string('1 week'));
            // date_add(date_create($week_end), date_interval_create_from_date_string('1 week'));

            $day = date('Y-m-d', strtotime($day . "+ 1 days"));

            // $week_end = date('Y-m-d', strtotime($week_end . "+ 1 week"));

            // echo ($week_start . '   ' . $week_end);
            // echo ("<br>");
        }

        // dd($arr_data);
        return response()->json($arr_data);
    }

    public function donutChartMingguan(Request $request)
    {
        $arr_data = [];

        $day = date('w');
        $week_start = date('Y-m-d', strtotime('-' . $day . ' days'));
        $week_end = date('Y-m-d', strtotime('+' . (6 - $day) . ' days'));

        $arr_teknisi = DB::table('tb_teknisi')->select('id')->orderBy('id', 'asc')->get();

        foreach ($arr_teknisi as $teknisi) {

            $totalSPK = DB::table('tb_spk')
                ->join('tb_ikr', 'tb_ikr.id_spk', '=', 'tb_spk.id')
                ->whereBetween('tgl_pekerjaan', [$week_start, $week_end])
                ->where('tb_spk.status', 1)
                ->where('tb_ikr.id_teknisi', $teknisi->id)
                ->count();

            $namaTeknisi = DB::table('tb_teknisi')->select('nama')->find($teknisi->id);


            $warna_awal = $this->random_color();
            $warna_selected = $this->adjustBrightness($warna_awal, 20);


            array_push($arr_data, [$warna_awal, $warna_selected, $namaTeknisi->nama, $totalSPK]);
        }

        return response()->json($arr_data);
    }
}
