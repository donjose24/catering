<?php

use Quotation;
use Delivery;
use Collection;

class FormController extends BaseController {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function printSalesOrder(Quotation $quotation)
	{
		return View::make('forms.salesorder')
			->withQuotation($quotation);
	}

	protected function printQuotation(Quotation $quotation)
	{
		return View::make('forms.quotation')
			->withQuotation($quotation);
	}

	protected function printDeliveryReceipt(Delivery $delivery)
	{
		return View::make('forms.deliveryreceipt')
			->withDelivery($delivery);
	}

}
