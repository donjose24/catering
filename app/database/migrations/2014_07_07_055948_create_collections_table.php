<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
	    Schema::create('collections', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->string('cr_id')->unique();
            $table->double('amount', 255);
            $table->string('collected_by', 255);
            $table->date('date', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('quotation_id')->references('id')->on('quotations');
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

		Schema::dropIfExists('collections');
	}

}
