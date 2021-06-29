<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'post' => 'App\Models\Post',
            'member' => 'App\Models\Member',
            'status' => 'App\Models\Status',
            'podcast' => 'App\Models\Podcast',
            'live' => 'App\Models\Live',
            'video' => 'App\Models\Video'
        ]);
    }
}
