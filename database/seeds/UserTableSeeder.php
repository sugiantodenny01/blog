<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user= App\User::create([
             'name'=> 'Denny',
             'email'=> 'rayleigh_d@yahoo.com',
             'password'=>bcrypt('123456'),
             'admin'=>1
        ]);


        App\profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/admin.jpg',
            'about'=>'korem ipsum lorem ipsum',
            'facebook'=>'facebook.com',
            'youtube'=>'youtube.com'
        ]);
    }
}
