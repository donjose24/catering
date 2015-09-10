<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
	    Schema::create('warehouses', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('street_address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip_code', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
		Schema::dropIfExists('warehouses');
	}

}
