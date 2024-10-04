<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ToDoPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../modules/Item/Routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../../modules/User/Routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../../modules/Item/Database/migrations');
        $this->loadMigrationsFrom(__DIR__.'/../../modules/User/Database/migrations');
    }
}
