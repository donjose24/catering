<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDeliveredQuantity extends Migration {


	public function up()
	{
        Schema::table('item_purchase', function($table)
        {
            $table->integer('delivered_quantity')->after('quantity');
        });
	}

	public function down()
	{
        Schema::table('item_purchase', function($table) {

            $table->dropColumn('delivered_quantity');
        });
	}

}
