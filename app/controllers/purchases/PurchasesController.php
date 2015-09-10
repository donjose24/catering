<?php namespace Purchases;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use Supplier;
use Item;
use Agent;
use Purchase;
use Validator;
use DB;

class PurchasesController extends \BaseController {


	public function index()
	{
        return View::make('purchases.index')
            ->withPurchases(Purchase::where('billing_status', 'Draft')->paginate(15));
	}

    public function pendingPurchases()
    {
        return View::make('purchases.index')
            ->withPurchases(Purchase::where('billing_status', 'PendingApproval')->paginate(15));
    }

    public function approvedPurchases()
    {
        return View::make('purchases.index')
            ->withPurchases(Purchase::where('billing_status', 'Approved')->paginate(15));
    }

    public function salesorders()
    {
        //FIELDS TO INCLUDE IN VIEW : SO Number || CLIENT || BILLING STATUS || DELIVERY STATUS || TOTAL AMOUNT || REMAINING BLANACE

        return View::make('sales.quotations.salesorders')
            ->withQuotations(
                Quotation::where('billing_status', 'SalesOrder')
                    ->orWhere('billing_status', 'Downpayment')
                    ->orWhere('billing_status', 'FullPayment')->paginate(15));
    }


    public function create()
	{
        return View::make('purchases.create')
            ->withItemselect(Item::lists('model_number', 'id'))
            ->withItems(Item::all())
            ->withSuppliers(Supplier::lists('supplier_name', 'id'))
            ->withAgents(Agent::select('id', DB::raw('CONCAT(first_name, " ", Last_name) AS full_name'))
                ->lists('full_name', 'id'));
	}


	public function store()
	{
        $purchase = new Purchase;
        $purchase->fill(Input::all());
        $purchase->po_number = time();
        $purchase->date;
        if ($purchase->id == null)
        {
            // TODO : CHANGE
            $purchase->prepared_by = 'test';
        }

        if ($purchase->save()) {

            $i = Purchase::find($purchase->id);
            $i->po_number = $purchase->id;
            $i->save();

            return Redirect::action('Purchases\PurchasesController@show', $purchase->id)
                ->with('message', 'Purchase Order '.$purchase->id.' Created!');
        } else {
            return Redirect::action('Purchases\PurchasesController@create')
                ->withInput()
                ->withErrors($purchase->errors());
        }
	}


	public function show($purchase)
	{
        //return $purchase;
        return View::make('purchases.show')
            ->withPurchase($purchase)
            ->withItems(Item::lists('model_number', 'id'));
	}


    public function edit($purchase)
    {
        return View::make('purchases.edit')
            ->withPurchase($purchase)
            ->withSuppliers(Supplier::lists('supplier_name', 'id'));
    }

	public function update($purchase)
	{
        $purchase->fill(Input::all());

        if ($purchase->billing_status == 'Draft')
        {
            if ($purchase->save()) {
                return Redirect::action('Purchases\PurchasesController@show', $purchase->id)
                    ->with('message', 'Quotation '.$purchase->id.' Updated!');
            }
            else {
                return Redirect::action('Purchases\PurchasesController@edit', $purchase->id)
                    ->withErrors($purchase->errors());
            }
        }
        else
        {
            if ($purchase->save()) {
                if ($purchase->billing_status == 'PendingApproval') {
                    return Redirect::action('Purchases\PurchasesController@index')
                        ->with('message', 'Quotation '.$purchase->id.' Sent for Approval!');
                }
                else if ($purchase->billing_status == 'Approved') {
                    return Redirect::action('Purchases\PurchasesController@pendingPurchases')
                        ->with('message', 'Quotation '.$purchase->id.' Updated!');
                }
                else  {
                    return Redirect::action('Purchases\PurchasesController@salesorders')
                        ->with('message', 'Quotation '.$purchase->id.' Updated!');
                }
            }
            else
            {
                return Redirect::action('Sales\QuotationsController@show', $purchase->id)
                    ->withErrors($purchase->errors());
            }
        }
	}

    public function attachItem()
    {
        $item = Input::all();
        $purchase = Purchase::find($item['purchase_id']);
        $sub_total = $item['item_qty'] * $item['item_price'];

        $v = Validator::make (
            array(
                'item_qty'      => $item['item_qty'],
                'item_price'    => $item['item_price'],
                'item_id'       => $item['item_id']
            ),
            array(
                'item_qty'      => 'required|numeric|min:0',
                'item_price'    => 'required|numeric|min:0',
                'item_id'       => 'required'
            )
        );
        if ($v->fails())
        {
            return Redirect::action('Purchases\PurchasesController@create', $purchase->id)
                ->withErrors($v);
        }


        $line_price = $sub_total; /*- ($line_discount*$item['item_qty'])*/

        $purchase->items()->attach($item['item_id'], ['quantity' => $item['item_qty'], 'price' => $item['item_price'], 'line_total' => $line_price]);

        $purchase->grand_total += $line_price;
        $purchase->net_total = $purchase->grand_total * (100-$purchase->discount)/100;
        if ($purchase->save())
        {
            return Redirect::action('Purchases\PurchasesController@show', $purchase->id);
        }
        else
        {
            dd($purchase->errors());
        }
    }

    public function detachItem()
    {
        $purchase = Purchase::findOrFail(Input::get('quotation_id'));
        $purchase->items()->detach(Input::get('item_id'));
        $purchase->grand_total -= Input::get('line_total');
        $purchase->net_total = $purchase->grand_total * (100-$purchase->discount)/100;
        $purchase->save();

        return Redirect::action('Purchases\PurchasesController@show', $purchase->id);
    }

    public function destroy($purchase)
    {
        if ($purchase->delete()) {
            return Redirect::action('Purchases\PurchasesController@index', $purchase->id);
        } else {
            return Redirect::action('Purchases\PurchasesController@show', $purchase->id);
        }
    }

    public function createSI($purchases)
    {
        $purchases->fill(Input::all());

/*        foreach ($purchases->items as $item)
        {
            $item->total_quantity += $item->pivot->quantity;
            $item->save();
        }*/

        if ($purchases->save())
        {
            return Redirect::action('Purchases\PurchasesController@purchaseOrderShow', $purchases->id);
        }
        else
        {
            return Redirect::action('Purchases\PurchasesController@show', $purchases->id);
        }
    }

    public function purchaseOrders()
    {
        return View::make('purchases.purchaseorders')
            ->withPurchases(
                Purchase::where('billing_status', 'SalesOrder')
                    ->orWhere('billing_status', 'Downpayment')
                    ->orWhere('billing_status', 'FullPayment')->paginate(15));
        //return 'foo';
    }

    public function purchaseOrderShow(Purchase $purchase)
    {
        return View::make('purchases.purchaseOrderShow')
            ->withPurchase($purchase);
    }

}
