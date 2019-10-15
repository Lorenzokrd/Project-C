<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RestaurantRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id')->unsigned();
            $table->foreign('restaurant_id')->references('id')->on('restaurant')->onDelete('cascade');
            $table->decimal('food_score');
            $table->decimal('delivery_score');
            $table->text('comment');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_rating');
    }
}
