<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('menu', function($table) {
            $table->increments('id');
            $table->string('mcat');
            $table->string('scat');
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->string('image');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('menu_reservation');
	}

}
