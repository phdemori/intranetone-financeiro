<?php
namespace Agileti\IOFinanceiro\Console;
use Dataview\IntranetOne\Console\IOServiceRemoveCmd;
use Agileti\IOFinanceiro\IOFinanceiroServiceProvider;
use Dataview\IntranetOne\IntranetOne;


class Remove extends IOServiceRemoveCmd
{
  public function __construct(){
    parent::__construct([
      "service"=>"Financeiro",
    ]);
  }

  public function handle(){
    parent::handle();
  }
}
