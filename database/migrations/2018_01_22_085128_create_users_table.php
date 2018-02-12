<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('password');
            $table->string('email')->unique();
            $table->string('api_token', 60)->unique()->nullable();
            $table->boolean('activated')->nullable();
            $table->string('activation_code', 60)->unique()->nullable();
            $table->string('browser')->nullable();
            $table->string('ip')->nullable();
            $table->boolean('newsletter')->nullable();
            $table->string('salutation');
            $table->string('name');
            $table->string('street');
            $table->integer('zip');
            $table->string('town');
            $table->string('country');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('delivery_name')->nullable();
            $table->string('delivery_street')->nullable();
            $table->integer('delivery_zip')->nullable();
            $table->string('delivery_town')->nullable();
            $table->string('delivery_country')->nullable();
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
        Schema::drop('users');
    }
}
