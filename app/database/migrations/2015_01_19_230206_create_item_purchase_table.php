<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPurchaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('item_purchase', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_id');
            $table->unsignedInteger('item_id');
            $table->integer('quantity');
            $table->double('price', 15, 2);
            $table->double('line_total', 15, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('item_purchase');
	}

}
