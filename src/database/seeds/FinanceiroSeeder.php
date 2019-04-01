<?php
namespace Agileti\IOFinanceiro;

use Illuminate\Database\Seeder;
use Dataview\IntranetOne\Service;
use Sentinel;

class FinanceiroSeeder extends Seeder
{
    public function run(){
      //cria o serviço se ele não existe
      if(!Service::where('service','PlanoConta')->exists()){
        Service::insert([
            'service' => "PlanoConta",
            'alias' =>'planoconta',
            'ico' => 'ico-project',
            'description' => 'Plano de Conta',
            'order' => Service::max('order')+1
          ]);
      }
      //seta privilegios padrão para o role admin
      $adminRole = Sentinel::findRoleBySlug('admin');
      $adminRole->addPermission('planoconta.view');
      $adminRole->addPermission('planoconta.create');
      $adminRole->addPermission('planoconta.update');
      $adminRole->addPermission('planoconta.delete');
      $adminRole->save();

    }
} 
