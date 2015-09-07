<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
    	Schema::create('deliveries', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->string('reference_number')->unique();
            $table->date('delivery_date', 255);
            $table->string('delivered_by', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('quotation_id')->references('id')->on('quotations');
        });
        
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('deliveries');
	}

}
