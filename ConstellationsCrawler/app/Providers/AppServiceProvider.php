<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentUserRepository;
use App\Repositories\Contracts\UserLoginRepository;
use App\Repositories\EloquentConstellationRepository;
use App\Repositories\Contracts\UserRegisterRepository;
use App\Repositories\Contracts\ConstellationReaderRepository;
use App\Repositories\Contracts\ConstellationWriterRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //使用者登入
        $this->app->bind(UserLoginRepository::class,EloquentUserRepository::class);
        //使用者註冊
        $this->app->bind(UserRegisterRepository::class,EloquentUserRepository::class);

        //星座爬蟲
        $this->app->bind(ConstellationReaderRepository::class,EloquentConstellationRepository::class);
        //儲存星座資訊
        $this->app->bind(ConstellationWriterRepository::class,EloquentConstellationRepository::class);
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
