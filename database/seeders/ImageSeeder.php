<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'owner_id' => '1',
                'filename' => 'https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/gift1_1405296092.jpg',
                'title' => null
            ],
            [
                'owner_id' => '1',
                'filename' => 'https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/gift2_136513965.jpg',
                'title' => null
            ],
            [
                'owner_id' => '1',
                'filename' => 'https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/gift3_478393583.jpg',
                'title' => null
            ],
            [
                'owner_id' => '1',
                'filename' => 'https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/gift4_1323943721.jpg',
                'title' => null
            ],
            [
                'owner_id' => '1',
                'filename' => 'https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/gift5_776091544.jpg',
                'title' => null
            ],
            [
                'owner_id' => '1',
                'filename' => 'https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/present_1443180722.jpg',
                'title' => null
            ],
        ]);
    }
}
