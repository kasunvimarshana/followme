<?php

use Illuminate\Database\Seeder;
use App\UserPosition;

class UserPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserPosition::create([
            'id' => 1,
            'name' => 'default'
        ]);
    }
}
