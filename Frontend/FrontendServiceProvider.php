<?php

namespace App\Frontend;

use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/web.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'F');
    }

    public function register()
    {

    }
}
