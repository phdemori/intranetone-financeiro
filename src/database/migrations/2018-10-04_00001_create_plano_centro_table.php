<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanoCentroTable extends Migration
{
    public function up()
    {
        Schema::create('plano_centro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('featured')->default(false);
            $table->text('description')->nullable();
            $table->dateTime('date_start');
            $table->dateTime('date_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('plano_conta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('featured')->default(false);
            $table->text('description')->nullable();
            $table->dateTime('date_start');
            $table->dateTime('date_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('plano_subconta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('featured')->default(false);
            $table->text('description')->nullable();
            $table->dateTime('date_start');
            $table->dateTime('date_end')->nullable();
            $table->integer('conta_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('conta_id')->references('id')->on('plano_conta')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plano_centro');
        Schema::dropIfExists('plano_conta');
        Schema::dropIfExists('plano_subconta');
    }
}
