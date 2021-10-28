<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatHasAssociazioneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_has_associazione', function (Blueprint $table) {
            $table->integer('chat_id')->index('fk_chat_has_associazione_chat1_idx');
            $table->integer('associazione_id')->index('fk_chat_has_associazione_associazione1_idx');
            $table->dateTime('last_access')->useCurrent();
            
            $table->primary(['chat_id', 'associazione_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_has_associazione');
    }
}
