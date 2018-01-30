<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    
    public function up()
    {
        Schema::create('APPLICATIONS',function(Blueprint $table){
        $table->increments('app_id');
        $table->string('app_nm')->unique();
        $table->text('app_path');
        $table->string('app_manual_path')->nullable();
        $table->string('app_readme_path')->nullable();
        $table->integer('user_id');
        $table->boolean('is_url');
        $table->timestamp('created_dt')->nullable(false);
        $table->timestamp('uploaded_dt')->nullable(false);
        $table->string('aud_uid')->nullable(false);
        $table->timestamp('aud_dt')->nullable(false);
            
        
    });
        /*Schema::create('posts', function (Blueprint $table) {
            $table->increments('app_id');
            $table->text('SOFT_NAME');
            
            $table->text('SOFT_MANUAL_PATH');
            $table->text('SOFT_README_PATH');
            
        });*/
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('APPLICATIONS');
    }
}
