<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociazioneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associazione', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 200)->index('nome_idx');
            $table->string('acronimo', 45)->nullable();
            $table->string('indirizzo', 200)->nullable();
            $table->string('telefono_1', 20)->nullable();
            $table->string('telefono_2', 20)->nullable();
            $table->string('referente_nome', 100)->nullable();
            $table->string('referente_indirizzo', 200)->nullable();
            $table->string('referente_telefono_1', 20)->nullable();
            $table->string('referente_telefono_2', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('sito_web', 100)->nullable();
            $table->text('descrizione')->nullable();
            $table->integer('gestore_id')->index('fk_associazione_user1_idx');
            $table->dateTime('data_creazione')->useCurrent();
            $table->boolean('attivo')->nullable()->default(1);
            $table->integer('logo')->nullable()->index('fk_associazione_file1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associazione');
    }
}
