<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServizioHasGiornoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servizio_has_giorno', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('servizio_id')->index('fk_servizio_has_giorno_servizio1_idx');
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
        Schema::dropIfExists('servizio_has_giorno');
    }
}
