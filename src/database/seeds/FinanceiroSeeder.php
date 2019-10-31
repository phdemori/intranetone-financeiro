<?php
namespace Agileti\IOFinanceiro;

use Illuminate\Database\Seeder;
use Dataview\IntranetOne\Service;
use Sentinel;

class FinanceiroSeeder extends Seeder
{
    public function run(){
      //cria o serviço se ele não existe
      if(!Service::where('service','Financeiro')->exists()){
        Service::insert([
            'service' => "Financeiro",
            'alias' =>'financeiro',
            'ico' => 'ico-dollar',
            'description' => 'Financeiro - Contas a Receber',
            'order' => Service::max('order')+1
          ]);
      }
      //seta privilegios padrão para o role admin
      $adminRole = Sentinel::findRoleBySlug('admin');
      $adminRole->addPermission('financeiro.view');
      $adminRole->addPermission('financeiro.create');
      $adminRole->addPermission('financeiro.update');
      $adminRole->addPermission('financeiro.delete');
      $adminRole->save();

      $odinRole = Sentinel::findRoleBySlug('odin');
      $odinRole->addPermission('financeiro.view');
      $odinRole->addPermission('financeiro.create');
      $odinRole->addPermission('financeiro.update');
      $odinRole->addPermission('financeiro.delete');
      $odinRole->save();

    }
}
