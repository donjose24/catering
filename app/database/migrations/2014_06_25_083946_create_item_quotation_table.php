<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemQuotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    	Schema::create('item_quotation', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->unsignedInteger('item_id');
            $table->integer('quantity');
            $table->double('price', 15, 2);
            $table->double('line_total', 15, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('quotation_id')->references('id')->on('quotations');
            $table->foreign('item_id')->references('id')->on('items');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('item_quotation');
	}

}
