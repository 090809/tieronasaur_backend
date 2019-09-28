<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpinionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinion_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('opinion_id');
            $table->unsignedBigInteger('tierlist_item_id');
            $table->unsignedTinyInteger('vote')->default(5);
            $table->timestamps();

            $table->foreign('opinion_id')
                ->references('id')
                ->on('opinions')
                ->onDelete('cascade');

            $table->foreign('tierlist_item_id')
                ->references('id')
                ->on('tierlist_items')
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
        Schema::dropIfExists('opinion_items');
    }
}
