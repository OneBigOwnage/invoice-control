<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('rate_id');
            $table->unsignedInteger('minutes');
            $table->unsignedInteger('tax_percentage');
            $table->unsignedInteger('sub_total');
            $table->string('description')->nullable();
            $table->dateTime('task_performed_date')->nullable();

            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('rate_id')->references('id')->on('pay_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
