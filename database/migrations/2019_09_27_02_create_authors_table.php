<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vk_user_id')->nullable();
            $table->bigInteger('vk_community_id')->nullable();
            $table->integer('karma')->default(0);
            $table->unsignedInteger('votes')->default(0);
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('vk_user_id')
            //    ->references('id')
            //    ->on('vk_users')
            //    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
