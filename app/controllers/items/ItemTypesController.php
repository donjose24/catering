<?php namespace Items;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use ItemType;
use Item;

class ItemTypesController extends BaseController
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
        //	$this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function index()
    {
        return View::make('items.itemtypes.index')
            ->withItemtypes(ItemType::all());
    }

    public function create()
    {
        return View::make('items.itemtypes.create');
    }

    public function store()
    {
        $itemtype = new ItemType;
        $itemtype->fill(Input::all());

        if ($itemtype->save()) {
            return Redirect::action('Items\ItemTypesController@index');
        } else {
            return Redirect::action('Items\ItemTypesController@create')
                ->withInput()
                ->withErrors($itemtype->errors());
        }
    }

    public function show(ItemType $itemtype)
    {
        return View::make('items.itemtypes.show')
            ->withItemtype($itemtype);
    }

    public function edit(ItemType $itemtype)
    {
        return View::make('items.itemtypes.edit')
            ->withItemtype($itemtype);
    }

    public function update(ItemType $itemtype)
    {
        $itemtype->fill(Input::all());

        if ($itemtype->save()) {
            return Redirect::action('Items\ItemTypesController@show', $itemtype->id);
        } else {
            return Redirect::action('Items\ItemTypesController@edit', $itemtype->id)
                ->withInput()
                ->withErrors($itemtype->errors());
        }
    }

    public function destroy(ItemType $itemtype)
    {
        if ($itemtype->delete()) {
            return Redirect::action('Items\ItemTypesController@index', $itemtype->id);
        } else {
            return Redirect::action('Items\ItemTypesController@show', $itemtype->id);
        }
    }
}
