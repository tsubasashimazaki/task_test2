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
        //クエリビルダ テーブル名(users)
        DB::table('users')->insert([
            ['name' => 'あああ',
            'email' => 'test@test.com',
            //Hash::makeで暗号化
            'password' => Hash::make('password123'),
        ],[
            'name' => 'いいい',
            'email' => 'test2@test.com',
            //Hash::makeで暗号化
            'password' => Hash::make('password123'),
        ],[
            'name' => 'ううう',
            'email' => 'test3@test.com',
            //Hash::makeで暗号化
            'password' => Hash::make('password123'),
        ]
        ]);
    }
}
