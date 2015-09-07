<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('quotations', function ($table) {
            $table->increments('id');
            $table->string('quotation_number')->unique();
            $table->string('so_number')->unique();
            $table->string('si_number')->unique();
            $table->date('date');
            $table->unsignedInteger('client_id');
            $table->double('terms', 15, 2);
            $table->double('tax', 15, 2);
            $table->double('discount', 15, 2);
            $table->double('grand_total', 15, 2);
            $table->double('net_total', 15, 2);
            $table->string('prepared_by');
            $table->string('approved_by');
            $table->enum('billing_status', array('Draft', 'Approved', 'SalesOrder', 'Downpayment', 'FullPayment'))->default('Draft');
            $table->enum('delivery_status', array('NotDelivered','PartiallyDelivered','CompletelyDelivered'))->default('NotDelivered');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('clients');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('quotations');
	}

}
