<?php
namespace Purchases;

use View;
use Input;
use DB;
use Receiving;
use Purchase;
use Validator;
use Redirect;

class ReceivingsController extends \BaseController {

    public function index()
    {
        return View::make('purchases.receivings.index')
            ->withReceivings(Receiving::all());
    }

    public function create($purchase)
    {
        return View::make('purchases.receivings.create')
            ->withPurchase($purchase);
    }

    public function store()
    {
        $receiving = new Receiving;
        $purchase_id = Input::get('purchase_id');
        $purchase = Purchase::find($purchase_id);

        // Delivery Fields
        $receiving->purchase_id = $purchase_id;
        $receiving->reference_number = Input::get('reference_number');
        $receiving->date = Input::get('date');
        $receiving->received_by = Input::get('received_by');


        //------------------------------------------------------------
        // Delivery Item Pivot Data
        $item_ids = Input::get('item_ids');
        $item_qtys = Input::get('item_qtys');

        // Validate Items
        // Check that item qty will not exceed total quantity
        for($i = 0; $i < count($item_ids); $i++)
        {
            if ($item_qtys[$i] > 0) {
                $item = $purchase->items->find($item_ids[$i]);
                $maxQuantity = $item->pivot->quantity - $item->pivot->delivered_quantity;
                $v = Validator::make (
                    array('item_qty' => $item_qtys[$i]),
                    array('item_qty' => 'required|numeric|min:0|max:'.$maxQuantity)
                );

                if ($v->fails())
                {
                    return Redirect::action('Purchases\ReceivingsController@create', $purchase_id)
                        ->withErrors($v);
                }
            }
        }

        try {
            DB::beginTransaction();
            // After verifying items, Save Delivery Object
            // Attach Pivot Data
            if ($receiving->save()) {
                // Sync Items to be delivered on delivery
                for($i = 0; $i < count($item_ids); $i++)
                {
                    if ($item_qtys[$i] > 0)
                    {
                        $item = $purchase->items->find($item_ids[$i]);

                        // Increase amount of delivered quantity of items
                        $receiving->items()->attach($item_ids[$i], array('quantity' => $item_qtys[$i] ));
                        $item->pivot->delivered_quantity += $item_qtys[$i];
                        $item->pivot->save();

                        // Increment amount of quantity in item catering
                        $item->total_quantity += $item_qtys[$i];
                        $item->save();

                    }
                }

                // Check if all items have been completely delivered to trigger status of purchase
                $purchase->delivery_status = 'CompletelyDelivered';
                foreach($purchase->items as $item)
                {
                    if ($item->pivot->delivered_quantity !== $item->pivot->quantity)
                    {
                        $purchase->delivery_status = 'PartiallyDelivered';
                        break;
                    }
                }
                $purchase->save();

                DB::commit();

                return Redirect::action('Purchases\PurchasesController@purchaseOrderShow', $purchase_id);
            }
            else {

                 dd(Input::all());
                 dd($receiving->errors());
                return Redirect::action('Purchases\PurchasesController@purchaseOrderShow', $purchase_id)
                    ->withInput(Input::except('item_ids', 'item_qtys'))
                    ->withErrors($receiving->errors());
            }
        } catch (\Exception $e) {
            DB::rollback();
            //return $e;
            return Redirect::action('Purchases\ReceivingsController@create', $purchase_id)
                ->withInput(Input::except('item_ids', 'item_qtys'))
                ->withErrors($receiving->errors())
                ->with('message', 'An internal error has occured! Please try the transaction again.');

        }
    }

    public function show($receiving)
    {
        //return $receiving;
        return View::make('purchases.receivings.show')->withReceiving($receiving);
    }

    public function destroy($receiving)
    {
        if ($receiving->delete()) {
            return Redirect::action('Purchases\PurchasesController@purchaseOrderShow', $receiving->purchase->id);
        } else {
            return Redirect::action('Purchases\PurchasesController@purchaseOrderShow', $receiving->purchase->id);
        }
    }

} 