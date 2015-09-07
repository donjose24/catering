<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LineDiscountsAndQuotationTableUpdate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('item_quotation', function($table) {
			$table->double('sub_total')->after('price');
			$table->double('line_discount')->after('price');

		});

		Schema::table('quotations', function($table) {
			$table->string('notes')->after('delivery_status');
			$table->string('installation_status')->after('delivery_status');
			$table->unsignedInteger('agent_id')->after('client_id');

            $table->foreign('agent_id')->references('id')->on('agents');
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

			$table->dropColumn('sub_total');
			$table->dropColumn('line_discount');
		});
		Schema::table('quotations', function($table) {

			$table->dropColumn('notes');
			$table->dropColumn('installation_status');
			$table->dropForeign('quotations_agent_id_foreign');
			$table->dropColumn('agent_id');
		});
	}

}
