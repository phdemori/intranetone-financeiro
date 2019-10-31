<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceirosMovimentoTable extends Migration
{
    public function up()
    {
        Schema::create('financeiros_movimento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('financeiro_id')->unsigned();
            $table->foreign('financeiro_id')->references('id')->on('financeiros');
            $table->decimal('multa',14,2);
            $table->decimal('juros',14,2);
            $table->decimal('acrescimo',14,2);
            $table->decimal('desconto',14,2);
            $table->decimal('valor_pago',14,2);
            $table->date('data_pago');
            $table->date('data_baixa');
            $table->text('observacao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financeiros_movimento');
    }
}
