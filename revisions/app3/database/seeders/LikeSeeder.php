<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i=0;
        while (true) {
            try {
                $one = rand(1,5);
                $two = rand(1,20);
                \App\Models\Like::create([
                    "user_id" => $one,
                    "blog_id" => $two
                ]);
            }
            catch (\Illuminate\Database\QueryException $e){
                continue;
            }
            $i++;
            if ($i>80) {
                break;
            }
        }
    }
}
