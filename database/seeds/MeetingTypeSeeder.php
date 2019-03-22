<?php

use Illuminate\Database\Seeder;

use App\meeting_type;

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
        meeting_type::create([
            'id' => 1,
            'name' => 'default'
        ]);
    }
}
