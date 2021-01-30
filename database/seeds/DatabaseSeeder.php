<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (['milad', 'mehdi', 'farshad', 'shirzad'] as $username) {
            $user = new User();
            $user->username = $username;
            $user->password = Hash::make('secret');
            $user->save();
        }
    }
}
