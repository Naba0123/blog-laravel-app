<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
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
        if ($this->app->isLocal()) {
            $this->_registerLocalProviders();
        }
    }

    /**
     * ローカル環境のみ登録 ServiceProvider
     */
    protected function _registerLocalProviders()
    {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->_setCarbonNow();
    }

    /**
     * carbon_now 設定
     */
    protected function _setCarbonNow()
    {
        $this->app->singleton('carbon_now', function() {
            return CarbonImmutable::now();
        });
    }
}
