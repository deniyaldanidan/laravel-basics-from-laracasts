<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <20 ; $i++) { 
            $blog = \App\Models\Blog::factory()->create();
            $blog->tags()->attach([rand(1,3), rand(4,6), rand(7,9)]);
        }
        
    }
}
