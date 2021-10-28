<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasRuoloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_ruolo', function (Blueprint $table) {
            $table->integer('user_id')->index('fk_user_has_ruolo_user_idx');
            $table->integer('ruolo_id')->index('fk_user_has_ruolo_ruolo1_idx');
            
            $table->primary(['user_id', 'ruolo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_ruolo');
    }
}
