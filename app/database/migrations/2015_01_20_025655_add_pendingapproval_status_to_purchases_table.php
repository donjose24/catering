<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPendingapprovalStatusToPurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement("ALTER TABLE purchases MODIFY COLUMN billing_status ENUM('Draft', 'PendingApproval', 'Approved', 'SalesOrder', 'Downpayment', 'FullPayment')");
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement("ALTER TABLE purchases MODIFY COLUMN billing_status ENUM('Draft', 'Approved', 'SalesOrder', 'Downpayment', 'FullPayment')");
    }

}
