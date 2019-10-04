<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Restaurant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique;
            $table->string('password');
            $table->decimal('min_order_price',5,2);
            $table->decimal('delivery_price',5,2);
            $table->integer('avg_delivery_time');
            $table->string('website');
            $table->string('city');
            $table->string('street');
            $table->string('zip_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant');
    }
}
