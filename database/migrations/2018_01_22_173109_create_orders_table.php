<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('salutation')->nullable();
            $table->string('name');
            $table->string('street');
            $table->string('zip');
            $table->string('town');
            $table->string('country');
            $table->string('email');
            $table->string('company');
            $table->string('phone');
            $table->string('payment');
            $table->boolean('terms');
            $table->boolean('disclaimer');
            $table->string('products');
            $table->string('sum');
            $table->string('delivery')->nullable();
            $table->string('shippingCost');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users');

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
        Schema::dropIfExists('orders');
    }
}
