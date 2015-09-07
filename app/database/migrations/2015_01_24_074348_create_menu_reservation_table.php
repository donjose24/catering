<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuReservationTable extends Migration {


	public function up()
	{
        Schema::create('menu_reservation', function($table){
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->string('reservation_id');
            $table->string('day');

            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu_reservation');
	}

}
