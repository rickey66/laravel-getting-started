<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdAppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'sdk_app_id'  => 2,
            'store_app_id'  => 3,
            'app_name'   => 'LINE',
            'app_type_id'  => 4,
            'sdk_id'  => 5,
            'api_key'   => 'APIKEY12345',
            'partner_id'  => 6,
            'is_asp'  => 0,
        ];
        DB::table('ad_apps')->insert($param);
    }
}
