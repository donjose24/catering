<?php namespace Sales;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use Quotation;
use Client;
use Item;
use Collection;
use Agent;
use Validator;
use DB;

class QuotationsController extends BaseController
{
    public function __construct ()
    {
        //$this->beforeFilter('auth');
        //$this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function index()
    {
        return View::make('sales.quotations.index')
            ->withQuotations(Quotation::where('billing_status', 'Draft')->paginate(15));
    }

    public function pendingQuotations()
    {
        return View::make('sales.quotations.index')
            ->withQuotations(Quotation::where('billing_status', 'PendingApproval')->paginate(15));
    }    

    public function approvedQuotations()
    {
        return View::make('sales.quotations.index')
            ->withQuotations(Quotation::where('billing_status', 'Approved')->paginate(15));
    }

    public function create()
    {
        return View::make('sales.quotations.create')
            ->withItemselect(Item::lists('model_number', 'id'))
            ->withItems(Item::all())
            ->withClients(Client::lists('customer_name', 'id'))
            ->withAgents(Agent::select('id', DB::raw('CONCAT(first_name, " ", Last_name) AS full_name'))
                ->lists('full_name', 'id'));
    }

    public function store()
    {
        $quotation = new Quotation;
        $quotation->fill(Input::all());

        $quotation->date;
        if ($quotation->id == null) 
        {
            // TODO : CHANGE
            $quotation->prepared_by = 'test';
        }

        if ($quotation->save()) {

            return Redirect::action('Sales\QuotationsController@show', $quotation->id)
                ->with('message', 'Quotation '.$quotation->id.' Created!');
        } else {
            return Redirect::action('Sales\QuotationsController@create')
                ->withInput()
                ->withErrors($quotation->getErrors());
        }
    }

    public function show(Quotation $quotation)
    {
        return View::make('sales.quotations.show')
            ->withQuotation($quotation)
            ->withItems(Item::lists('model_number', 'id'));
    }

    public function edit(Quotation $quotation)
    {
        return View::make('sales.quotations.edit')
            ->withQuotation($quotation)
            ->withClients(Client::lists('customer_name', 'id'))
            ->withAgents(Agent::select('id', DB::raw('CONCAT(first_name, " ", Last_name) AS full_name'))
                ->lists('full_name', 'id'));
    }

    public function update(Quotation $quotation)
    {
        $quotation->fill(Input::all());
            if ($quotation->billing_status == 'Draft')
            {
                if ($quotation->save()) {
                    return Redirect::action('Sales\QuotationsController@show', $quotation->id)
                        ->with('message', 'Quotation '.$quotation->id.' Updated!');
                }
                else {
                    return Redirect::action('Sales\QuotationsController@edit', $quotation->id)
                        ->withErrors($quotation->getErrors());
                }
            }
            else
            {
                if ($quotation->save()) {
                    if ($quotation->billing_status == 'PendingApproval') {
                        return Redirect::action('Sales\QuotationsController@index')
                            ->with('message', 'Quotation '.$quotation->id.' Updated!');
                    }
                    else if ($quotation->billing_status == 'Approved') {
                        return Redirect::action('Sales\QuotationsController@pendingQuotations')
                            ->with('message', 'Quotation '.$quotation->id.' Updated!');
                    }
                    else  {
                        return Redirect::action('Sales\QuotationsController@salesorders')
                            ->with('message', 'Quotation '.$quotation->id.' Updated!');
                    }
                }
                else
                {
                    return Redirect::action('Sales\QuotationsController@show', $quotation->id)
                        ->withErrors($quotation->getErrors());
                }
            }
    }


    public function destroy(Quotation $quotation)
    {
        if ($quotation->delete()) {
            return Redirect::action('Sales\QuotationsController@index', $quotation->id);
        } else {
            return Redirect::action('Sales\QuotationsController@show', $quotation->id);
        }
    }

    public function attachItem() 
    {
        $item = Input::all();
        $quotation = Quotation::find($item['quotation_id']);
        $sub_total = $item['item_qty'] * $item['item_price'];
        $line_discount = $item['line_discount'];

        $v = Validator::make (
            array(
                'item_qty'      => $item['item_qty'],
                'item_price'    => $item['item_price'],
                'line_discount' => $item['line_discount'],
                'item_id'       => $item['item_id']
            ),
            array(
                'item_qty'      => 'required|numeric|min:0',
                'item_price'    => 'required|numeric|min:0',
                'line_discount' => 'required|numeric|min:0',
                'item_id'       => 'required'
            )
        );
        if ($v->fails())
        {
            return Redirect::action('Sales\QuotationsController@create', $quotation->id)
                ->withErrors($v);
        }


        $line_price = $sub_total - ($line_discount*$item['item_qty']);
        
        $quotation->items()->attach($item['item_id'], ['quantity' => $item['item_qty'], 'price' => $item['item_price'], 'line_total' => $line_price, 'sub_total' => $sub_total, 'line_discount' => $line_discount]);
        $quotation->grand_total += $line_price;
        $quotation->net_total = $quotation->grand_total * (100-$quotation->discount)/100;
        if ($quotation->save())
        {
            return Redirect::action('Sales\QuotationsController@show', $quotation->id);
        }
        else
        {
            dd($quotation->getErrors());
        }
    }

    public function detachItem()
    {
        $quotation = Quotation::findOrFail(Input::get('quotation_id'));

        $quotation->items()->detach(Input::get('item_id'));

        $quotation->grand_total -= Input::get('line_total');
        $quotation->net_total = $quotation->grand_total * (100-$quotation->discount)/100;
        $quotation->save();
        return Redirect::action('Sales\QuotationsController@show', $quotation->id);
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

    public function salesordershow(Quotation $quotation)
    {
        //FIELDS TO INCLUDE IN VIEW : SO Number || CLIENT || BILLING STATUS || DELIVERY STATUS || TOTAL AMOUNT || REMAINING BLANACE

        return View::make('sales.quotations.salesordershow')
            ->withQuotation($quotation);
    }

    public function receivables()
    {
        return View::make('sales.quotations.receivables')
            ->withQuotations(
                Quotation::where('billing_status', '<>', 'FullPayment')
                    ->where('delivery_status', '=', 'CompletelyDelivered')
            );
    }


    public function fulfilled()
    {
        return View::make('sales.quotations.fulfilled')
            ->withQuotations(
                Quotation::where('billing_status', '=', 'FullPayment')
                    ->where('delivery_status', '=', 'CompletelyDelivered')
            );
    }

     public function createSO(Quotation $quotation)
    {
        $quotation->fill(Input::all());
        foreach ($quotation->items as $item)
        {
            $item->allocated_quantity += $item->pivot->quantity;

            $item->save();
        }

        if ($quotation->save()) {
            return Redirect::action('Sales\QuotationsController@salesordershow', $quotation->id);
        }
        else
        {
            return Redirect::action('Sales\QuotationsController@show', $quotation->id);
        }

    }
}
