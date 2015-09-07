<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToReservationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('reservations', function($table)
        {
            $table->integer('net_total')->after('reservation_end');
            $table->integer('pax')->after('date_request');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('reservations', function($table)
        {
            $table->dropColumn('net_total');
            $table->dropColumn('pax');
        });
	}

}
