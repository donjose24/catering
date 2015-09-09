<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Catering Business</title>
        <link href="{{ asset('bower_components/datepicker/css/datepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('bower_components/bootswatch/cerulean/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">

        <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script>window.html5 || document.write('<script src="{{ asset('js/vendor/html5shiv-3.7.0.min.js') }}"><\/script>')</script>
        <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <script>window.respond || document.write('<script src="{{ asset('js/vendor/respond-1.4.2.min.js') }}"><\/script>')</script>
        {{HTML::style('homepage/css/bootstrap.min.css')}}
        {{HTML::style('assets/css/font-awesome.css')}}
        {{HTML::style('assets/js/morris/morris-0.4.3.min.css')}}
        {{HTML::style('assets/css/custom.css')}}
        {{HTML::style('http://fonts.googleapis.com/css?family=Open+Sans')}}
        {{HTML::style('addasset/css/sweetalert.css')}}

</head>
<body>
@yield('modal')
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title" style = "text-align: center"><b>Add Menu</b></h4>
                    </div>
                <div class="modal-body"><div class="te">

                <h4><b>Description:</b> </h4>
                 <h4><b>Price:</b></h4>

                </div></div>
        </div>
    </div>
</div>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Binary admin</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">  <a href="/" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="{{asset('assets/img/find_user.png')}}" class="user-image img-responsive"/>
                    </li>
                
                    
                    <li>
                        <a class="active-menu"  href="{{action('AdminController@index')}}"><i class="fa fa-dashboard fa-3x"></i> Reservation</a>
                    </li>
                    <li>
                            <a class="menu"  href="{{action('AdminController@contact')}}"><i class="fa fa-mail-reply-all fa-3x"></i> Messages</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Catering<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{action('AdminController@menu')}}">Menu</a>
                            </li>
                            <li>
                                <a href="{{action('AdminController@menuCategory')}}">Menu Category</a>
                            </li>
                             <li>
                                 <a href="{{action('AdminController@packages')}}">Packages</a>
                             </li>
                             <li>
                                 <a href="{{action('AdminController@messages')}}">Deposit Slips</a>
                             </li>
                             <li>
                                 <a href="{{action('AdminController@cancellations')}}">Cancellations</a>
                             </li>
                             <li>
                                 <a href="{{action('AdminController@maintenance')}}">Maintenance</a>
                             </li>
                        </ul>
                      </li>

                        <li>
                        <a href="#"><i class="fa fa-database fa-3x"></i> Inventory<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                                <a href="#">Purchases <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="{{ action('Purchases\PurchasesController@index') }}">Draft Purchase Orders</a></li>
                                    <li><a href="{{ action('Purchases\PurchasesController@pendingPurchases') }}">Pending Purchase Orders </a></li> <!-- for Ops / Managers to Approve -->
                                    <li><a href="{{ action('Purchases\PurchasesController@approvedPurchases') }}">Approved Purchase Orders </a></li> <!-- for Ops / Managers to Approve -->
                                    <li class="divider"> </li>
                                    <li><a href="{{ action('Purchases\PurchasesController@purchaseOrders') }}">Purchase Orders</a></li>
                                    <li><a href="{{ action('Purchases\ReceivingsController@index') }}">Receiving Reports</a></li>
                                    <li><a href="{{ action('Purchases\PaymentsController@index') }}">Accounts Payable</a></li>
                                </ul>
                            </li>
                           <li>
                                <a href="#">Releasing <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="{{ action('Sales\QuotationsController@index') }}">Draft Quotations</a></li>
                                    <li><a href="{{ action('Sales\QuotationsController@pendingQuotations') }}">Pending Quotations </a></li> <!-- for Ops / Managers to Approve -->
                                    <li><a href="{{ action('Sales\QuotationsController@approvedQuotations') }}">Approved Quotations </a></li> <!-- for Ops / Managers to Approve -->
                                    <li class="divider"> </li>
                                    <li><a href="{{ action('Sales\QuotationsController@salesorders') }}">Sales Orders</a></li>
                                    <li><a href="{{ action('Sales\DeliveriesController@index') }}">Delivery Reports</a></li>
                                    <li><a href="{{ action('Sales\CollectionsController@index') }}">Collections</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Inventory <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="{{ action('Items\ItemsController@index') }}">Items</a></li>
                                    <li class="divider"> </li>
                                    <li><a href="{{ action('Items\ItemTypesController@index') }}">Categories</a></li>
                                </ul>
                             </li>
                             <li>
                                <a href="#">Settings <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                  <li><a href="{{ action('Settings\SuppliersController@index') }}">Suppliers</a></li>
                                  <li><a href="{{ action('Settings\ClientsController@index') }}">Clients</a></li>
                                  <li class="divider"> </li>
                                  <li><a href="{{ action('Settings\AgentsController@index') }}">Sales Agents</a></li>

                                </ul>
                              </li>
                        </ul>
                      </li>
                      <li>
                        <a href="#"><i class="fa fa-pencil fa-3x"></i> Miscellaneous<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                           <li>
                                <a href="{{action('AdminController@information')}}">Company Information</a>
                            </li>

                            <li>
                                <a href="{{action('AdminController@termsncon')}}">Terms and Conditions</a>
                            </li>
                            <li>
                                 <a href="{{action('AdminController@carousel')}}">Carousel Images</a>
                             </li>
                            <li>
                                 <a href="{{action('AdminController@salesReports')}}">Sales Reports</a>
                             </li>
                             <li>
                                  <a href="{{action('AdminController@inventoryReports')}}">Inventory Reports</a>
                             </li>
                        </ul>
                      </li>
                </ul>
               
            </div>
            
        </nav>  
@if (Session::has('message'))
      @if (strpos(Session::get('message'), 'Success') !== false)
        <div class="alert alert-success alert-disassemble" role="alert">
      @elseif (strpos(Session::get('message'), 'Error') !== false)
        <div class="alert alert-danger alert-disassemble" role="alert">
      @else
        <div class="alert alert-info alert-disassemble" role="alert">
      @endif
       <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      {{ Session::get('message') }}
    </div>
    @endif


        <script>window.jQuery || document.write('<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"><\/script>')</script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('bower_components/datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script>
          $(function () {
            "use strict";
            // Form Disabler
            var $form = $('form');
            $form.on('submit', function (event) {
              var $button = $('button');
              if ('undefined' === typeof $button.attr('disabled')) {
                $button
                  .prop('disabled', true)
                  .find('i').attr('class', 'fa fa-spinner fa-spin');
                $form.find('input').attr('readonly', 'readonly');
                $form.find('select').attr('readonly', 'readonly');
              } else {
                event.preventDefault();
              }
            });
          });
        </script>

<div id="page-wrapper">
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<h2>@yield('title')</h2>
			</div>
		</div>
		<div class="row" style="margin-left: 5px; margin-right: 10px" >
            @yield('body')
		</div>
	</div>

</div>
         <!-- /. PAGE WRAPPER  -->
        </div>

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->

        <script src="{{asset('homepage/js/jquery-1.9.1.min.js')}}"></script>
        <script>window.jQuery || document.write('<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"><\/script>')</script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('bower_components/datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script>window.jQuery || document.write('<script src="homepage/js/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('assets/js/morris/raphael-2.1.0.min.js') }}"></script>
        <script src="{{ asset('assets/js/morris/morris.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        <script src="{{ asset('addasset/js/jquery.js') }}"></script>
        <script src="{{ asset('addasset/js/jquery.min.js') }}"></script>


        <script>window.jQuery || document.write('<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"><\/script>')</script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('bower_components/datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{asset('addasset/js/sweetalert.min.js')}}"></script>
        <script type="text/javascript">
         @if($errors)
        <script type="text/javascript">
        $(document).ready(function(){
            var errors = '{{$errors->first()}}';
            if(errors.length > 0)swal("Error",errors ,"error");

           
            
        });
        </script>
        @endif

        @if(Session::get('flash_message'))
        <script type="text/javascript">
        var xx= "{{Session::pull('flash_message')}}";
        swal("Success!",xx ,"success");
        </script>
        @endif
        </script>
        @yield('scripts')
 </body>
</html>
