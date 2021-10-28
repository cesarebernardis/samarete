<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessaggioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messaggio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('autore_id')->index('fk_messaggio_associazione1_idx');
            $table->dateTime('data')->useCurrent();
            $table->text('testo')->nullable();
            $table->integer('chat_id')->index('fk_messaggio_chat1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messaggio');
    }
}
