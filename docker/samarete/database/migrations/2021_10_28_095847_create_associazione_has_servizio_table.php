<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociazioneHasServizioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associazione_has_servizio', function (Blueprint $table) {
            $table->integer('associazione_id')->index('fk_associazione_has_servizio_associazione1_idx');
            $table->integer('servizio_id')->index('fk_associazione_has_servizio_servizio1_idx');
            $table->boolean('creatore')->default(0);
            
            $table->primary(['associazione_id', 'servizio_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associazione_has_servizio');
    }
}
