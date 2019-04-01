<?php
namespace Agileti\IOFinanceiro;

use Dataview\IntranetOne\IOModel;

class PlanoConta extends IOModel
{
    protected $fillable = ['title', 'description', 'featured', 'date_start', 'date_end'];

    public function getMainCategory()
    {
        $main = $this->categories()->where('main', true)->first();
        return blank($main) ? $this->categories()->first() : $main;
    }

    public static function boot()
    {
        parent::boot();
    }
}
