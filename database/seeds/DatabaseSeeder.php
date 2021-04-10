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
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'name' => 'Diego Soba',
            'email' => 'diego@motionlaw.com',
			'email_verified_at' =>  date("Y-m-d H:i:s"),
            'password' => bcrypt('secret'),
			'remember_token' => '1'
        ],
        [
            'name' => 'Paul Austin',
            'email' => 'paul@motionlaw.com',
			'email_verified_at' =>  date("Y-m-d H:i:s"),
            'password' => bcrypt('secret'),
			'remember_token' => '1'
        ],
        [
            'name' => 'Diana Medina',
            'email' => 'diana@motionlaw.com',
			'email_verified_at' =>  date("Y-m-d H:i:s"),
            'password' => bcrypt('secret'),
			'remember_token' => '1'
        ]);
    }
}
