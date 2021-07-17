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
            $this->_registerDevProviders();
        }
    }

    /**
     * 開発環境のみ登録 ServiceProvider
     */
    protected function _registerDevProviders()
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
        $this->_setOverrideBind();
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

    /**
     * Laravel 標準を上書きする bind 設定
     */
    protected function _setOverrideBind()
    {
        $this->app->bind(\Illuminate\Http\RedirectResponse::class, \App\Support\RedirectResponse::class);
    }
}
