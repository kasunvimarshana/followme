<?php

use Illuminate\Database\Seeder;
use App\CompanyLocation;

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
        CompanyLocation::create([
            'id' => 1,
            'name' => 'default',
            'company_id' => 1
        ]);
    }
}
