<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUniqueFromQuotation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quotations', function($table)
		{
			$table->dropUnique('quotations_so_number_unique');
			$table->dropUnique('quotations_si_number_unique');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quotations', function($table)
		{
			$table->unique('so_number');
			$table->unique('si_number');
		});
	}

}
