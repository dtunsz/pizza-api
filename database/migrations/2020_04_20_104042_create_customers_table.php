<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('orderId')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('houseNumber');
            $table->string('streetName');
            $table->string('city');
            $table->integer('orderPriceEur');
            $table->integer('orderPriceUsd');
            $table->boolean('confirmed')->default(false);
            $table->boolean('delivered')->default(false);
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
        Schema::dropIfExists('customers');
    }
}
