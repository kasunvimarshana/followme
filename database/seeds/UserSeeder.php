<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('secret')
        ]);
        
        User::create([
            'name' => str_random(8),
            'email' => str_random(12).'@mail.com',
            'password' => bcrypt('123456')
        ]);
        */
        
        User::create([
            'id' => 0,
            'name' => 'admin',
            'email' => 'admin@brandix.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'epf_no' => 0,
            'phone' => '0000000000',
            'status' => '1'
        ]);
    }
}
