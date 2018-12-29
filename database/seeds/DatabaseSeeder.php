<?php

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
            $user = new \App\Models\User();
            $user->username = $username;
            $user->password = bcrypt('123456');
            $user->is_active = 1;
            $user->save();
        }
    }
}
