<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommoditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodities', function (Blueprint $table) {
            $table->increments('id');
            $table->json('tag_ids');
            $table->string('title');
            $table->string('desc');
            $table->json('pic_ids');
            $table->integer('price');
            $table->integer('count')->default(0);
            $table->integer('is_auctioneer')->default(0);
            $table->integer('countdown')->nullable();
            $table->integer('user_id');
            $table->integer('type')->defalt(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commodity');
    }
}
