<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 100)->index('nome_idx');
            $table->string('oggetto', 200)->nullable();
            $table->text('descrizione')->nullable();
            $table->dateTime('data_creazione')->useCurrent();
            $table->integer('logo')->nullable()->index('fk_evento_file1_idx');
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
        Schema::dropIfExists('evento');
    }
}
