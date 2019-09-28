<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTierlistItemStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tierlist_item_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tierlist_item_id');
            $table->unsignedInteger('vote_count')->default(0);
            $table->unsignedInteger('vote_score')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('tierlist_item_stats');
    }
}
