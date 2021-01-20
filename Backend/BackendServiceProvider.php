<?php

namespace App\Backend;

use App\Backend\Components\DateRanger;
use App\Backend\Components\TableCreator;
use App\Models\DBMainMenu;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/web.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'B');

        Blade::component('table-creator', TableCreator::class);
        Blade::component('date-ranger', DateRanger::class);

        View::composer(['B::_sidebar', 'B::_breadcrumbs'], function($view) {
            $view->with(['items' => DBMainMenu::getMenu()]);
        });
    }

    public function register()
    {

    }
}
