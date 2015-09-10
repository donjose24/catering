<!doctype html>
<html lang="{{ Config::get('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Karol Inventory</title>

    <!-- Bootstrap -->
    <link href="{{ asset('bower_components/datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bootswatch/cerulean/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.min.js"></script>
      <script>window.html5 || document.write('<script src="{{ asset('js/vendor/html5shiv-3.7.0.min.js') }}"><\/script>')</script>
      <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <script>window.respond || document.write('<script src="{{ asset('js/vendor/respond-1.4.2.min.js') }}"><\/script>')</script>
    <![endif]-->
 
  </head>
  <body style="padding-top: 70px;">
    <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
  
        </div>
        <a class="navbar-brand" href="{{ url('/') }}">Karol Inventory</a>
          <ul class="nav navbar-nav">
            <!-- Purchases Dropdown -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> Purchases <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ action('Purchases\PurchasesController@index') }}">Draft Purchase Orders</a></li>
                <li><a href="{{ action('Purchases\PurchasesController@pendingPurchases') }}">Pending Purchase Orders </a></li> <!-- for Ops / Managers to Approve -->
                <li><a href="{{ action('Purchases\PurchasesController@approvedPurchases') }}">Approved Purchase Orders </a></li> <!-- for Ops / Managers to Approve -->
                <li class="divider"> </li>
                <li><a href="{{ action('Purchases\PurchasesController@purchaseOrders') }}">Purchase Orders</a></li>
                <li><a href="{{ action('Purchases\ReceivingsController@index') }}">Receiving Reports</a></li>
                <li><a href="{{ action('Purchases\PaymentsController@index') }}">Accounts Payable</a></li>
              </ul>
            </li>
            <!-- Sales Dropdown -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-rub fa-lg"></i> Sales <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ action('Sales\QuotationsController@index') }}">Draft Quotations</a></li>
                <li><a href="{{ action('Sales\QuotationsController@pendingQuotations') }}">Pending Quotations </a></li> <!-- for Ops / Managers to Approve -->
                <li><a href="{{ action('Sales\QuotationsController@approvedQuotations') }}">Approved Quotations </a></li> <!-- for Ops / Managers to Approve -->
                <li class="divider"> </li>
                <li><a href="{{ action('Sales\QuotationsController@salesorders') }}">Sales Orders</a></li>
                <li><a href="{{ action('Sales\DeliveriesController@index') }}">Delivery Reports</a></li>
                <li><a href="{{ action('Sales\CollectionsController@index') }}">Collections</a></li>
<!--                <li><a href="{{ action('Sales\QuotationsController@receivables') }}">Accounts Receivable</a></li>
                <li><a href="{{ action('Sales\QuotationsController@fulfilled') }}">Fulfilled</a></li> -->
              </ul>
            </li>
            <!-- Inventory Dropdown -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-truck"></i> Inventory <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ action('Items\ItemsController@index') }}">Items</a></li>
                <!-- <li><a href="{{ action('Items\ItemsController@edit') }}">Reconcilliation</a></li>
                 --><li class="divider"> </li>
                <li><a href="{{ action('Items\ItemTypesController@index') }}">Categories</a></li>
              </ul>
            </li>
          </ul>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> Settings <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ action('Settings\SuppliersController@index') }}">Suppliers</a></li>
                  <li><a href="{{ action('Settings\ClientsController@index') }}">Clients</a></li>
                <li class="divider"> </li>
                  <li><a href="{{ action('Settings\AgentsController@index') }}">Sales Agents</a></li>
                  <li><a href="{{ action('Settings\UsersController@index') }}">Users</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{-- Auth::user()->email --}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ action('AuthController@getSignOut') }}"><i class="fa fa-sign-out"></i> Sign Out</a></li>
                </ul>
              </li>
              <li><a href="{{ action('AuthController@getSignIn') }}"><i class="fa fa-sign-in"></i> Sign In</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
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
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
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
      @yield('content')
    </div>
  </body>
</html>
