<?php

namespace Agileti\IOFinanceiro;

use Illuminate\Support\ServiceProvider;

class IOFinanceiroServiceProvider extends ServiceProvider
{
    public static function pkgAddr($addr)
    {
        return __DIR__ . '/' . $addr;
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views/plano_conta', 'PlanoConta');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        $this->commands([
            Console\Install::class,
            Console\Remove::class,
        ]);

        $this->app['router']->group(['namespace' => 'agileti\iofinanceiro'], function () {
            include __DIR__ . '/routes/web.php';
        });

        //buscar uma forma de não precisar fazer o make de cada classe
        $this->app->make('Agileti\IOFinanceiro\PlanoContaController');
        $this->app->make('Agileti\IOFinanceiro\PlanoContaRequest');
    }
}
