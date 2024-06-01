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

        DB::table('users')->insert([
            [
                'username' => 'user1',
                'mail' => 'user1@user.com',
                'password' => bcrypt('user1111')
            ]
            ]);
        DB::table('users')->insert([
            [
                'username' => 'user2',
                'mail' => 'user2@user.com',
                'password' => bcrypt('user2222')
            ]
            ]);
        DB::table('users')->insert([
            [
                'username' => 'user3',
                'mail' => 'user3@user.com',
                'password' => bcrypt('user3333')
            ]
            ]);

     }
}
