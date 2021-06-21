<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generating 5 users
        $names = ["sarah", "eve", "dave", "stella", "anna"];
        $emails = ["test@test.com", "eve@eve.com", "real@real.com", "maxwell@maxwell.com", "user@user.com"];
        for ($i=0; $i < 5; $i++) { 
            \App\Models\User::factory()->create([
                "name" => $names[$i],
                "email" => $emails[$i]
            ]);
        }
    }
}
