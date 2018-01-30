<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('USER_ROLE', function (Blueprint $table) {
            $table->integer('user_id')->nullable(false);
            $table->integer('role_id')->nullable(false);
            $table->string('aud_uid')->nullable(false);
            $table->timestamp('aud_dt')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('USER_ROLE');
    }
}
