<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllocatedAndDeliveredField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('item_quotation', function($table) {
			$table->integer('delivered_quantity')->after('quantity');

		});

		Schema::table('items', function($table) {
			$table->integer('allocated_quantity')->after('total_quantity');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('item_quotation', function($table) {

			$table->dropColumn('delivered_quantity');
		});
		Schema::table('items', function($table) {

			$table->dropColumn('allocated_quantity');
		});
	}

}
