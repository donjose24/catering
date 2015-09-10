<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    	Schema::create('items', function ($table) {
            $table->increments('id');
            $table->string('model_number', 255);
            $table->string('description', 255);
            $table->string('dimensions', 255);
            $table->double('average_price', 15, 2);
            $table->integer('total_quantity');
            $table->integer('alert_quantity');
            $table->unsignedInteger('itemtype_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('itemtype_id')->references('id')->on('itemtypes');

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('items');
	}

}
