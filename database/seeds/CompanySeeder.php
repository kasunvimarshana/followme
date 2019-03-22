<?php

use Illuminate\Database\Seeder;

use App\company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        company::create([
            'id' => 1,
            'name' => 'brandix'
        ]);
    }
}
