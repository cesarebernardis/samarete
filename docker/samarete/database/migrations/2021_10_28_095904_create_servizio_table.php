<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServizioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servizio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 100)->index('nome_idx');
            $table->string('oggetto', 200)->nullable();
            $table->text('descrizione')->nullable();
            $table->date('data_inizio')->nullable();
            $table->date('data_fine')->nullable();
            $table->string('periodicita', 45)->nullable();
            $table->dateTime('data_creazione')->useCurrent();
            $table->integer('logo')->nullable()->index('fk_servizio_file1_idx');
            $table->integer('categoria_id')->index('categoria_id');
            $table->string('luogo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servizio');
    }
}
