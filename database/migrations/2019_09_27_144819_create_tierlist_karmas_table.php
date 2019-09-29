<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTierlistKarmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tierlist_karmas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vk_user_id');
            $table->unsignedBigInteger('tierlist_id');
            $table->tinyInteger('karma')->default(1);
            $table->timestamps();

            $table->foreign('tierlist_id')
                ->references('id')
                ->on('tierlists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tierlist_karmas');
    }
}
