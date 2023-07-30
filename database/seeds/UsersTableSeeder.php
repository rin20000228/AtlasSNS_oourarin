<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //↓レコード初期値登録
        DB::table('users')->insert([
            [
                'username' => 'ルフィ',
                'mail' => 'luffy@onepeace10',
                //パスワードの暗号処理
                'password' => bcrypt('password')
            ],
            [
                'username' => 'ゾロ',
                'mail' => 'zoro@onepeace20',
                //パスワードの暗号処理
                'password' => bcrypt('password')
            ]

        ]);
    }
}
