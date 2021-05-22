<?php

namespace App\Providers;

use App\Repositories\Contracts\UserLoginRepository;
use App\Repositories\Contracts\UserRegisterRepository;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserLoginRepository::class,EloquentUserRepository::class);
        $this->app->bind(UserRegisterRepository::class,EloquentUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
