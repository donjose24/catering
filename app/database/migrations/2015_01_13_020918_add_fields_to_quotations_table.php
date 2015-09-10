<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToQuotationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quotations', function($table) {
			$table->date('si_date')->after('si_number');
			$table->date('so_date')->after('so_number');
		});
	}


	public function down()
	{

		/*Schema::table('collections', function($table) {
			$table->dropColumn('si_date');
			$table->dropColumn('so_date');
		});*/
	}

}
