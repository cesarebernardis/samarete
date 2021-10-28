<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 100)->unique('username_idx');
            $table->string('password', 100);
            $table->rememberToken();
            $table->string('nome', 100)->nullable();
            $table->string('cognome', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->boolean('admin')->nullable()->default(0);
            $table->dateTime('ultimo_accesso')->nullable();
            $table->boolean('attivo')->default(1);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrent();
            $table->integer('associazione_id')->nullable()->index('fk_users_associazione1_idx');
            $table->string('datapath', 100);
        });
		
		$default_password = "123456";
		$default_email = "admin@email.com";
		$now = new \DateTime();
		
		// Insert admin record
		DB::table('users')->insert(
			array(
				'id' => 1,
				'username' => 'admin',
				'nome' => 'admin',
				'cognome' => 'admin',
				'password' => Hash::make($default_password),
				'email' => $default_email,
				'attivo' => 1,
				'admin' => 1,
				'created_at' => $now,
				'updated_at' => $now,
				'datapath' => 'adminfiles',
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
        Schema::dropIfExists('users');
    }
}
