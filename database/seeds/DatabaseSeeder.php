<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DatabaseSeederの中にあるUsersTableSeederを呼び出す指示
        // $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
    }
}
