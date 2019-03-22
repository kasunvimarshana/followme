<?php

use Illuminate\Database\Seeder;

use App\department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        department::create([
            'id' => 1,
            'name' => 'default'
        ]);
    }
}
