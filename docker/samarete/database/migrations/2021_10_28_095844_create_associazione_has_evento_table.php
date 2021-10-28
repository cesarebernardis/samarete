<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociazioneHasEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associazione_has_evento', function (Blueprint $table) {
            $table->integer('associazione_id')->index('fk_associazione_has_evento_associazione1_idx');
            $table->integer('evento_id')->index('fk_associazione_has_evento_evento1_idx');
            $table->boolean('creatore')->default(0);
            
            $table->primary(['associazione_id', 'evento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associazione_has_evento');
    }
}
