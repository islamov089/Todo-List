<?php

namespace Modules\Item\Providers;

use Illuminate\Support\ServiceProvider;

class ItemServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(base_path('modules/Item/Database/migrations'));

        $this->loadRoutesFrom(base_path('modules/Item/Routes/api.php'));
    }
}
