<?php namespace Settings;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use Agent;
use Response;

class AgentsController extends BaseController
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
        //$this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function index()
    {
        return View::make('settings.agents.index')
            ->withAgents(Agent::all());
    }

    public function create()
    {
        return View::make('settings.agents.create');
    }

    public function store()
    {
        $agent = new Agent;
        $agent->fill(Input::all());

        if ($agent->save()) {
            return Redirect::action('Settings\AgentsController@index');
        } else {
            return Redirect::action('Settings\AgentsController@create')
                ->withInput()
                ->withErrors($agent->errors());
        }
    }

    public function show(Agent $agent)
    {
        return View::make('settings.agents.show')
            ->withAgent($agent);
    }

    public function edit(Agent $agent)
    {
        return View::make('settings.agents.edit')
            ->withAgent($agent);
    }

    public function update(Agent $agent)
    {

        $agent->fill(Input::all());

        if ($agent->save()) {
            return Redirect::action('Settings\AgentsController@show', $agent->id);
        } else {
            return Redirect::action('Settings\AgentsController@edit', $agent->id)
                ->withInput()
                ->withErrors($agent->errors());
        }
    }

    public function destroy(Agent $agent)
    {
        if ($event->delete()) {
            return Redirect::action('Settings\AgentsController@index', $agent->id);
        } else {
            return Redirect::action('Settings\AgentsController@show', $agent->id);
        }
    }

    public function getOne()
    {
    $input = Input::get('option');
    $agent = Agent::find($input);
    return Response::json($agent);
    }
}
