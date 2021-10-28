<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoHasGiornoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_has_giorno', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('evento_id')->index('fk_evento_has_giorno_evento1_idx');
            $table->date('giorno');
            $table->time('da')->nullable();
            $table->time('a')->nullable();
            $table->string('descrizione', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_has_giorno');
    }
}
