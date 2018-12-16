<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_rates', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('rate');
            $table->text('description');

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_rates');
    }
}
