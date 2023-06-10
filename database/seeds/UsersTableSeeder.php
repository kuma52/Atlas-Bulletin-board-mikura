<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //管理ユーザー
        DB::table('users')->insert([
            'username' => '管理',
            'email' => 'kanri@mail.com',
            'password' => bcrypt('kanridesu'),
            'admin_role' => '1',
        ]);
    }
}
