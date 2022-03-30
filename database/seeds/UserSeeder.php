<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User();
        $newUser->name = 'Marco';
        $newUser->email = 'marcotrunc@boolean.it';
        $newUser->password = Hash::make('password');
        $newUser->save();
    }
}
