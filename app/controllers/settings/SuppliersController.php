<?php namespace Settings;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use Supplier;
use Response;

class SuppliersController extends BaseController
{

    public function index()
    {
        return View::make('settings.suppliers.index')
                 ->withSuppliers(Supplier::all());
               // ->withSuppliers(Supplier::onlyTrashed()->get());
    }

    public function create()
    {
        return View::make('settings.suppliers.create');
    }

    public function store()
    {
        
        $supplier = new Supplier;
        $supplier->fill(Input::all());

        if ($supplier->save()) {
            return Redirect::action('Settings\SuppliersController@index')
                ->with('message', '<strong>Success!</strong> Supplier '.$supplier->supplier_name.' has been created.');
        } else {
            return Redirect::action('Settings\SuppliersController@create')
                ->withInput()
                ->withErrors($supplier->errors());
        }
    }

    public function show(Supplier $supplier){
        return View::make('settings.suppliers.show')
            ->withSuppliers($supplier);
    }

    public function destroy(Supplier $supplier)
    {

        if ($supplier->delete()) {
            return 'one day';
           // return Redirect::action('Settings\SuppliersController@index', $supplier->id);
        } else {
            return Redirect::action('Settings\SuppliersController@show', $supplier->id);
        }
    }

    public function edit(Supplier $supplier)
    {
        return View::make('settings.suppliers.edit')
            ->withSuppliers($supplier);
    }

    public function update(Supplier $supplier)
    {

        $supplier->fill(Input::all());

        if ($supplier->save()) {
            return Redirect::action('Settings\SuppliersController@show', $supplier->id);
        } else {
            return Redirect::action('Settings\SuppliersController@edit', $supplier->id)
                ->withInput()
                ->withErrors($supplier->errors());;
        }
    }

    public function getOne()
    {
        $input = Input::get('option');
        $client = Supplier::find($input);
        return Response::json($client);
    }

    public function storeModal()
    {
        $supplier = new Supplier;
        $supplier->fill(Input::all());
        $input = Input::all();

        if ($supplier->save()) {
            return Redirect::action('Sales\QuotationsController@create');
        } else {

            $input['autoOpenModal'] = true;
            return Redirect::action('Sales\QuotationsController@create')
                ->withInput($input)
                ->withErrors($supplier->errors());
        }
    }
}

