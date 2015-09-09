<?php

class AdminController extends \BaseController {


    public function SI_generate($id)
    {
        $reservation = Reservation::find($id);
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
        $fpdf->Cell(40,10,'REY AND CHRIS CATERING EQUIPMENT RENTALS',0,1);
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
        $fpdf->Cell(0,40,'                                       SALES INVOICE',0,1);
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
    public function information(){
        $informations = Information::all();
        return View::make('admin.information')->with(compact('informations'));
    }
    public function editInformation($id, $value){
        if($information = Information::find($id)){
            $information->value = $value;
            if($information->save())return Redirect::back()->with('flash_message','Information was successfully updated');
            else return Redirect::back()->withErrors('Error. Information not saved.');

        }
        return Redirect::back()->withErrors('Information not found!');
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

//-------------------------

    public function payAmount()
    {
        $reservation = Reservation::find(Input::get('id'));
        $id = $reservation->id;

        if($reservation->status != 'Event End'){
            App::abort(404);
        }

            $reservation->middle_name = $reservation->middle_name + Input::get('amount');
            $reservation->save();


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
        $fpdf->Cell(40,10,'REY AND CHRIS CATERING EQUIPMENT RENTALS',0,1);
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
        $fpdf->Cell(0,40,'                                       OFFICIAL RECEIPT',0,1);
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

    public function detachReturnItem()
    {

        $additional = Returns::find(Input::get('item_id'));
        #dd(Input::get('item_id'));
        $additional->delete();

        $reservation = Item::find(Input::get('reservation_id'));
        $reservation->total_quantity = $reservation->total_quantity - (Input::get('line_total'));
        $reservation->save();

        return Redirect::back();
    }

    public function detachBrokenItem()
    {
        $additional = Broken::find(Input::get('item_id'));
        $additional->delete();

        $reservation = Reservation::find(Input::get('reservation_id'));
        $reservation->net_total = $reservation->net_total -  (Input::get('average_price') * (Input::get('quantity')));
        $reservation->save();

        return Redirect::back();
    }

    public function returnAdditionalItem()
    {

        $additional = new Returns;
        $additional->menu_id = Input::get('item_id_get');
        $additional->reservation_id = Input::get('reservation_id');
        $additional->quantity = Input::get('quantity');
        $additional->save();

        $reservation = Item::find(Input::get('item_id_get'));
        $reservation->total_quantity = $reservation->total_quantity + (Input::get('quantity'));
        $reservation->save();
        return Redirect::back();
    }

    public function brokenAdditionalItem()
    {

        $additional = new Broken;
        $additional->menu_id = Input::get('item_id_get');
        $additional->reservation_id = Input::get('reservation_id');
        $additional->quantity = Input::get('quantity');
        $additional->save();

        $reservation = Reservation::find(Input::get('reservation_id'));
        $reservation->net_total = $reservation->net_total +  (Input::get('item_price') * (Input::get('quantity')));
        $reservation->save();
        return Redirect::back();
    }

    public function returnReservation($id)
    {
        $reservation = Reservation::find($id);
        $item = Item::get();
        return View::make('admin.return',compact('item','reservation'));
    }

    public function brokenReservation($id)
    {
        $reservation = Reservation::find($id);
        $item = Item::get();
        return View::make('admin.broken',compact('item','reservation'));

    }

    public function getPrice()
    {
        $menu = Menu::find(Input::get('option'));
        return Response::json($menu);
    }

    public function attachAdditionalItem()
    {
        $additional = new Additional;
        $additional->menu_id = Input::get('item_id_get');
        $additional->reservation_id = Input::get('reservation_id');
        $additional->package = Input::get('item_price');
        $additional->quantity = Input::get('quantity');
        $additional->category = 2;
        $additional->save();

        $reservation = Reservation::find(Input::get('reservation_id'));
        $reservation->net_total = $reservation->net_total + (Input::get('quantity') * Input::get('item_price') );
        $reservation->save();
        return Redirect::back();
    }

    public function ItemGetPrice()
    {
        $menu = Item::find(Input::get('option'));
        return Response::json($menu);
    }

    public function detachAdditionalMenu()
    {
        $additional = Additional::find(Input::get('item_id'));
        $additional->delete();

        $reservation = Reservation::find(Input::get('reservation_id'));
        $reservation->net_total = $reservation->net_total - (Input::get('line_total') );
        $reservation->save();
        return Redirect::back();
    }
    public function attachAdditionalMenu()
    {
        $additional = new Additional;
        $additional->menu_id = Input::get('item_id');
        $additional->reservation_id = Input::get('reservation_id');
        $additional->package = 0;
        $additional->quantity = Input::get('quantity');
        $additional->category = 1;
        $additional->save();

        $reservation = Reservation::find(Input::get('reservation_id'));
        $reservation->net_total = $reservation->net_total + (Input::get('quantity') * Input::get('price') );
        $reservation->save();
        return Redirect::back();
    }

    public function additionalReservation($id)
    {
        $reservation = Reservation::find($id);
        $menu = Menu::get();
        $item = Item::get();
        return View::make('admin.additional',compact('item','menu','reservation'));
    }


    public function salesReports()
    {
        return View::make('admin.reports');
    }

    public function inventoryReports()
    {
        return View::make('admin.inventoryReport');
    }

    public function generateInventoryReport()
    {
        $res = '';
        if(Input::get('status') == 'All')
        {
            $res = Item::get();
            $this->allInv($res);
        }elseif(Input::get('status') == 'Broken')
        {
            $res = Broken::get();
            $this->broken($res);
        }elseif(Input::get('status') == 'Returned')
        {
            $res = Returns::get();
            $this->returned($res);
        }/*elseif(Input::get('status') == 'Reserved')
        {
            $res = Broken::get();
        }*/



        return $res;
    }

    public function broken($res)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage('L');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Catering and Equipment Rentals Reservation',0,1,'C');
        $fpdf->Cell(130);
        $fpdf->SetFont('Arial','',14);
        $fpdf->Cell(20,10,'Business Adddress',0,1,'C');
        $header = array('ID','Model', 'Dimension', 'Price', 'Reservation','Quantity');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Broken Inventory Report as of: ' .date_format(Carbon::now(),"Y/m/d"),0,1,'C');

        // Colors, line width and bold font
        $fpdf->SetFillColor(255,0,0);
        $fpdf->SetTextColor(255);
        $fpdf->SetDrawColor(128,0,0);
        $fpdf->SetLineWidth(.3);
        $fpdf->SetFont('','');
        // Header
        $fpdf->Ln();
        $fpdf->Cell(44);
        $w = array(15, 45, 35, 35,35,35);
        for($i=0;$i<count($header);$i++)
            $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $fpdf->Ln();
        // Color and font restoration
        $fpdf->SetFillColor(224,235,255);
        $fpdf->SetTextColor(0);
        $fpdf->SetFont('Arial','',12);
        // Data
        $fill = false;
        $total = 0;
        foreach($res as $row)
        {  //$fpdf->MultiCell($w[0],6,$row,'LR',0,'L',$fill);
            //$item = Item::where('id','=',$row->menu_id)->get();
            $item = Item::find($row->menu_id);
            $fpdf->Cell(44);
            $fpdf->Cell($w[0],6,$item->id,'LR',0,'C',$fill);
            $fpdf->Cell($w[1],6,$item->model_number,'LR',0,'C',$fill);
            $fpdf->Cell($w[2],6,$item->dimensions,'LR',0,'C',$fill);
            $fpdf->Cell($w[3],6,$item->average_price,'LR',0,'R',$fill);
            $fpdf->Cell($w[4],6,$row->reservation_id,'LR',0,'C',$fill);
            $fpdf->Cell($w[5],6,$row->quantity,'LR',0,'R',$fill);

            $fpdf->Ln();
            $fill = !$fill;

        }
        // Closing line
        $fpdf->Cell(44);
        $fpdf->Cell(array_sum($w),0,'','T');
        $fpdf->Ln();




        $fpdf->Output();
        exit;
    }

    public function returned($res)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage('L');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Catering and Equipment Rentals Reservation',0,1,'C');
        $fpdf->Cell(130);
        $fpdf->SetFont('Arial','',14);
        $fpdf->Cell(20,10,'Business Adddress',0,1,'C');
        $header = array('ID','Model', 'Dimension', 'Price', 'Reservation','Quantity');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Returned Equipments Report as of: ' .date_format(Carbon::now(),"Y/m/d"),0,1,'C');

        // Colors, line width and bold font
        $fpdf->SetFillColor(255,0,0);
        $fpdf->SetTextColor(255);
        $fpdf->SetDrawColor(128,0,0);
        $fpdf->SetLineWidth(.3);
        $fpdf->SetFont('','');
        // Header
        $fpdf->Ln();
        $fpdf->Cell(44);
        $w = array(15, 45, 35, 35,35,35);
        for($i=0;$i<count($header);$i++)
            $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $fpdf->Ln();
        // Color and font restoration
        $fpdf->SetFillColor(224,235,255);
        $fpdf->SetTextColor(0);
        $fpdf->SetFont('Arial','',12);
        // Data
        $fill = false;
        $total = 0;
        foreach($res as $row)
        {  //$fpdf->MultiCell($w[0],6,$row,'LR',0,'L',$fill);
            //$item = Item::where('id','=',$row->menu_id)->get();
            $item = Item::find($row->menu_id);
            $fpdf->Cell(44);
            $fpdf->Cell($w[0],6,$item->id,'LR',0,'C',$fill);
            $fpdf->Cell($w[1],6,$item->model_number,'LR',0,'C',$fill);
            $fpdf->Cell($w[2],6,$item->dimensions,'LR',0,'C',$fill);
            $fpdf->Cell($w[3],6,$item->average_price,'LR',0,'R',$fill);
            $fpdf->Cell($w[4],6,$row->reservation_id,'LR',0,'C',$fill);
            $fpdf->Cell($w[5],6,$row->quantity,'LR',0,'R',$fill);

            $fpdf->Ln();
            $fill = !$fill;

        }
        // Closing line
        $fpdf->Cell(44);
        $fpdf->Cell(array_sum($w),0,'','T');
        $fpdf->Ln();




        $fpdf->Output();
        exit;
    }

    public function allInv($res)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage('L');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Catering and Equipment Rentals Reservation',0,1,'C');
        $fpdf->Cell(130);
        $fpdf->SetFont('Arial','',14);
        $fpdf->Cell(20,10,'Business Adddress',0,1,'C');
        $header = array('ID','Model', 'Dimension', 'Price', 'Quantity','Allocated');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Inventory Report as of: ' .date_format(Carbon::now(),"Y/m/d"),0,1,'C');

        // Colors, line width and bold font
        $fpdf->SetFillColor(255,0,0);
        $fpdf->SetTextColor(255);
        $fpdf->SetDrawColor(128,0,0);
        $fpdf->SetLineWidth(.3);
        $fpdf->SetFont('','');
        // Header
        $fpdf->Ln();
        $fpdf->Cell(44);
        $w = array(15, 45, 35, 35,35,35);
        for($i=0;$i<count($header);$i++)
            $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $fpdf->Ln();
        // Color and font restoration
        $fpdf->SetFillColor(224,235,255);
        $fpdf->SetTextColor(0);
        $fpdf->SetFont('Arial','',12);
        // Data
        $fill = false;
        $total = 0;
        foreach($res as $row)
        {  //$fpdf->MultiCell($w[0],6,$row,'LR',0,'L',$fill);

            $fpdf->Cell(44);
            $fpdf->Cell($w[0],6,$row->id,'LR',0,'C',$fill);
            $fpdf->Cell($w[1],6,$row->model_number,'LR',0,'C',$fill);
            $fpdf->Cell($w[2],6,$row->dimensions,'LR',0,'C',$fill);
            $fpdf->Cell($w[3],6,$row->average_price,'LR',0,'R',$fill);
            $fpdf->Cell($w[4],6,$row->total_quantity,'LR',0,'R',$fill);
            $fpdf->Cell($w[5],6,$row->allocated_quantity,'LR',0,'R',$fill);



            $fpdf->Ln();
            $fill = !$fill;

        }
        // Closing line
        $fpdf->Cell(44);
        $fpdf->Cell(array_sum($w),0,'','T');
        $fpdf->Ln();

        $fpdf->Output();
        exit;
    }

 //--------------------------------------------------------------------------------------------------
    public function generateReport()
    {
        $res = Reservation::get();
        if(Input::get('choice') == 'monthly')
        {
            $dt =  Input::get('month');
            if(Input::get('status') != 'All')
            {
                $res = Reservation::where('status', '=', Input::get('status'))->where('reservation_start','>=',date('Y').'-'.$dt.'-1')->where('reservation_end','<=',date('Y').'-'.$dt.'-'.cal_days_in_month(CAL_GREGORIAN,$dt,date('Y')))->get();
            }
            else
            {
                $res = Reservation::where('reservation_start','>=',date('Y').'-'.$dt.'-1')->where('reservation_end','<=',date('Y').'-'.$dt.'-'.cal_days_in_month(CAL_GREGORIAN,$dt,date('Y')))->get();
            }

            $this->monthly($res,Input::get('month'));

        }

        if(Input::get('choice')== 'yearly')
        {
            if(Input::get('status') != 'All')
            {
                $res = Reservation::where('status', '=', Input::get('status'))->get();
            }
            $this->yearly($res,Input::get('year'));
        }

        if(Input::get('choice')== 'weekly')
        {
            $res = Reservation::where('reservation_start', '>=', Input::get('start'))->where('reservation_end', '<=', Input::get('end'))->get();

            if(Input::get('status') != 'All')
            {
                $res = Reservation::where('status','=',Input::get('status'))->where('reservation_start', '>=', Input::get('start'))->where('reservation_end', '<=', Input::get('end'))->get();
            }

            $this->weekly($res,Input::get('start'),Input::get('end'));
        }
    }

    public function weekly($res, $id, $id2)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage('L');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Catering and Equipment Rentals Reservation',0,1,'C');
        $fpdf->Cell(130);
        $fpdf->SetFont('Arial','',14);
        $fpdf->Cell(20,10,'Business Adddress',0,1,'C');
        $header = array('ID', 'Date', 'Pax', 'Status','Amount', 'Payment Method', 'Duration');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Weekly Report for: ' . $id . ' to ' . $id2,0,1,'C');

        // Colors, line width and bold font
        $fpdf->SetFillColor(255,0,0);
        $fpdf->SetTextColor(255);
        $fpdf->SetDrawColor(128,0,0);
        $fpdf->SetLineWidth(.3);
        $fpdf->SetFont('','');
        // Header
        $fpdf->Ln();
        $fpdf->Cell(10);
        $w = array(35, 25, 25, 45,23,50,55);
        for($i=0;$i<count($header);$i++)
            $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $fpdf->Ln();
        // Color and font restoration
        $fpdf->SetFillColor(224,235,255);
        $fpdf->SetTextColor(0);
        $fpdf->SetFont('Arial','',12);
        // Data
        $fill = false;
        $total = 0;
        foreach($res as $row)
        {  //$fpdf->MultiCell($w[0],6,$row,'LR',0,'L',$fill);

                $fpdf->Cell(10);
                $fpdf->Cell($w[0],6,$row->id,'LR',0,'L',$fill);
                $fpdf->Cell($w[1],6,$row->date_request,'LR',0,'L',$fill);
                $fpdf->Cell($w[2],6,$row->pax,'LR',0,'R',$fill);
                $fpdf->Cell($w[3],6,$row->status,'LR',0,'R',$fill);
                $fpdf->Cell($w[4],6,$row->net_total,'LR',0,'R',$fill);

                if($row->payment_mode != '')
                    $fpdf->Cell($w[5],6,$row->payment_mode." (".$row->payment_method.")",'LR',0,'L',$fill);
                else
                    $fpdf->Cell($w[5],6,'Payment Method not set','LR',0,'L',$fill);

                $fpdf->Cell($w[6],6,$row->reservation_start . ' to ' . $row->reservation_end,'LR',0,'L',$fill);
                $fpdf->Ln();
                $fill = !$fill;
            $total =+ $row->net_total;
        }
        // Closing line
        $fpdf->Cell(10);
        $fpdf->Cell(array_sum($w),0,'','T');
        $fpdf->Ln();
        $fpdf->Cell(190);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Total:','',0,'R');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$total",0);


        $fpdf->Output();
        exit;
    }


    public function yearly($res,$id)
    {

        $fpdf = new Fpdf();
        $fpdf->AddPage('L');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Catering and Equipment Rentals Reservation',0,1,'C');
        $fpdf->Cell(130);
        $fpdf->SetFont('Arial','',14);
        $fpdf->Cell(20,10,'Business Adddress',0,1,'C');
        $header = array('ID', 'Date', 'Pax', 'Status','Amount', 'Payment Method', 'Duration');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Yearly Report for the Year of: ' . $id,0,1,'C');

        // Colors, line width and bold font
        $fpdf->SetFillColor(255,0,0);
        $fpdf->SetTextColor(255);
        $fpdf->SetDrawColor(128,0,0);
        $fpdf->SetLineWidth(.3);
        $fpdf->SetFont('','');
        // Header
        $fpdf->Ln();
        $fpdf->Cell(10);
        $w = array(35, 25, 25, 45,23,50,55);
        for($i=0;$i<count($header);$i++)
            $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $fpdf->Ln();
        // Color and font restoration
        $fpdf->SetFillColor(224,235,255);
        $fpdf->SetTextColor(0);
        $fpdf->SetFont('Arial','',12);
        // Data
        $fill = false;
        $total = 0;
        foreach($res as $row)
        {  //$fpdf->Cell($w[0],6,date ( 'Y', strtotime($row->date_request) ),'LR',0,'L',$fill);
            if($id == date ( 'Y', strtotime($row->date_request) ))
            {
                $fpdf->Cell(10);
                $fpdf->Cell($w[0],6,$row->id,'LR',0,'L',$fill);
                $fpdf->Cell($w[1],6,$row->date_request,'LR',0,'L',$fill);
                $fpdf->Cell($w[2],6,$row->pax,'LR',0,'R',$fill);
                $fpdf->Cell($w[3],6,$row->status,'LR',0,'R',$fill);
                $fpdf->Cell($w[4],6,$row->net_total,'LR',0,'R',$fill);

                if($row->payment_mode != '')
                    $fpdf->Cell($w[5],6,$row->payment_mode." (".$row->payment_method.")",'LR',0,'L',$fill);
                else
                    $fpdf->Cell($w[5],6,'Payment Method not set','LR',0,'L',$fill);
                $fpdf->Cell($w[6],6,$row->reservation_start . ' to ' . $row->reservation_end,'LR',0,'L',$fill);
                $fpdf->Ln();
                $fill = !$fill;
                $total =+ $row->net_total;
            }

        }
        // Closing line
        $fpdf->Cell(10);
        $fpdf->Cell(array_sum($w),0,'','T');
        $fpdf->Ln();
        $fpdf->Cell(190);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Total:','',0,'R');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$total",0);


        $fpdf->Output();
        exit;
    }


    public function monthly($res,$id)
    {
        $dt = DateTime::createFromFormat('!m', $id);

        $fpdf = new Fpdf();
        $fpdf->AddPage('L');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Catering and Equipment Rentals Reservation',0,1,'C');
        $fpdf->Cell(130);
        $fpdf->SetFont('Arial','',14);
        $fpdf->Cell(20,10,'Business Adddress',0,1,'C');
        $header = array('ID', 'Date', 'Pax', 'Status','Amount', 'Payment Method', 'Duration');
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(130);
        $fpdf->Cell(20,10,'Monthly Report for the Month of: ' . $dt->format('F'),0,1,'C');

        // Colors, line width and bold font
        $fpdf->SetFillColor(255,0,0);
        $fpdf->SetTextColor(255);
        $fpdf->SetDrawColor(128,0,0);
        $fpdf->SetLineWidth(.3);
        $fpdf->SetFont('','');
        // Header
        $fpdf->Ln();
        $fpdf->Cell(10);
        $w = array(35, 25, 25, 45,23,50,55);
        for($i=0;$i<count($header);$i++)
            $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $fpdf->Ln();
        // Color and font restoration
        $fpdf->SetFillColor(224,235,255);
        $fpdf->SetTextColor(0);
        $fpdf->SetFont('Arial','',12);
        // Data
        $fill = false;


$total = 0;
        foreach($res as $row)
        {

                $fpdf->Cell(10);
                $fpdf->Cell($w[0],6,$row->id,'LR',0,'L',$fill);
                $fpdf->Cell($w[1],6,$row->date_request,'LR',0,'L',$fill);
                $fpdf->Cell($w[2],6,$row->pax,'LR',0,'R',$fill);
                $fpdf->Cell($w[3],6,$row->status,'LR',0,'R',$fill);
                $fpdf->Cell($w[4],6,$row->net_total,'LR',0,'R',$fill);

                if($row->payment_mode != '')
                    $fpdf->Cell($w[5],6,$row->payment_mode." (".$row->payment_method.")",'LR',0,'L',$fill);
                else
                    $fpdf->Cell($w[5],6,'Payment Method not set','LR',0,'L',$fill);
                $fpdf->Cell($w[6],6,$row->reservation_start . ' to ' . $row->reservation_end,'LR',0,'L',$fill);
                $fpdf->Ln();
                $fill = !$fill;

            $total =+ $row->net_total;

        }
        // Closing line
        $fpdf->Cell(10);
        $fpdf->Cell(array_sum($w),0,'','T');
        $fpdf->Ln();
        $fpdf->Cell(190);
        $fpdf->SetFont('Arial','B',13);
        $fpdf->Cell(40,7,'Total:','',0,'R');
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,7,"$total",0);
        $fpdf->Output();
        exit;
    }


    public function deleteCarouselTotal($id)
    {
        $menu = Carousel::find($id);

        $menu->delete();

        return Redirect::back();
    }

    public function addCarousel()
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

        $menu = new Carousel();
        $menu->title = '';
        $menu->img = $name;
        $menu->save();

        if(file_exists(public_path('carousel/'.$name))){
            return Redirect::back();
        }
        Input::file('image')->move(public_path('carousel/'), $name);

        return Redirect::back();
    }

    public function updateCarousel($id)
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

        $menu = Carousel::find($id);
        $menu->img = $name;
        $menu->save();

        if(file_exists(public_path('carousel/'.$name))){
            return Redirect::back();
        }
        Input::file('image')->move(public_path('carousel/'), $name);

        return Redirect::back();
    }

    public function deleteCarousel($id)
    {
        $menu = Carousel::find($id);
        $menu->img = '';
        $menu->save();

        return Redirect::back();
    }

    public function carousel()
    {
        return View::make('admin.carousel')->withCarousel(Carousel::paginate(15));
    }

    public function contact()
    {
        return View::make('admin.contact')->withContact(Contact::paginate(15));
    }

    public function termsncon()
    {
        return View::make('admin.terms')->withTerm(Condition::orderBy('number')->paginate(10));
    }

    public function editTerm()
    {
        $con = Condition::where('number','=',Input::get('number'))->first();

            if($con->id != Input::get('id')){
                return View::make('admin.viewTerm')->withTerm(Condition::find(Input::get('id')))
                    ->withWarning('Number exist in Terms and Conditions, please update or delete the other to proceed');
            }

        $con = Condition::find(Input::get('id'));
        $con->number = Input::get('number');
        $con->title = Input::get('title');
        $con->description = Input::get('desc');
        $con->save();

        return Redirect::action('AdminController@termsncon');
    }

    public function addTerm()
    {

        return View::make('admin/addTerm');
    }

    public function addTerm2()
    {
        $con = Condition::where('number','=',Input::get('number'))->first();
        if($con){
        if($con->id != Input::get('id')){
            return Redirect::to('admin/addTerm')->withInput()
                ->withErrors( ['warning' => 'Number exist in Terms and Conditions, please update or delete the other to proceed.']);

        }}
        $con = new Condition;
        $con->number = Input::get('number');
        $con->title = Input::get('title');
        $con->description = Input::get('desc');
        $con->save();
        return Redirect::action('AdminController@termsncon');
    }

    public function storeRes()
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
        ]);

        if($validator->fails()){
            //return $validator->messages()->toJson();
            return Redirect::back()->withInput()->withErrors($validator->messages());

        }

        $reservation = new Reservation;
        $reservation->fill(Input::all());
        $reservation->status = 'Payment Pending';
        if($reservation->save())
        {
            $date1 = new DateTime(Input::get('reservation_start'));
            $date2 = new DateTime(Input::get('reservation_end'));

            $diff = $date2->diff($date1)->format("%a");
            $diff += 1;
            $id = Input::get('id');

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

            $packages = Packages::get();
            $item = Item::all();
            return View::make('admin.reservation_continuation',compact('item','packages','id','diff','chicken','pork','fish','beef','dessert','pasta','bread','drink','salad','soup','vegetable'));
        }

    }
    public function attachMenu()
    {

        $reservation = Reservation::find(Input::get('id'));
        $date1 = new DateTime($reservation->reservation_start);
        $date2 = new DateTime($reservation->reservation_end);
        $diff = $date2->diff($date1)->format("%a");
        $diff += 1;
        $date1 = date_format($date1, 'l, jS F Y');
        $date2 = date_format($date2, 'l, jS F Y');
        $id = Input::get('id');
        $total_price = 0;
        $package_price = 0;
        $pricezs = 0;
        $qty = Input::get('quantity');
        $model = Input::get('model');
        $invid = Input::get('invId');
        $pricey = Input::get('pricey');
        for($i=0; $i<count($qty); $i++)
        {
            if($qty[$i] > 0)
            {
                $reservation->items()->attach($invid[$i], ['qty' => $qty[$i]]);
                $pricezs = $pricezs + (int)$pricey[$i] *  $qty[$i];
            }
        }
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

            if(count(Input::get('package'.$index)) > 0)
            {
                foreach (Input::get('package' . $index) as $package)
                {
                    foreach (DB::table('menu_package')->where('package_id', '=', $package)->get() as $fuckage)
                    {
                        $reservation->menus()->attach($fuckage->menu_id, ['day' => $index,'package' => $package]);
                    }
                    $price = Packages::find($package);
                    $package_price += $price->price;
                }
            }
        }
        $reservation->net_total = ($total_price * $reservation->pax) + $package_price + $pricezs;

        $reservation->save();

        return View::make('admin.reservation_summary', compact('id','diff','reservation','date1','date2'));

    }

    public function attachPayment()
    {
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

        return View::make('admin.reservation_summary', compact('cancellation','id','diff','reservation','date1','date2'));

    }

    public function addReservation()
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
        $finalcode='ID-'.$pass;
        $cancellation = Maintenance::where([
            'name' => 'cancellation fee',
            'type' => 'fee'
         ])->first();
        return View::make('admin.reservation')->withTerms(Condition::orderBy('number')->get())->withCancellation($cancellation)->withFinalcode($finalcode);
    }


    public function deleteTerm($id)
    {
        $con = Condition::find($id);
        $con->delete();
        return Redirect::back();
    }

    public function updateTerm($id)
    {
        return View::make('admin.viewTerm')->withTerm(Condition::find($id));
    }

    public function deleteMessage($id)
    {
        $c = Contact::find($id);
        $c->delete();
        return Redirect::back();
    }

	public function index()
	{

        $reservation = Reservation::where([
                'reservation_start' => Carbon::now()->toDateString(),
                'status'            => 'Approved',
            ])->update(array('status' => 'Event Ongoing'));

        $reservation = Reservation::where([
            'reservation_start' => Carbon::now()->toDateString(),
            'status'            => 'Down Payment',
        ])->update(array('status' => 'Event Ongoing'));

        //return Carbon::now()->toDateString();

        $reservation = Reservation::where('reservation_end' ,'<', Carbon::now()->toDateString())
                                    ->where( 'status' ,'=', 'Event Ongoing')
                                    ->update(array('status' => 'Event End'));

      
        $reservation = Reservation::orderBy('date_request')->paginate(10);
		return View::make('admin.index', compact('reservation'));
	}

	public function create()
	{
		//
	}


	public function store()
	{
		//
	}


	public function show($id)
	{
		//
	}


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

    public function showReservation($id)
    {
        $reservation = Reservation::find($id);
        $date1 = new DateTime($reservation->reservation_start);
        $date2 = new DateTime($reservation->reservation_end);
        $date3 = new DateTime($reservation->date_request);
        $diff = $date2->diff($date1)->format("%a");
        $diff += 1;
        $date1 = date_format($date1, 'l, jS F Y');
        $date2 = date_format($date2, 'l, jS F Y');
        $date3 = date_format($date3, 'F j, Y');
        $categories = Category::all();
        $packages = Packages::all();

        $item = Item::get();
        return View::make('admin.showReservation', compact('item','packages','categories','id','diff','reservation','date1','date2','date3'));

    }

    public function updateStatus()
    {
        $input = Input::get('status');

        $id = Input::get('ids');

        $reservation = Reservation::find($id);
        $reservation->status = $input;
        $reservation->save();
        return Redirect::back();
    }

    public function deleteReservation($reservation)
    {
        $reservation = Reservation::find($reservation);
        $reservation->delete();

        $reservation = Reservation::paginate(5);
        return Redirect::to('admin/reservations');
    }

    public function menu()
    {
        $menu = Menu::paginate(10);
        $category = Category::all();
        return View::make('admin.menu',compact('menu','category'));
    }

    public function deletePicture($file)
    {
        $menu = Menu::find($file);
        $menu->image = '';
        $menu->save();

        return Redirect::back();
    }

    public function updatePicture($id)
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

        $menu = Menu::find($id);
        $menu->image = $name;
        $menu->save();

        if(file_exists(public_path('assets/menu/'.$name))){
            return Redirect::back();
        }
        Input::file('image')->move(public_path('assets/menu/'), $name);

        return Redirect::back();

    }

    public function deleteMenu($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        return Redirect::back();
    }

    public function getDetails($id)
    {

        $menu = Menu::find($id);
        return View::make('catering.getDetails', compact('menu'));
    }

    public function addMenu()
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

        $menu = new Menu;
        $menu->name = Input::get('name');
        $menu->mcat = Input::get('mcat');
        $menu->scat = Input::get('scat');
        $menu->description = Input::get('description');
        $menu->price = Input::get('price');
        $menu->image = $name;
        $menu->save();

        if(file_exists(public_path('assets/menu/'.$name))){
            return Redirect::back();
        }
        Input::file('image')->move(public_path('assets/menu/'), $name);

        return Redirect::back();
    }

    public function editMenu($id)
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

        $menu = Menu::find($id);
        $menu->name = Input::get('name');
        $menu->description = Input::get('description');
        $menu->price = Input::get('price');
        $menu->image = $name;
        $menu->save();

        if(file_exists(public_path('assets/menu/'.$name))){
            return Redirect::action('AdminController@menu');
        }
        Input::file('image')->move(public_path('assets/menu/'), $name);

        return Redirect::action('AdminController@menu');
    }

    public function menuCategory()
    {
        $category = Category::paginate(15);
        return View::make('admin.menu_category', compact('category'));
    }

    public function addCategory()
    {
        $category = new Category;
        $category->name = Input::get('name');
        $category->save();

        return Redirect::back();
    }

    public function deleteCategory($id)
    {

        $category = Category::find($id);
        $menu = Menu::where('scat' , '=', $category->name)->delete();
        $category->delete();

        return Redirect::back();
    }

    public function messages()
    {
        $reservation = Reservation::where('status','=','Payment Pending')->get();

        return View::make('admin.messages',compact('reservation'));
    }

    public function cancellations()
    {
        $reservation = Reservation::get();
        return View::make('admin.cancellations',compact('reservation'));
    }

    public function updateReservation($id)
    {

        $chars = "0234567899872034802934876923847023750293112310247102931239";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
        while ($i <= 7) {

            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;

        }
        $finalcode=$pass;

        $reservation = Reservation::find($id);
        if($reservation->payment_mode == 'Full Payment')
            $reservation->status = 'Approved';
        else
            $reservation->status = 'Down Payment';
        $reservation->save();

        $res = new SiTb;
        $res->si_number = $finalcode;
        $res->reservation_id = $reservation->id;
        $res->save();
        return Redirect::back();
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        /*$reservation->status = 'Cancelled';
        $reservation->save();
        */
        return Redirect::back();
    }

    public function packages()
    {

        return View::make('admin.packages')
                   ->withPackage(Packages::paginate(15))
                   ->withCategories(Category::all());
    }

    public function addPackage()
    {
        $package = new Packages;
        $package->name = Input::get('name');
        $package->description = Input::get('description');
        $package->price = Input::get('price');
        $package->save();

        foreach(Input::get('menu') as $menu)
        {
            DB::table('menu_package')->insert(
                array(
                    'package_id' => $package->id,
                    'menu_id' =>$menu * 1
                )
            );
        }
        return Redirect::back();
    }

    public function showPackage($id)
    {
         $package = Packages::find($id);

         return View::make('admin.showPackage', compact('package'));
    }

    public function maintenance()
    {
        return View::make('admin.maintenance')
            ->withMaintenance(Maintenance::paginate(15));
    }

    public function updateMaintenance($id)
    {
        return View::make('admin.update_maintenance')
            ->withMaintenance(Maintenance::find($id));
    }

    public function editMaintenance()
    {
        $maintenance = Maintenance::find(Input::get('id'));
        $maintenance->value = Input::get('value');
        $maintenance->save();

        return Redirect::action('AdminController@maintenance');
    }
    public function updateMenuReservation()
    {

        $reservation = Reservation::find(Input::get('id'));
        $reservation->menus()->detach();
        $reservation->items()->detach();
        $date1 = new DateTime($reservation->reservation_start);
        $date2 = new DateTime($reservation->reservation_end);
        $diff = $date2->diff($date1)->format("%a");
        $diff += 1;
        $date1 = date_format($date1, 'l, jS F Y');
        $date2 = date_format($date2, 'l, jS F Y');
        $id = Input::get('id');
        $total_price = 0;
        $package_price = 0;
        $pricezs = 0;
        $qty = Input::get('quantity');
        $model = Input::get('model');
        $invid = Input::get('invId');
        $pricey = Input::get('pricey');

        for($i=0; $i<count($qty); $i++)
        {
            if($qty[$i] > 0)
            {
                $reservation->items()->attach($invid[$i], ['qty' => $qty[$i]]);
                $pricezs = $pricezs + (int)$pricey[$i] *  $qty[$i];
            }
        }
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

            if(count(Input::get('package'.$index)) > 0)
            {
                foreach (Input::get('package' . $index) as $package)
                {
                    foreach (DB::table('menu_package')->where('package_id', '=', $package)->get() as $fuckage)
                    {
                        $reservation->menus()->attach($fuckage->menu_id, ['day' => $index,'package' => $package]);
                    }
                    $price = Packages::find($package);
                    $package_price += $price->price;
                }
            }
        }
        $reservation->net_total = ($total_price * $reservation->pax) + $package_price + $pricezs;
        $reservation->save();
        return Redirect::back();
    }
}
