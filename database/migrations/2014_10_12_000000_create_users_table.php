<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('name');
            $table->string('firstname');
            $table->string('surname');
            $table->string('city');
            $table->string('street');
            $table->string('zipcode');
            $table->string('email')->unique();
            $table->tinyinteger('role')->default('3');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([["name"=>"admin","firstname"=>"admin","surname"=>"admin","city"=>"city","street"=>"street","zipcode"=>"zipcode","email"=>"admin@admin.com","role"=>1,"password"=>"admin123456"]]);
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
