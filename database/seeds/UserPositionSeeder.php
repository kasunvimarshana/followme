<?php

use Illuminate\Database\Seeder;

use App\user_position;

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
        user_position::create([
            'id' => 1,
            'name' => 'default'
        ]);
    }
}
