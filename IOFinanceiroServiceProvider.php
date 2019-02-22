<?php

namespace Dataview\IOFinanceiro;

use Illuminate\Support\ServiceProvider;

class IOFinanceiroServiceProvider extends ServiceProvider
{
    public static function pkgAddr($addr)
    {
        return __DIR__ . '/' . $addr;
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'PlanoConta');
    }

    public function register()
    {
        $this->commands([
            Console\Install::class,
            Console\Remove::class,
        ]);

        $this->app['router']->group(['namespace' => 'dataview\iofinanceiro'], function () {
            include __DIR__ . '/routes/web.php';
        });

        //buscar uma forma de não precisar fazer o make de cada classe
        $this->app->make('Dataview\IOFinanceiro\PlanoContaController');
        $this->app->make('Dataview\IOFinanceiro\PlanoContaRequest');
    }
}
