<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Mould;
use App\Models\System;
use App\Observers\CategoryObserver;
use App\Observers\LinkObserver;
use App\Observers\MouldObserver;
use App\Observers\SystemObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\Carbon;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Carbon::setLocale('zh');
        \Schema::defaultStringLength(191);

        User::observe(UserObserver::class);
        Link::observe(LinkObserver::class);
        System::observe(SystemObserver::class);
        Mould::observe(MouldObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
