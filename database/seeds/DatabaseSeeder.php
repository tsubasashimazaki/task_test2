<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);//seederで作成したら読み込む必要がある
        $this->call(ContactFormSeeder::class);
    }
}
