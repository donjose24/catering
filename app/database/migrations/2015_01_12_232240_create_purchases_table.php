<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchases',function(Blueprint $table){
			$table->increments('id');
			$table->integer('po_number')->unique()->unsigned();
            $table->string('si_number')->unique();
			$table->integer('supplier_id')->unsigned();
			$table->date('date');
			$table->string('terms');
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
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('purchases');
	}

}
