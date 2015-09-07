<?php namespace Settings;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use Client;
use Quotation;
use Response;

class ClientsController extends BaseController
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
        //$this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function index()
    {
        return View::make('settings.clients.index')
            ->withClients(Client::all());
    }

    public function create()
    {
        return View::make('settings.clients.create');
    }

    public function store()
    {
        $client = new Client;
        $client->fill(Input::all());

        if ($client->save()) {
            return Redirect::action('Settings\ClientsController@index')
                ->with('message', '<strong>Success!</strong> Client '.$client->customer_name.' has been created.');
        } else {
            return Redirect::action('Settings\ClientsController@create')
                ->withInput()
                ->withErrors($client->errors());
        }
    }

    public function show(Client $client)
    {
        return View::make('settings.clients.show')
            ->withClient($client);
    }

    public function edit(Client $client)
    {
        return View::make('settings.clients.edit')
            ->withClient($client);
    }

    public function update(Client $client)
    {

        $client->fill(Input::all());

        if ($client->save()) {
            return Redirect::action('Settings\ClientsController@show', $client->id);
        } else {
            return Redirect::action('Settings\ClientsController@edit', $client->id)
                ->withInput()
                ->withErrors($client->errors());;
        }
    }

    public function destroy(Client $client)
    {
        if ($client->delete()) {
            return Redirect::action('Settings\ClientsController@index', $client->id);
        } else {
            return Redirect::action('Settings\ClientsController@show', $client->id);
        }
    }

    public function getOne()
    {
        $input = Input::get('option');
        $client = Client::find($input);
        return Response::json($client);
    }

    public function storeModal()
    {
        $client = new Client;
        $client->fill(Input::all());
        $input = Input::all();

        if ($client->save()) {
            return Redirect::action('Purchases\PurchasesController@create');
        } else {

            $input['autoOpenModal'] = true;
            return Redirect::action('Purchases\PurchasesController@create')
                ->withInput($input)
                ->withErrors($client->errors());
        }
    }
}
