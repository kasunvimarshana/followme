<?php

use Illuminate\Database\Seeder;

use App\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserRole::create([
            'user_pk' => 'kasunv@brandix.com',
            'role_pk' => 'super-admin'
        ]);
        
        UserRole::create([
            'user_pk' => 'ruvishans@brandix.com',
            'role_pk' => 'super-admin'
        ]);
        
        UserRole::create([
            'user_pk' => 'sumithk@brandix.com',
            'role_pk' => 'super-admin'
        ]);
    }
}
