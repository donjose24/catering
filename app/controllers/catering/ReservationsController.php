<?php namespace catering;

use Input;
use Reservation;
use DateTime;
use Menu;
use View;
use PDF;
use Redirect;
use DNS2D;
use DNS1D;
use Fpdf;
use Validator;
use Message;
use Condition;
use File;
use Maintenance;
use Packages;
use Carbon;
use DB;
use Contact;
use Category;
use Item;
use Term;
use Carousel;
use ItemType;
use SiTb;

use Information;
use Session;
use Content;

class ReservationsController extends \BaseController {

    public function equipments()
    {

        return View::make('catering.equip')->withCategory(ItemType::all());

    }

    public function home()
    {
        return View::make('catering.home')->withCarousel(Carousel::get())->withContent(Content::all());
    }

    public function homeMenu()
    {
        return View::make('catering.menu')
            ->withPackages(Packages::all())->withCategory(Category::all());
    }

    public function contact()
    {
        return View::make('catering.contact');
    }
    public function contactStore()
    {
        $contact = new Contact;
        $contact->name = Input::get('name');
        $contact->title = Input::get('subject');
        $contact->description = Input::get('details');
        $contact->save();
        return Redirect::action('catering\ReservationsController@thanks');
    }
    public function thanks()
    {
        return View::make('catering.thanks');
    }
	public function index()
	{
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        $terms = Condition::orderBy('number')->get();
        $pasta = Menu::where('scat','=','pasta')->get();
        $dessert = Menu::where('scat','=','dessert')->get();
        $bread = Menu::where('scat','=','bread')->get();
        $drink = Menu::where('scat','=','drinks')->get();
        $salad = Menu::where('scat','=','salad')->get();
        $soup = Menu::where('scat','=','soup')->get();
        $vegetable = Menu::where('scat','=','vegetable')->get();

    $cancellation = Maintenance::where([
            'name' => 'cancellation fee',
            'type' => 'fee'
        ])->first();


        $finalcode='ID-'.$pass;
        return View::make('catering.reservation',compact('cancellation','terms','finalcode','dessert','pasta','bread','drink','salad','soup','vegetable'));
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    //Step 1 make reservation : post request
    public function store()
    {
         $paxMin = Maintenance::where([
                'name' => 'pax',
                'type' => 'min'
            ])->first();
        $paxMax = Maintenance::where([
            'name' => 'pax',
            'type' => 'max'
        ])->first();
        $format = date_format(Carbon::now()->addDays(13),"Y/m/d");
        $dateFromForm = date('Y/m/d',strtotime(Input::get('reservation_start') . ' -1 days'));
        $validator = Validator::make(Input::all(),[ 
            'pax' => "max:{$paxMax->value}|min:{$paxMin->value}|integer",
            'reservation_start'    => 'after:' . $format,
            'reservation_end'    => 'after:' . $dateFromForm
           // 'id' => 'unique:reservations'
        ]);

        if($validator->fails()){
            
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }
        //DONT ALWAYS FVCKING CREATE NEW RESERVATION. fvcks up on refresh
        $reservation = Session::get('reservation') ? Session::get('reservation') : new Reservation;
        $reservation->fill(Input::all());
        $reservation->status = 'Payment Pending';
        //if($reservation->save()){scrap this shit. only save on checkout process  .what if we left the page suddenly, the reservation will be saved with no effing item or fuckages in it.
        $id = Input::get('id');
        Session::put('reservation' , $reservation); //Just store the reservation to session. we'll save it later
        return Redirect::to(route('home.reservation.selection'));
           // return View::make('catering.reservation_continuation',compact('item','packages','id','diff','chicken','pork','fish','beef','dessert','pasta','bread','drink','salad','soup','vegetable'));
        //}

        //return Input::all();
    }
    //step 2. The product selection process
    public function nocache(){
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
    }

    public function attachMenu()
    {
        $this->nocache();
       if(!Session::has('reservation'))return Redirect::to(url('/reservation'))->withErrors('You need to create a new reservation before you can add select products.');        
        //$reservation = Reservation::find(Input::get('id'));
        $reservation = Session::get('reservation'); //Use the reservation saved on the session
        $reservation->save(); //not sure if this good , but save the reservation on the session now
        $reservation = Reservation::find($reservation->id); //find the reservation , and use the reservation from the database so we can add relations
        $date1 = new DateTime($reservation->reservation_start);
        $date2 = new DateTime($reservation->reservation_end);
        $diff = $date2->diff($date1)->format("%a");
        $diff += 1;
        $date1 = date_format($date1, 'l, jS F Y');
        $date2 = date_format($date2, 'l, jS F Y');
        $id = $reservation->id;
        $total_price = 0;
        $package_price = 0;
        $pricezs = 0;
        $qty = Input::get('quantity');
        $model = Input::get('model');
        $invid = Input::get('invId');
        $pricey = Input::get('pricey');

            //add the items
            for($i=0; $i<count($qty); $i++)
            {
                if($qty[$i] > 0)
                {
                    $reservation->items()->attach($invid[$i], ['qty' => $qty[$i]]);
                    $pricezs = $pricezs + (int)$pricey[$i] *  $qty[$i];
                }
            }
            //add the menus?
            for($index = 1; $index <= $diff; $index++)
            {
                if(count(Input::get('menu'.$index)) > 0)
                {

                    foreach(Input::get('menu'.$index) as $menu)
                    {
                        $reservation->menus()->attach($menu,['day' => $index]);
                        $price = Menu::find($menu);
                        $total_price += $price->price;
                    }
                }
                //add the packages?
                if(count(Input::get('package'.$index)) > 0)
                {
                    foreach (Input::get('package' . $index) as $package)
                    {
                        foreach (DB::table('menu_package')->where('package_id', '=', $package)->get() as $fuckage)
                        $reservation->menus()->attach($fuckage->menu_id, ['day' => $index,'package' => $package]);
                        $price = Packages::find($package);
                        $package_price += $price->price;
                    }
                }
            }
            $reservation->net_total = ($total_price * $reservation->pax) + $package_price + $pricezs;
            if($reservation->save()){
                Session::forget('reservation');
            } //update the reservation and save it as checkout
            
         return Redirect::to(action('catering\ReservationsController@checkReservationGet' , $reservation->id));

    }
    public function showSelection(){
        $this->nocache();
        if(!Session::has('reservation'))
             return Redirect::back()
            ->withErrors('Cannot edit products selected after checkout');

        $id = Session::get('reservation')->id;
        $pasta = Menu::where('scat','=','pasta')->get();
        $dessert = Menu::where('scat','=','dessert')->get();
        $bread = Menu::where('scat','=','bread')->get();
        $drink = Menu::where('scat','=','drinks')->get();
        $salad = Menu::where('scat','=','salad')->get();
        $soup = Menu::where('scat','=','soup')->get();
        $vegetable = Menu::where('scat','=','vegetables')->get();
        $chicken = Menu::where('scat','=','chicken')->get();
        $beef = Menu::where('scat','=','beef')->get();
        $fish = Menu::where('scat','=','fish')->get();
        $pork = Menu::where('scat','=','pork')->get();
        $date1 = new DateTime(Input::get('reservation_start'));
        $date2 = new DateTime(Input::get('reservation_end'));
        $diff = $date2->diff($date1)->format("%a");
        $diff += 1;
        $packages = Packages::get();
        $item = Item::all();
        return View::make('catering.reservation_continuation',compact('item','packages','id','diff','chicken','pork','fish','beef','dessert','pasta','bread','drink','salad','soup','vegetable'));
    }
    public function attachPayment(){
            $reservation = Reservation::find(Input::get('id'));
            $reservation->fill(Input::all());
            $reservation->save();
            $date1 = new DateTime($reservation->reservation_start);
            $date2 = new DateTime($reservation->reservation_end);
            $diff = $date2->diff($date1)->format("%a");
            $diff += 1;
            $date1 = date_format($date1, 'l, jS F Y');
            $date2 = date_format($date2, 'l, jS F Y');
            $id = Input::get('id');
            $cancellation = Maintenance::where([
                'name' => 'cancellation fee',
                'type' => 'fee'
            ])->first();
            return View::make('catering.reservation_summary', compact('cancellation','id','diff','reservation','date1','date2'));
        }

    public function checkReservation()
    {
        $reservation = Reservation::find(Input::get('id'));
        if(!$reservation)return Redirect::back()->withErrors('Could not find reservation');
        $date1 = new DateTime($reservation->reservation_start);
        $date2 = new DateTime($reservation->reservation_end);
        $diff = $date2->diff($date1)->format("%a");
        $diff += 1;
        $date1 = date_format($date1, 'l, jS F Y');
        $date2 = date_format($date2, 'l, jS F Y');
        $id = Input::get('id');
        $cancellation = Maintenance::where([

            'name' => 'cancellation fee',
            'type' => 'fee'
        ])->first();

        return View::make('catering.reservation_summary', compact('cancellation','id','diff','reservation','date1','date2'));
    }

    public function checkReservationGet($id)
    {
        
        $reservation = Reservation::find($id);

        if(!$reservation)return Redirect::back()->withErrors('Could not find reservation');
        $date1 = new DateTime($reservation->reservation_start);
        $date2 = new DateTime($reservation->reservation_end);
        $diff = $date2->diff($date1)->format("%a");
        $diff += 1;
        $date1 = date_format($date1, 'l, jS F Y');
        $date2 = date_format($date2, 'l, jS F Y');
        $id = Input::get('id');
        $cancellation = Maintenance::where([
            'name' => 'cancellation fee',
            'type' => 'fee'
        ])->first();

        return View::make('catering.reservation_summary', compact('cancellation','id','diff','reservation','date1','date2'));

    }

    public function checkout()
    {
        return 'foo';
    }

    public function getMenu($menu)
    {
        $menu = Menu::find($menu);

        if(!$menu)return Redirect::back()->withErrors('Could not find menu');
        return View::make('catering.getOne',compact('menu'));
    }

    public function getPackage($package)
    {
        $package = Packages::find($package);
        if(!$package)return Redirect::back()->withErrors('Could not find package');
        return View::make('catering.getOnePackage',compact('package'));
    }

    public function getEquip($package)
    {
        $package = Item::find($package);
        return View::make('catering.getOneEquip',compact('package'));
    }

    public function attachMessage($id)
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

        $message = new Message;
        $message->reservation_id = $id;
        $message->image = $id.'.jpg';
        $message->save();

        Input::file('image')->move(public_path('bank/'), $id.'.jpg');

        return Redirect::action('catering\ReservationsController@index')->withErrors(['notice' => 'Your request has been updated, please search it again to view it.']);
    }

    public function attachMessageCancellation($id)
    {
		
        $validator = Validator::make(Input::all(),
            array(
                'image' => 'required|mimes:doc,docx',
            )
        );

        if($validator->fails()){
            return Redirect::to('reservation/message/' . $id )->withErrors($validator->messages());
        }
        $image = Input::file('image');
        $name = Input::file('image')->getClientOriginalName();

        /*added extension file in the name*/
        $ext = explode(".", $name);
        $ext = "." . end($ext);
        

        $message = new Message;
        $message->reservation_id = $id;
        $message->image = $id . $ext;
        $message->save();

        Input::file('image')->move(public_path('cancellation/'), $id.$ext);

        return Redirect::action('catering\ReservationsController@index')->withErrors(['notice'=> 'Your request has been updated, please search it again to view it.']);
    }

    public function deletePicture($id)
    {
        File::delete(public_path('bank/'.$id.'.jpg'));
        $message = Message::where('reservation_id','=',$id);
        $message->delete();
        return Redirect::action('catering\ReservationsController@index')->withErrors(['notice'=>'Your request has been updated, please search it again to view it.']);

    }

    public function changeStatus()
    {
        $reservation = Reservation::find(Input::get('id'));

        if(!$reservation)return Redirect::back()->withErrors('Could not find reservation');
        $reservation->fill(Input::all());
        $reservation->status = Input::get('status');
        if($reservation->save())
        {
            return Redirect::back();
        }
        return Redirect::back();
    }

    public function attachPdf($id)
    {
        $reservation = Reservation::find($id);
         if(!$reservation)return Redirect::back()->withErrors('Could not find reservation');
        $date1 = new DateTime($reservation->reservation_start);
        $date2 = new DateTime($reservation->reservation_end);
        $date3 = new DateTime($reservation->date_request);
        $diff = $date2->diff($date1)->format("%a");
        $diff += 1;
        $date1 = date_format($date1, 'jS F Y');
        $date2 = date_format($date2, 'jS F Y');
        $date3 = date_format($date3, 'F j, Y');
        $vat = $reservation->net_total * 0.12;
        $sub_total = $reservation->net_total - $vat;

        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial','B',16);
        $fpdf->AliasNbPages();
        $fpdf->Cell(40,10,'REY AND CHRIS cATERING EQUIPMENT RENTALS',0,1);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Address:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(30,7,'Antipolo and Baras Rizal Antipolo City',0,1);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Contact:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(30,7,'(632) 400-7629 / (0922) 841-4138',0,1);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Email:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(30,7,'chris_caina@yahoo.com / reyandchris@gmail.com',0,1);
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(0,40,'                                       RESERVATION SUMMARY',0,1);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Reservation ID:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$id",0);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'               Date:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$date3",0,1);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Full Name:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->first_name $reservation->last_name",0);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'               Contact:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->contact",0,1);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Your Address:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->client_address",0,1);
        $fpdf->Line(10, 105, 190, 105);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'',0,1);
        $fpdf->Cell(40,7,'Occasion:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->event",0);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'               Motif:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->motif",0,1);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Cater From:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$date1",0);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'               To:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$date2",0,1);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Event Address:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->venue_address",0,1);
        $header = array('Day#', 'Dish', 'Price x Number of Person', 'Total');
        $this->MenuTable($header,$reservation->menus,$reservation, $fpdf);
        $fpdf->Ln();
        $fpdf->Cell(40,7,'',0,1);

        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Sub Total:                                                      ');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,round($sub_total,2),0);
        $fpdf->Ln();
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Vat(12%):');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,round($vat,2),0);
        $fpdf->Ln();
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Grand Total:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,round($reservation->net_total,2),0);
        $fpdf->Ln();
        $fpdf->Ln();$fpdf->Ln();


        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Payment Mode:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->payment_mode",0);
        $fpdf->Ln();

        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Payment Method:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->payment_method",0,1);
        $fpdf->Line(10, 45, 192, 45);
/*        $fpdf->Line(100 , 182, 192, 182);
        $fpdf->Line(100 , 282, 192, 282);
        $fpdf->Line(100 , 182, 100, 282);
        $fpdf->Line(192 , 182, 192, 282);*/

        if($reservation->payment_mode == 'Down Payment')
        {
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Amount Paid:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,round(($reservation->net_total/2),2),0,1);

            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Balance:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,round(($reservation->net_total/2),2),0,1);
        }
        else{
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Amount Paid:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,round(($reservation->net_total),2),0,1);

        }

        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Reservation Status:');
        $fpdf->Ln();
        $fpdf->SetFont('Arial','',13);
        if($reservation->status == 'Approved')
            $fpdf->Cell(40,7,"Fully Paid",0,1);
        else
            $fpdf->Cell(40,7,"$reservation->status",0,1);

        $fpdf->AddPage();
        $this->terms($fpdf);

        $fpdf->Output();
        exit;

    }


    public function fullPdf($id)
    {

            $reservation = Reservation::find($id);
             if(!$reservation)return Redirect::back()->withErrors('Could not find reservation');
            if($reservation->status != 'Event End'){
                App::abort(404);
            }

            $si = SiTb::where('reservation_id','=',$reservation->id)->count();
            if($si == 0){
                $si = new SiTb;
                $si->si_number = 1;
                $si->reservation_id = $reservation->id;
                $si->save();
            }

            $date1 = new DateTime($reservation->reservation_start);
            $date2 = new DateTime($reservation->reservation_end);
            $date3 = new DateTime($reservation->date_request);
            $diff = $date2->diff($date1)->format("%a");
            $diff += 1;
            $date1 = date_format($date1, 'jS F Y');
            $date2 = date_format($date2, 'jS F Y');
            $date3 = date_format($date3, 'F j, Y');
            $vat = $reservation->net_total * 0.12;
            $sub_total = $reservation->net_total - $vat;

            $fpdf = new Fpdf();
            $fpdf->AddPage();
            $fpdf->SetFont('Arial','B',16);
            $fpdf->AliasNbPages();
            $fpdf->Cell(40,10,'REY AND CHRIS cATERING EQUIPMENT RENTALS',0,1);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Address:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(30,7,'Antipolo and Baras Rizal Antipolo City',0,1);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Contact:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(30,7,'(632) 400-7629 / (0922) 841-4138',0,1);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Email:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(30,7,'chris_caina@yahoo.com / reyandchris@gmail.com',0,1);
            $fpdf->SetFont('Arial','B',16);
            $fpdf->Cell(0,40,'                                       PAYMENT RECEIPT',0,1);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Reservation ID:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$id",0);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'               Date:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$date3",0,1);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Full Name:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$reservation->first_name $reservation->last_name",0);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'               Contact:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$reservation->contact",0,1);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Your Address:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$reservation->client_address",0,1);
            $fpdf->Line(10, 105, 190, 105);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'',0,1);
            $fpdf->Cell(40,7,'Occasion:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$reservation->event",0);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'               Motif:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$reservation->motif",0,1);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Cater From:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$date1",0);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'               To:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$date2",0,1);
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Event Address:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,"$reservation->venue_address",0,1);
            $header = array('Day#', 'Component', 'Price x Quantity', 'Total');
            $this->MenuTable($header,$reservation->menus,$reservation, $fpdf);
            $fpdf->Ln();

            $this->AdditionalTable($header,$reservation->menus,$reservation, $fpdf);
            $fpdf->Ln();

            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Reservation Status:');
            $fpdf->Ln();
            $fpdf->SetFont('Arial','',13);
            if($reservation->status == 'Approved')
                $fpdf->Cell(40,7,"Fully Paid",0,1);
            else
                $fpdf->Cell(40,7,"$reservation->status",0,1);

            $fpdf->Output();
            exit;
        }

        public function MenuTable($header, $data, $reservation, $fpdf)
    {
        // Colors, line width and bold font
        $fpdf->Ln();
        $fpdf->SetFillColor(79,74,72);
        $fpdf->SetTextColor(255);
        $fpdf->SetDrawColor(128,0,0);
        $fpdf->SetLineWidth(.3);
        $fpdf->SetFont('','B');
        // Header
        $w = array(18, 85, 60, 18);
        for($i=0;$i<count($header);$i++)
            $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $fpdf->Ln();
        // Color and font restoration
        $fpdf->SetFillColor(224,235,255);
        $fpdf->SetTextColor(0);
        $fpdf->SetFont('');
        // Data
        $fill = false;


        foreach($reservation->items as $items)
        {
            $fpdf->Cell($w[0],6,"Equip",'LR',0,'L',$fill);
            $fpdf->Cell($w[1],6,$items->model_number,'LR',0,'L',$fill);
            $fpdf->Cell($w[2],6,$items->average_price . " x " . $items->pivot->qty,'LR',0,'C',$fill);
            $fpdf->Cell($w[3],6,$items->average_price * $items->pivot->qty,'LR',0,'R',$fill);
            $fpdf->Ln();
            $fill = !$fill;
        }

        $i = 0;
        $day = 0;
        foreach($data as $row)
        {

            if($row->pivot->package)
            {
                if($day == 0){
                    $fpdf->Cell($w[0],6,"Day ".$row->pivot->day,'LR',0,'L',$fill);
                    $fpdf->Cell($w[1],6,Packages::where('id','=',$row->pivot->package)->pluck('name'),'LR',0,'L',$fill);
                    $fpdf->Cell($w[2],6,'','LR',0,'C',$fill);
                    $fpdf->Cell($w[3],6,Packages::where('id','=',$row->pivot->package)->pluck('price'),'LR',0,'R',$fill);
                    $fpdf->Ln();
                    $fpdf->Cell($w[0],6,"",'LR',0,'L',$fill);
                    $fpdf->Cell($w[1],6,'-  '.$row->name,'LR',0,'L',$fill);
                    $fpdf->Cell($w[2],6,'Included in Package','LR',0,'C',$fill);
                    $fpdf->Cell($w[3],6,'','LR',0,'R',$fill);
                }
                else{
                    $fpdf->Cell($w[0],6,"",'LR',0,'L',$fill);
                    $fpdf->Cell($w[1],6,'-  '.$row->name,'LR',0,'L',$fill);
                    $fpdf->Cell($w[2],6,'Included in Package','LR',0,'C',$fill);
                    $fpdf->Cell($w[3],6,'','LR',0,'R',$fill);
                }

                $day++;
            }
            else
            {
                $fpdf->Cell($w[0],6,"Day ".$row->pivot->day,'LR',0,'L',$fill);
                $fpdf->Cell($w[1],6,$row->name,'LR',0,'L',$fill);
                $fpdf->Cell($w[2],6,$row->price . " x " . $reservation->pax,'LR',0,'C',$fill);
                $fpdf->Cell($w[3],6,$row->price * $reservation->pax,'LR',0,'R',$fill);
            }
            $fpdf->Ln();
            $fill = !$fill;
        }
        // Closing line
        $fpdf->Cell(array_sum($w),0,'','T');



    }

        public function AdditionalTable($header, $data, $reservation, $fpdf)
    {
        // Colors, line width and bold font
        $fpdf->Ln();


        // Header
        $w = array(18, 85, 60, 18);

        // Color and font restoration
        $header = array('Day#', 'Additional', 'Price x Quantity', 'Total');
        // Data
        $fill = false;

        if($reservation->additionals->count() > 0){
            $fpdf->SetFillColor(79,74,72);
            $fpdf->SetTextColor(255);
            $fpdf->SetDrawColor(128,0,0);
            $fpdf->SetLineWidth(.3);
            $fpdf->SetFont('','B');
            for($i=0;$i<count($header);$i++)
                $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);

            $fpdf->SetFillColor(224,235,255);
            $fpdf->SetTextColor(0);
            $fpdf->SetFont('');
            $fpdf->Ln();
            $grand = 0;
            foreach ($reservation->additionals as $item)
            {
                if($item->category == 1)
                {
                    $menu = Menu::find($item->menu_id);
                    
                    $fpdf->Cell($w[0],6,"Day 1",'LR',0,'L',$fill);
                    $fpdf->Cell($w[1],6,$menu->name,'LR',0,'L',$fill);
                    $fpdf->Cell($w[2],6,$menu->price . " x " . $item->quantity,'LR',0,'C',$fill);
                    $fpdf->Cell($w[3],6,($item->quantity * 1) * ($menu->price * 1),'LR',0,'R',$fill);
                    $fpdf->Ln();
                    $fill = !$fill;
                    $grand += ($item->quantity * 1) * ($menu->price * 1);
                }

                elseif($item->category == 2)
                {
                    $menu = Item::find($item->menu_id);
                    $fpdf->Cell($w[0],6,"Equip",'LR',0,'L',$fill);
                    $fpdf->Cell($w[1],6,$menu->model_number,'LR',0,'L',$fill);
                    $fpdf->Cell($w[2],6,$menu->average_price . " x " . $item->quantity,'LR',0,'C',$fill);
                    $fpdf->Cell($w[3],6,($item->quantity * 1) * ($menu->average_price * 1),'LR',0,'R',$fill);
                    $fpdf->Ln();
                    $fill = !$fill;
                    $grand += ($item->quantity * 1) * ($menu->average_price * 1);
                }
            }
        }//if
        // Closing line
        $fpdf->Cell(array_sum($w),0,'','T');
        $fpdf->Ln();

        $fpdf->Ln();
        $fpdf->Cell(181,6,"Grand Total: ".($reservation->net_total ),'LR',0,'R',$fill);
        $fpdf->Ln();
        $fpdf->Cell(array_sum($w),0,'','T');
        $fpdf->Ln();
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Payment Mode:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->payment_mode",0);


        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Payment Method:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$reservation->payment_method",0,1);
        $fpdf->Line(10, 45, 192, 45);

        if($reservation->payment_mode == 'Down Payment')
        {
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Amount Paid:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,round((($reservation->net_total)/2 - $grand )+ $reservation->middle_name,2),0,1);

            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,' Balance:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,round((($reservation->net_total)/2 + $grand ) - $reservation->middle_name,2),0,1);
        }
        else{
            $fpdf->SetFont('Arial','B',13);
            $fpdf->Cell(40,7,'Amount Paid:');
            $fpdf->SetFont('Arial','',13);
            $fpdf->Cell(40,7,round(($reservation->net_total+ $reservation->middle_name),2),0,1);
            if(round(($reservation->middle_name),2) < ($reservation->net_total))
            {
                $fpdf->SetFont('Arial','B',13);
                $fpdf->Cell(40,7,'Balance:');
                $fpdf->SetFont('Arial','',13);
                $fpdf->Cell(40,7,($reservation->net_total) - round(( $reservation->middle_name),2),0,1);
            }else
            {
                $fpdf->SetFont('Arial','B',13);
                $fpdf->Cell(40,7,'Change:');
                $fpdf->SetFont('Arial','',13);
                $fpdf->Cell(40,7, round(($reservation->middle_name)-($reservation->net_total) ,2),0,1);
            }

        }
        $fpdf->Ln();
        $vat = ($reservation->net_total ) * 0.12;
        $sub_total = ($reservation->net_total ) - $vat;
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Sub Total:                                                      ');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,round(($sub_total),2),0);

        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Vat(12%):');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,round(($vat),2),0);
        $fpdf->Ln();

        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Grand Total:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,round(($reservation->net_total),2),0);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'SI Number:');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,SiTb::where('reservation_id','=',$reservation->id)->pluck('id'),0,1);

    }

    public function terms($fpdf)
    {
        $fpdf->Ln();
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Terms and Conditions',0,1);

        foreach(Condition::orderBy('number')->get() as $term):

        $fpdf->Ln();
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,$term->number . ". ". $term->title,0,1);
        $fpdf->SetFont('Arial','',12);
       $fpdf->MultiCell(180,7,$term->description,0,1);




        endforeach;
    }



}
