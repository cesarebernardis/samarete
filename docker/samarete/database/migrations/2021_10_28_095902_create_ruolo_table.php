<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuoloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruolo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 100)->index('nome_idx');
            $table->dateTime('data_creazione')->nullable()->useCurrent();
            $table->boolean('attivo')->nullable()->default(1);
        });
		
		DB::table('ruolo')->insert(
			array(
				'id' => '2',
				'nome' => 'associazione',
				'data_creazione' => new \DateTime(),
				'attivo' => 1,
			)
		);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruolo');
    }
}
