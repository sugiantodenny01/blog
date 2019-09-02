<?php

use Illuminate\Database\Seeder;

class settingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\setting::create([
            'site_name'=>'Laravel\'s Blog',
            'address'=>'Jakarta',
            'contact_number'=>'909090',
            'contact_email'=>'rayleigh_d@yahoo.com'

        ]);
    }
}
