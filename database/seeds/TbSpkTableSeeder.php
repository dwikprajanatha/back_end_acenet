<?php

use Illuminate\Database\Seeder;

class TbSpkTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT tb_spk ON');

        \DB::table('tb_spk')->delete();

        \DB::table('tb_spk')->insert(array(
            0 =>
            array(
                'id' => '1',
                'id_customer' => '1',
                'id_admin' => '1',
                'no_spk' => '000001',
                'attn' => NULL,
                'ket_pekerjaan' => 'ganti router, adawdawd, kedua, ketiga, keempat',
                'tgl_pekerjaan' => '2020-12-05',
                'jenis_pekerjaan' => '1',
                'jam_mulai' => '18:14:00.0000000',
                'jam_selesai' => '02:14:00.0000000',
                'download_speed' => NULL,
                'upload_speed' => NULL,
                'ket_lanjutan' => NULL,
                'status' => '0',
            ),
            1 =>
            array(
                'id' => '2',
                'id_customer' => '2',
                'id_admin' => '1',
                'no_spk' => '000002',
                'attn' => NULL,
                'ket_pekerjaan' => 'ganti antenna',
                'tgl_pekerjaan' => '2020-12-03',
                'jenis_pekerjaan' => '2',
                'jam_mulai' => '02:15:07.0000000',
                'jam_selesai' => '02:15:07.0000000',
                'download_speed' => NULL,
                'upload_speed' => NULL,
                'ket_lanjutan' => NULL,
                'status' => '1',
            ),
            2 =>
            array(
                'id' => '6',
                'id_customer' => '1',
                'id_admin' => '1',
                'no_spk' => '000003',
                'attn' => NULL,
                'ket_pekerjaan' => 'awdad',
                'tgl_pekerjaan' => '2020-12-05',
                'jenis_pekerjaan' => '1',
                'jam_mulai' => '12:12:00.0000000',
                'jam_selesai' => '12:12:00.0000000',
                'download_speed' => NULL,
                'upload_speed' => NULL,
                'ket_lanjutan' => NULL,
                'status' => '0',
            ),
            3 =>
            array(
                'id' => '7',
                'id_customer' => '2',
                'id_admin' => '1',
                'no_spk' => '000004',
                'attn' => NULL,
                'ket_pekerjaan' => 'Minta ganti Router',
                'tgl_pekerjaan' => '2020-12-07',
                'jenis_pekerjaan' => '2',
                'jam_mulai' => '12:00:00.0000000',
                'jam_selesai' => '14:00:00.0000000',
                'download_speed' => NULL,
                'upload_speed' => NULL,
                'ket_lanjutan' => NULL,
                'status' => '2',
            ),
        ));


        DB::unprepared('SET IDENTITY_INSERT tb_spk OFF');
        DB::commit();
    }
}
