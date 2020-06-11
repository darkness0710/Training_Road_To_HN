<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Lottery;
use App\Repositories\Interfaces\LotteryRepositoryInterface;
use App\Repositories\Eloquents\LotteryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Interfaces\LotteryRepositoryInterface::class, \App\Repositories\Eloquents\LotteryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
