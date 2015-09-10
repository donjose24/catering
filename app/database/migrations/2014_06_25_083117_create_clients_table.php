<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('clients', function ($table) {
            $table->increments('id');
            $table->string('customer_name');
            $table->string('company_name')->unique();
            $table->string('street_address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip_code', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('tel_num', 15);
            $table->string('alt_tel_num', 15)->nullable();
            $table->string('fax_num', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('contact_person', 100)->nullable();
            $table->string('designation', 100)->nullable();
            $table->string('notes', 100)->nullable();
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
		Schema::dropIfExists('clients');
	}

}
