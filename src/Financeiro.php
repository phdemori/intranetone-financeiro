<?php
namespace Agileti\IOFinanceiro;

use Dataview\IntranetOne\IOModel;

class Financeiro extends IOModel
{
    protected $fillable = ['entidade_id', 'contrato_id', 'valor', 'vencimento', 'forma_pgto'];

    public static function boot()
    {
        parent::boot();
    }

}
