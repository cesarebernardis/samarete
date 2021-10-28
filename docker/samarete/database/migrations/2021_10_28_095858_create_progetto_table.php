<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgettoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progetto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 100)->index('nome_idx');
            $table->string('oggetto', 200)->nullable();
            $table->text('descrizione')->nullable();
            $table->dateTime('data_creazione')->useCurrent();
            $table->integer('chat_id')->nullable()->index('fk_progetto_chat1_idx');
            $table->integer('logo')->nullable()->index('fk_progetto_file1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progetto');
    }
}
