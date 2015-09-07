<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('collections', function($table) {
			$table->enum('payment_type', array('PDC','Cash','CC','Bank Transfer'))->after('amount');
			$table->string('bank_name')->after('amount');
			$table->string('bank_deposit')->after('amount');
			$table->integer('check_number')->after('amount');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('collections', function($table) {

			$table->dropColumn('payment_type');
			$table->dropColumn('bank_name');
			$table->dropColumn('bank_deposit');
			$table->dropColumn('check_number');
		});

	}

}
