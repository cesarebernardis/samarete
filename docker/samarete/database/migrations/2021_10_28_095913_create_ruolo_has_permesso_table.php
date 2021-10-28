<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuoloHasPermessoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruolo_has_permesso', function (Blueprint $table) {
            $table->integer('ruolo_id')->index('fk_ruolo_has_permesso_ruolo1_idx');
            $table->integer('permesso_id')->index('fk_ruolo_has_permesso_permesso1_idx');
            
            $table->primary(['ruolo_id', 'permesso_id']);
        });
		
		// Insert default permessi for associazione
		$id_ruolo_associazione = 2;
		for($i = 1; $i <= 46; $i++)
			DB::table('ruolo_has_permesso')->insert(
				array('ruolo_id' => $id_ruolo_associazione, 'permesso_id' => $i)
			);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruolo_has_permesso');
    }
}
