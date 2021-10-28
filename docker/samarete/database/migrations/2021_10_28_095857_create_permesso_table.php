<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermessoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permesso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 100)->index('nome_idx');
        });
		
		// Insert default permessi
		$permessi = array(
			array(34, 'add-permesso'),
			array(33, 'add-ruolo'),
			array(22, 'create-associazione'),
			array(39, 'create-chat'),
			array(23, 'create-evento'),
			array(29, 'create-permesso'),
			array(25, 'create-progetto'),
			array(42, 'create-richiesta'),
			array(26, 'create-ruolo'),
			array(27, 'create-servizio'),
			array(28, 'create-user'),
			array(9, 'delete-associazione'),
			array(38, 'delete-chat'),
			array(12, 'delete-evento'),
			array(15, 'delete-file'),
			array(31, 'delete-permesso'),
			array(21, 'delete-progetto'),
			array(43, 'delete-richiesta'),
			array(6, 'delete-ruolo'),
			array(18, 'delete-servizio'),
			array(3, 'delete-user'),
			array(14, 'download-file'),
			array(8, 'edit-associazione'),
			array(37, 'edit-chat'),
			array(11, 'edit-evento'),
			array(30, 'edit-permesso'),
			array(20, 'edit-progetto'),
			array(44, 'edit-richiesta'),
			array(5, 'edit-ruolo'),
			array(17, 'edit-servizio'),
			array(2, 'edit-user'),
			array(36, 'revoke-permesso'),
			array(35, 'revoke-ruolo'),
			array(40, 'send-chat-message'),
			array(24, 'upload-file'),
			array(7, 'view-chat'),
			array(10, 'view-evento'),
			array(13, 'view-file'),
			array(32, 'view-permesso'),
			array(19, 'view-progetto'),
			array(41, 'view-richiesta'),
			array(4, 'view-ruolo'),
			array(16, 'view-servizio'),
			array(1, 'view-user'),
			array(45, 'invita-progetto'),
			array(46, 'publish-file')
		);
		
		foreach($permessi as $permesso)
			DB::table('permesso')->insert(
				array('id' => $permesso[0], 'nome' => $permesso[1])
			);
    }
	

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permesso');
    }
}
