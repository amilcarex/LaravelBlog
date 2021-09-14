<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('social_settings')->insert([
            'id' => 1,
            'facebook' =>  null,
            'twitter' =>  null,
            'linkedIn' =>  null,
            'youtube' =>  null,
            'instagram' =>  null,
            'github' =>  null,
            'twitch' =>  null,
        ]);
    }
}
