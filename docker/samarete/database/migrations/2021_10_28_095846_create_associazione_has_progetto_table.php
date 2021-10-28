<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociazioneHasProgettoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associazione_has_progetto', function (Blueprint $table) {
            $table->integer('associazione_id')->index('fk_associazione_has_progetto_associazione1_idx');
            $table->integer('progetto_id')->index('fk_associazione_has_progetto_progetto1_idx');
            $table->boolean('creatore')->default(0);
            
            $table->primary(['associazione_id', 'progetto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associazione_has_progetto');
    }
}
