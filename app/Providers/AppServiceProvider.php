<?php

namespace App\Providers;

use App\Models\Rezerwacje;
use App\Models\Terminy;
use App\Observers\RezerwacjeObserver;
use App\Observers\TerminyObserver;
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
        Terminy::observe(TerminyObserver::class);
        Rezerwacje::observe(RezerwacjeObserver::class);
    }
}
