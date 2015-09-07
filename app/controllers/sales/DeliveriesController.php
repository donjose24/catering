<?php namespace Sales;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use Quotation;
use Delivery;
use Client;
use Item;
use Validator;
use DB;

class DeliveriesController extends BaseController
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
        //$this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function index()
    {
        return View::make('sales.deliveries.index')
            ->withDeliveries(Delivery::all());
    }

    public function create(Quotation $quotation)
    {
        return View::make('sales.deliveries.create')
            ->withQuotation($quotation);
    }

    public function store()
    {
        $delivery = new Delivery;
        $quotation_id = Input::get('quotation_id');
        $quotation = Quotation::find($quotation_id);
        
        // Delivery Fields
        $delivery->quotation_id = $quotation_id;
        $delivery->reference_number = Input::get('reference_number');
        $delivery->delivery_date = Input::get('delivery_date');
        $delivery->delivered_by = Input::get('delivered_by');
        
        // Delivery Item Pivot Data
        $item_ids = Input::get('item_ids');
        $item_qtys = Input::get('item_qtys');

        // Validate Items
        // Check that item qty will not exceed total quantity
        for($i = 0; $i < count($item_ids); $i++)
        {
            if ($item_qtys[$i] > 0) {
                $item = $quotation->items->find($item_ids[$i]);
                $maxQuantity = $item->pivot->quantity - $item->pivot->delivered_quantity;
                $v = Validator::make (
                    array('item_qty' => $item_qtys[$i]),
                    array('item_qty' => 'required|numeric|min:0|max:'.$maxQuantity)
                );
 
                if ($v->fails())
                {
                    return Redirect::action('Sales\DeliveriesController@create', $quotation_id)
                        ->withErrors($v);
                }
            }
        }

        try {
           DB::beginTransaction(); 
            // After verifying items, Save Delivery Object
            // Attach Pivot Data
            if ($delivery->save()) {
                // Sync Items to be delivered on delivery
                for($i = 0; $i < count($item_ids); $i++)
                {
                    if ($item_qtys[$i] > 0)
                    {
                        $item = $quotation->items->find($item_ids[$i]);

                        // Increase amount of delivered quantity of items
                        $delivery->items()->attach($item_ids[$i], array('quantity' => $item_qtys[$i] ));
                        $item->pivot->delivered_quantity += $item_qtys[$i];
                        $item->pivot->save();
                        
                        // Reduce amount of quantity in item inventory
                        $item->allocated_quantity -= $item_qtys[$i];
                        $item->total_quantity -= $item_qtys[$i];
                        $item->save();

                    }
                }

                // Check if all items have been completely delivered to trigger status of quotation
                $quotation->delivery_status = 'CompletelyDelivered';
                foreach($quotation->items as $item)
                {
                    if ($item->pivot->delivered_quantity !== $item->pivot->quantity)
                    {
                        $quotation->delivery_status = 'PartiallyDelivered';
                        break;
                    }
                }
                $quotation->save();

                DB::commit();

                return Redirect::action('Sales\QuotationsController@salesordershow', $quotation_id);
            } 
            else {
                // dd(Input::all());
                // dd($delivery->errors());
                return Redirect::action('Sales\DeliveriesController@create', $quotation_id)
                    ->withInput(Input::except('item_ids', 'item_qtys'))
                    ->withErrors($delivery->getErrors());
            }
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::action('Sales\DeliveriesController@create', $quotation_id)
                ->withInput(Input::except('item_ids', 'item_qtys'))
                ->withErrors($delivery->getErrors())
                ->with('message', 'An internal error has occured! Please try the transaction again.');

        }
    }

    public function show(Delivery $delivery)
    {
        return View::make('sales.deliveries.show')
            ->withDelivery($delivery);
    }

    public function edit(Delivery $delivery)
    {
        return View::make('sales.deliveries.edit')
            ->withDeliveries($delivery)
            ->withQuotation($delivery->quotation);
    }

    public function update(Delivery $delivery)
    {
        $rules = Delivery::$rules;

        $delivery->fill(Input::all());
        if ($delivery->save($rules)) {
            $delivery->items()->sync(Input::get('item_ids', []));
            return Redirect::action('Sales/DeliveriesController@show', $delivery->id);
        } else {
            return Redirect::action('Sales/DeliveriesController@edit', $delivery->id)
                ->withInput()
                ->withErrors($delivery->getErrors());
        }
    }


    public function destroy(Delivery $delivery)
    {
        if ($delivery->delete()) {
            return Redirect::action('Sales/QuotationsController@salesordershow', $delivery->quotation->id);
        } else {
            return Redirect::action('Sales/QuotationsController@salesordershow', $delivery->quotation->id);
        }
    }

}
