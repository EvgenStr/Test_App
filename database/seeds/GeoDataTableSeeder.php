<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeoDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('geo_datas')->insert([
            'id' => 1,
            'latitude' => 51.5085300,
            'longtitude' => -0.1257400,
            'radius' => 10,
            'keyword' => 'football',
        ]);
    }
}
