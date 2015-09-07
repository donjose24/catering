<?php namespace Api;

use BaseController;
use Input;
use Redirect;
use User;
use View;
use Client;	
use Response;

class SearchController extends BaseController {

	public function index(){
		$query = e(Input::get('q', ''));

		// If empty
		//if (!$query && $query == '') 
		//	return Response::json(array(), 400);
		$clients = Client::where('customer_name', 'like', '%'.$query.'%')
			->orderBy('customer_name', 'asc')
			->take(5)
			->get(array('customer_name'))->toArray();

		
		$clients   = $this->appendValue($clients, 'client', 'class');
		$data = $clients;

		return Response::json(array('data'=>$data));

	}
	
	public function appendValue($data, $type, $element)
	{
	  // operate on the item passed by reference, adding the element and type
	  foreach ($data as $key => & $item) {
	    $item[$element] = $type;
	  }
	  return $data;   
	}
 
}
