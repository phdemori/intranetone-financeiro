<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceirosTable extends Migration
{
    public function up()
    {
        Schema::create('financeiros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->integer('entidade_id');
            $table->foreign('entidade_id')->references('id')->on('entidades');
            $table->enum('forma_pgto',['DINHEIRO','CARTEIRA','CHEQUE','CARTÃO DÉBITO','CARTÃO CRÉDITO','BOLETO','DEPOSITO'])->default('BOLETO');
            $table->date('vencimento');
            $table->string('title');
            $table->decimal('valorp',14,2);
            $table->integer('parcela');
            $table->integer('parcela_pai');
            $table->enum('parcela_parcial',['S','N'])->default('N');
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
        Schema::dropIfExists('financeiros');
    }
}
