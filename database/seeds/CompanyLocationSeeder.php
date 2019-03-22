<?php

use Illuminate\Database\Seeder;

use App\company_location;

class CompanyLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        company_location::create([
            'id' => 1,
            'name' => 'default',
            'company' => 1
        ]);
    }
}
