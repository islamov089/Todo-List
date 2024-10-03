<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(base_path('modules/user/Database/migrations'));

            $this->loadRoutesFrom(base_path('modules/user/Routes/api.php'));

    }


    public function register()
    {
    }
}
