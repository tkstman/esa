<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('user_id');
            $table->string('user_name');
            $table->string('frst_nm')->nullable(false);
            $table->string('last_nm')->nullable(false);
            $table->boolean('isActive')->nullable(false);
            $table->string('aud_uid')->nullable(false);
            $table->timestamp('aud_dt')->nullable(false);
            $table->string('remember_token')->nullable(true); 
            //$table->rememberToken();
        });
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
