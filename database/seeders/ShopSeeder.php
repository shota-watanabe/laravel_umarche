<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'owner_id' => '1',
                'name' => 'ここに店名が入ります',
                'information' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。ここにお店の情報が入ります。',
                'filename' => 'https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/buildings_263907238.jpg',
                'is_selling' => true
            ],
            [
                'owner_id' => '2',
                'name' => 'ここに店名が入ります',
                'information' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。ここにお店の情報が入ります。',
                'filename' => 'https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/south-station_341897155.jpg',
                'is_selling' => true
            ],
        ]);
    }
}
