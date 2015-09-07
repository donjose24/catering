<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivingsTable extends Migration {


	public function up()
	{
        Schema::create('receivings', function ($table) {

            $table->increments('id');
            $table->string('reference_number')->unique();
            $table->unsignedInteger('purchase_id');
            $table->date('date', 255);
            $table->string('received_by', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('purchase_id')->references('id')->on('purchases');
        });
	}


	public function down()
	{
        Schema::dropIfExists('receivings');
	}

}
