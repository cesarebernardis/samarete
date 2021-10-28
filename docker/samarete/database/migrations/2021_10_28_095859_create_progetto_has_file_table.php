<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgettoHasFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progetto_has_file', function (Blueprint $table) {
            $table->integer('progetto_id')->index('fk_progetto_has_file_progetto1_idx');
            $table->integer('file_id')->index('fk_progetto_has_file_file1_idx');
            $table->boolean('public')->default(0);
            
            $table->primary(['progetto_id', 'file_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progetto_has_file');
    }
}
