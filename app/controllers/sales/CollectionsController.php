<?php namespace Sales;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use Quotation;
use Collection;
use Validator;
use DB;
class CollectionsController extends BaseController
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
        //$this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function index()
    {
        return View::make('sales.collections.index')
            ->withCollections(Collection::all());
    }

    public function create(Quotation $quotation)
    {
        return View::make('sales.collections.create')
            ->withQuotation($quotation);
    }

    public function store()
    {
        $collection = new Collection;
        $collection->fill(Input::all());
        $quotation_id = Input::get('quotation_id');
        $collection->quotation_id = $quotation_id;
        $quotation = Quotation::find($quotation_id);

        // Validate that Collection amount 
        $v = Validator::make (
            array('amount' => $collection->amount),
            array('amount' => 'required|numeric|min:0')
        );
        if ($v->fails())
        {
            return Redirect::action('Sales\CollectionsController@create', $quotation_id)
                ->withErrors($v);
        }

        // Check if quotation billing status should be updated
        if ($quotation->collections->sum('amount') + $collection->amount >= $quotation->net_total) // sum of all collections is greater than net  amount
        {
            $quotation->billing_status = 'FullPayment';
        }
        else
        {
            $quotation->billing_status = 'Downpayment';
        }

        //$collection->fill(Input::all());
        try {
            DB::beginTransaction();
            $quotation->save();
            if ($collection->save()) {
                DB::commit();
                return Redirect::action('Sales\QuotationsController@salesordershow', $quotation_id);
            } else {
                return Redirect::action('Sales\CollectionsController@create', $quotation_id)
                    ->withInput()
                    ->withErrors($collection->getErrors());
            }
            
        } catch (\Exception $e) {

            DB::rollback();
            return Redirect::action('Sales\CollectionsController@create', $quotation_id)
                    ->withInput()
                    ->withErrors($collection->getErrors())
                    ->with('message', 'An internal error has occured! Please try the transaction again.');
        }
    }

    public function show(Collection $collection)
    {
        return View::make('sales.collections.show')
            ->withCollection($collection);
    }

    public function edit(Collection $collection)
    {
        return View::make('events.edit')
            ->withCollection($collection);
    }

    public function update(Collection $collection)
    {
        $rules = Collection::$rules;

        $collection->fill(Input::all());

        if ($collection->save($rules)) {
            $collection->items()->sync(Input::get('item_ids', []));
            return Redirect::action('Sales/CollectionsController@show', $collection->id);
        } else {
            return Redirect::action('Sales/CollectionsController@edit', $collection->id)
                ->withInput()
                ->withErrors($collection->getErrors());
        }
    }


    public function destroy(Collection $collection)
    {
        $quotation_id = $collection->quotation_id;
        $quotation = Quotation::find($quotation_id);

        if ($collection->delete()) {
            if ($quotation->collections->sum('amount') >= $quotation->net_total) // sum of all collections is greater than net  amount
            {
                $quotation->billing_status = 'FullPayment';
            }
            else if($quotation->collections->sum('amount') == 0)
            {
                $quotation->billing_status = 'SalesOrder';
            }
            else
            {
                $quotation->billing_status = 'Downpayment';
            }

            if($quotation->save()) {
                return Redirect::back();
            }
        } else {
            return Redirect::action('Sales/CollectionsController@show', $collection->id);
        }
    }
}
