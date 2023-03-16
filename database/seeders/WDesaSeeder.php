<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wil_desa')->insertOrIgnore([
            ['kecamatan_id' => 1, 'desa_kode' => '0101', 'desa' => 'Bausaran'],
            ['kecamatan_id' => 1, 'desa_kode' => '0102', 'desa' => 'Suryatmajan'],
            ['kecamatan_id' => 1, 'desa_kode' => '0103', 'desa' => 'Tegalpanggung'],
            ['kecamatan_id' => 2, 'desa_kode' => '0201', 'desa' => 'Pringgokusuman'],
            ['kecamatan_id' => 2, 'desa_kode' => '0202', 'desa' => 'Sosromenduran'],
            ['kecamatan_id' => 3, 'desa_kode' => '0301', 'desa' => 'Baciro'],
            ['kecamatan_id' => 3, 'desa_kode' => '0302', 'desa' => 'Demangan'],
            ['kecamatan_id' => 3, 'desa_kode' => '0303', 'desa' => 'Klitren'],
            ['kecamatan_id' => 3, 'desa_kode' => '0304', 'desa' => 'Kotabaru'],
            ['kecamatan_id' => 3, 'desa_kode' => '0305', 'desa' => 'Terban'],
            ['kecamatan_id' => 4, 'desa_kode' => '0401', 'desa' => 'Ngupasan'],
            ['kecamatan_id' => 4, 'desa_kode' => '0402', 'desa' => 'Prawrodirjan'],
            ['kecamatan_id' => 5, 'desa_kode' => '0501', 'desa' => 'Bumijo'],
            ['kecamatan_id' => 5, 'desa_kode' => '0502', 'desa' => 'Cokrodiningrat'],
            ['kecamatan_id' => 5, 'desa_kode' => '0503', 'desa' => 'Gowongan'],
            ['kecamatan_id' => 6, 'desa_kode' => '0601', 'desa' => 'Prenggan'],
            ['kecamatan_id' => 6, 'desa_kode' => '0602', 'desa' => 'Purbayan'],
            ['kecamatan_id' => 6, 'desa_kode' => '0603', 'desa' => 'Rejowinangun'],
            ['kecamatan_id' => 7, 'desa_kode' => '0701', 'desa' => 'Kadipaten'],
            ['kecamatan_id' => 7, 'desa_kode' => '0702', 'desa' => 'Panembahan'],
            ['kecamatan_id' => 7, 'desa_kode' => '0703', 'desa' => 'Patehan'],
            ['kecamatan_id' => 8, 'desa_kode' => '0801', 'desa' => 'Gedongkiwo'],
            ['kecamatan_id' => 8, 'desa_kode' => '0802', 'desa' => 'Mantrijeron'],
            ['kecamatan_id' => 8, 'desa_kode' => '0803', 'desa' => 'Suryodiningratan'],
            ['kecamatan_id' => 9, 'desa_kode' => '0901', 'desa' => 'Brontokusuman'],
            ['kecamatan_id' => 9, 'desa_kode' => '0902', 'desa' => 'Keparakan'],
            ['kecamatan_id' => 9, 'desa_kode' => '0903', 'desa' => 'Wirogunan'],
            ['kecamatan_id' => 10, 'desa_kode' => '1001', 'desa' => 'Ngampilan'],
            ['kecamatan_id' => 10, 'desa_kode' => '1002', 'desa' => 'Notoprajan'],
            ['kecamatan_id' => 11, 'desa_kode' => '1101', 'desa' => 'Gunungketur'],
            ['kecamatan_id' => 11, 'desa_kode' => '1102', 'desa' => 'Purwokinanti'],
            ['kecamatan_id' => 12, 'desa_kode' => '1201', 'desa' => 'Bener'],
            ['kecamatan_id' => 12, 'desa_kode' => '1202', 'desa' => 'Karangwaru'],
            ['kecamatan_id' => 12, 'desa_kode' => '1203', 'desa' => 'Kricak'],
            ['kecamatan_id' => 12, 'desa_kode' => '1204', 'desa' => 'Tegalrejo'],
            ['kecamatan_id' => 13, 'desa_kode' => '1301', 'desa' => 'Giwangan'],
            ['kecamatan_id' => 13, 'desa_kode' => '1302', 'desa' => 'Mujamuju'],
            ['kecamatan_id' => 13, 'desa_kode' => '1303', 'desa' => 'Pandeyan'],
            ['kecamatan_id' => 13, 'desa_kode' => '1304', 'desa' => 'Semaki'],
            ['kecamatan_id' => 13, 'desa_kode' => '1305', 'desa' => 'Sorosutan'],
            ['kecamatan_id' => 13, 'desa_kode' => '1306', 'desa' => 'Tahunan'],
            ['kecamatan_id' => 13, 'desa_kode' => '1307', 'desa' => 'Warungboto'],
            ['kecamatan_id' => 14, 'desa_kode' => '1401', 'desa' => 'Pakuncen'],
            ['kecamatan_id' => 14, 'desa_kode' => '1402', 'desa' => 'Patangpuluh'],
            ['kecamatan_id' => 14, 'desa_kode' => '1403', 'desa' => 'Wirobrajan'],
        ]);
    }
}
