<?php
namespace Agileti\IOFinanceiro\Console;

use Dataview\IntranetOne\Console\IOServiceInstallCmd;
use Agileti\IOFinanceiro\IOFinanceiroServiceProvider;
use Agileti\IOFinanceiro\FinanceiroSeeder;

class Install extends IOServiceInstallCmd
{
  public function __construct(){
    parent::__construct([
      "service"=>"financeiro",
      "provider"=> IOFinanceiroServiceProvider::class,
      "seeder"=>FinanceiroSeeder::class,
    ]);
  }

  public function handle(){
    parent::handle();
  }
}
