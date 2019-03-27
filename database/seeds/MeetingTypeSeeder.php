<?php

use Illuminate\Database\Seeder;
use App\MeetingType;

class MeetingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MeetingType::create([
            'id' => 1,
            'name' => 'default'
        ]);
    }
}
