<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReceivingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('item_receiving', function($table) {
            $table->increments('id');
            $table->unsignedInteger('receiving_id');
            $table->unsignedInteger('item_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('receiving_id')->references('id')->on('receivings');
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
		Schema::dropIfExists('item_receiving');
	}

}
