<?php

use Illuminate\Database\Seeder;

use App\status;

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
        status::create([
            'id' => 1,
            'name' => 'default'
        ]);
    }
}
