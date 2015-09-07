<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration {

	public function up()
	{
        Schema::create('payments', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_id');
            $table->string('payment_receipt')->unique();
            $table->double('amount', 255);
            $table->string('collected_by', 255);
            $table->date('date', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('purchase_id')->references('id')->on('purchases');
        });
	}

	public function down()
	{
		Schema::dropIfExists('payments');
	}

}
