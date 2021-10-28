<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRichiestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('richiesta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contatto_1', 100)->nullable();
            $table->string('contatto_2', 100)->nullable();
            $table->string('oggetto', 200)->nullable();
            $table->text('testo')->nullable();
            $table->boolean('globale')->nullable()->default(0);
            $table->dateTime('data_creazione')->nullable();
            $table->integer('evasa_da')->nullable()->index('fk_richiesta_associazione1_idx');
            $table->dateTime('data_evasione')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('richiesta');
    }
}
