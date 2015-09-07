<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration {

    public function up()
    {
        Schema::create('reservations', function(Blueprint $table){
            $table->string('id')->unique();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('client_address');
            $table->string('contact');
            $table->string('motif');
            $table->string('venue_address');
            $table->string('event');//
            $table->date('date_request');
            $table->string('status');
            $table->string('event_start');
            $table->string('event_end');
            $table->date('reservation_start');
            $table->date('reservation_end');
            $table->string('payment_mode');
            $table->string('payment_method');
            $table->timestamps();
            $table->softDeletes();
        });


    }

    public function down()
    {
        Schema::drop('reservations');
    }

}
