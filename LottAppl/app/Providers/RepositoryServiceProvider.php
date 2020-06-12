<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Lottery;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Eloquents\LotteryRepository;
use App\Repositories\Interfaces\LotteryRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LotteryRepositoryInterface::class, LotteryRepository::class);
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
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
