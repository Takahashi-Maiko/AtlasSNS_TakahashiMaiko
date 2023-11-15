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
        //初期ユーザー
        DB::table('users')->insert([
            [
                'username' => 'たかはし',
                'mail' => 'takahashi@gmail.com',
                'password' => bcrypt('takahashi1111')
            ]
            ]);
    }
}
