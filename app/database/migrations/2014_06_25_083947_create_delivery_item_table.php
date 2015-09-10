<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_item', function($table) {
			$table->increments('id');
			$table->unsignedInteger('delivery_id');
			$table->unsignedInteger('item_id');
			$table->integer('quantity');
			$table->timestamps();
            $table->softDeletes();

			$table->foreign('delivery_id')->references('id')->on('deliveries');
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
		$Schema::dropIfExists('delivery_item');
	}

}
