<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suppliers',function(Blueprint $table){
			$table->increments('id');
			$table->string('supplier_name');
            $table->string('company_name');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->integer('zip_code');
            $table->string('country');
            $table->string('tel_num');
            $table->string('alt_tel_num');
            $table->string('fax_num');
            $table->string('email');
            $table->string('contact_person');
            $table->string('designation');
            $table->string('notes');
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
		Schema::drop('suppliers');
	}

}
