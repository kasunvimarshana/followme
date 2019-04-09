<?php

use Illuminate\Database\Seeder;

use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Status::create([
            'id' => 1,
            'name' => 'Default',
            'is_visible' => 1
        ]);
        
        Status::create([
            'id' => 2,
            'name' => 'In Progress',
            'is_visible' => 1
        ]);
        
        Status::create([
            'id' => 3,
            'name' => 'Compleated',
            'is_visible' => 1
        ]);
    }
}
