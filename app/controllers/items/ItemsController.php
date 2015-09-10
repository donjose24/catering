<?php namespace Items;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use ItemType;
use Response;
use Item;
use Validator;

class ItemsController extends BaseController
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
        //$this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function index()
    {
        return View::make('items.items.index')
            ->withItems(Item::all());
    }

    public function create()
    {
        return View::make('items.items.create')
            ->withItemtypes(ItemType::lists('name', 'id'));
    }

    public function store()
    {
        $validator = Validator::make(Input::all(),
            array(
                'image'     => 'required|image',
            )
        );

        if($validator->fails()){
            return Redirect::back()->withErrors($validator->messages());
        }

        $image = Input::file('image');
        $name = Input::file('image')->getClientOriginalName();

        $item = new Item;
        $item->fill(Input::all());
        $item->image = $name;

        if ($item->save()) {
            if(file_exists(public_path('equipments/'.$name))){

            }else{
                Input::file('image')->move(public_path('equipments/'), $name);
            }


            return Redirect::action('Items\ItemsController@index');
        } else {
            //dd($item);
            return Redirect::action('Items\ItemsController@create')
                ->withInput()
                ->withErrors($item->errors());
        }
    }

    public function show(Item $item)
    {
        return View::make('items.items.show')
            ->withItem($item);
    }

    public function edit(Item $item)
    {
        return View::make('items.items.edit')
            ->withItem($item)
            ->withItemtypes(ItemType::lists('name','id'));
    }

    public function update(Item $item)
    {
        $validator = Validator::make(Input::all(),
            array(
                'image'     => 'required|image',
            )
        );

        if($validator->fails()){
            return Redirect::back()->withErrors($validator->messages());
        }
        $image = Input::file('image');
        $name = Input::file('image')->getClientOriginalName();

        $item->fill(Input::all());
        $item->image = $name;

        if ($item->save()) {
            if(file_exists(public_path('equipments/'.$name))){

            }else{
                Input::file('image')->move(public_path('equipments/'), $name);
            }

            return Redirect::action('Items\ItemsController@show', $item->id);
        } else {
            return Redirect::action('Items\ItemsController@edit', $item->id)
                ->withInput()
                ->withErrors($item->errors());
        }
    }

    public function destroy(Item $item)
    {
        if ($item->delete()) {
            return Redirect::action('Items\ItemsController@index', $item->id);
        } else {
            return Redirect::action('Items\ItemsController@show', $item->id);
        }
    }

    public function getOne()
    {
        $input = Input::get('option');
        $item = Item::find($input);
        return Response::json($item);
    }
}
