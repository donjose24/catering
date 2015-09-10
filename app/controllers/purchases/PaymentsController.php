<?php
namespace Purchases;

use View;
use Input;
use DB;
use Receiving;
use Purchase;
use Validator;
use Redirect;
use Payment;

class PaymentsController extends \BaseController{

    public function index()
    {
        return View::make('purchases.payments.index')
            ->withPayments(Payment::all());

    }

    public function create($purchase)
    {
        //return $purchase;
        return View::make('purchases.payments.create')
            ->withPurchase($purchase);
    }

    public function store()
    {
        $purchase_id = Input::get('purchase_id');

        $payment = new Payment;
        $payment->fill(Input::all());
        $payment->purchase_id = $purchase_id;
        $purchase = Purchase::find($purchase_id);

        // Validate that Collection amount
        $v = Validator::make (
            array('amount' => $payment->amount),
            array('amount' => 'required|numeric|min:0')
        );
        if ($v->fails())
        {
            return Redirect::action('Purchases\PurchasesController@create', $purchase_id)
                ->withErrors($v);
        }

        // Check if quotation billing status should be updated
        if ($purchase->payments->sum('amount') + $payment->amount >= $purchase->net_total) // sum of all collections is greater than net  amount
        {
            $purchase->billing_status = 'FullPayment';
        }
        else
        {
            $purchase->billing_status = 'Downpayment';
        }

        //$collection->fill(Input::all());
        try {
            DB::beginTransaction();
            $purchase->save();
            if ($payment->save()) {
                DB::commit();
                return Redirect::action('Purchases\PurchasesController@purchaseOrderShow', $purchase_id);
            } else {
                return Redirect::action('Purchases\PaymentsController@create', $purchase_id)
                    ->withInput()
                    ->withErrors($payment->errors());
            }

        } catch (\Exception $e) {

            DB::rollback();
            return $e;
            return Redirect::action('Purchases\PurchasesController@create', $purchase_id)
                ->withInput()
                ->withErrors($payment->errors())
                ->with('message', 'An internal error has occured! Please try the transaction again.');
        }
    }

} 