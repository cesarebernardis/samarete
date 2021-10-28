<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRichiestaHasAssociazioneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('richiesta_has_associazione', function (Blueprint $table) {
            $table->integer('richiesta_id')->index('fk_richiesta_has_associazione_richiesta1_idx');
            $table->integer('associazione_id')->index('fk_richiesta_has_associazione_associazione1_idx');
            
            $table->primary(['richiesta_id', 'associazione_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('richiesta_has_associazione');
    }
}
