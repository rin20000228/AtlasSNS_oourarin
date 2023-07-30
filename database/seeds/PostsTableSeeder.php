<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //レコードの初期値
        DB::table('posts')->insert([
            [

                'user_id' => '1',
                'post' => 'お腹すいたbyルフィ',
            ],
            [
                'user_id' => '2',
                'post' => 'お肉食べようbyゾロ',
            ]

        ]);
    }
}
