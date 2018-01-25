<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
  <meta name="apple-mobile-web-app-title" content="DC Message" />
  <link href="{{ URL::asset('/') }}assets/images/icons/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
  <link href="{{ URL::asset('/') }}assets/images/icons/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
  <link href="{{ URL::asset('/') }}assets/images/icons/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
  <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('/') }}assets/images/icons/favicon.ico" />
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  {{ HTML::style('assets/css/bootstrap.min.css'); }}
  {{ HTML::style('assets/css/master.css'); }}
  {{ HTML::style('assets/css/mobile.css'); }}
  <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js?ver=4.0'></script>
  {{ HTML::script('assets/js/bootstrap.min.js'); }}
  {{ HTML::script('assets/js/Chart.min.js'); }}
  {{ HTML::script('assets/js/main.js'); }}
  <title>DC Message</title>
</head>

<body>
<div class="loading-overlay" style="display: none;">
  <div class="loading">
    <img src="{{url()}}/assets/images/icons/loader.gif" />
  </div>
</div>
<header class="main-header">
  <div class="container">
    <div class="row">
      <div class="col-xs-6">
          <a href="{{ url('/') }}" class="main-logo" class="pull-left"><img src="{{ url() }}/assets/images/template/dc-message-logo-invert.png" class="main-logo img img-responsive" /></a>
      </div>
      <div class="col-xs-6">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
          </button>
          <div class="pull-right hidden-xs">
            <span class="loggedin">Logged in as {{ $user->username }} </span>
            <a href="{{ url('/logout') }}" class="pull-right"><span class="fa fa-lock"></span> Sign Out</a>
            <div class="nexmo-balance">Nexmo Balance: <span>&euro;{{ $nexmo_balance }}</span> <a href="https://dashboard.nexmo.com/login" target="_blank"><span class="fa fa-external-link-square"></span> Nexmo</a></div>
          </div>
      </div>
    </div>
  </div>
</header>
<section class="page container">
  <div class="row">
    <div class="col-sm-2">
        <nav class="collapse navbar-collapse main-nav">
            <ul>
                <li {{(Request::is('/')) ? 'class="active"' : ''}}><a href="{{ url() }}"><span class="fa fa-tachometer"></span> Dashboard</a></li>
                <li {{(Request::is('messages')) ? 'class="active"' : ''}}{{(Request::is('messages/group/*')) ? 'class="active"' : ''}}><a href="{{ url() }}/messages"><span class="fa fa-comments"></span> Messages</a></li>
                <li {{(Request::is('messages/sent*')) ? 'class="active"' : ''}}><a href="{{ url() }}/messages/sent"><span class="fa fa-line-chart"></span> Reports</a></li>
            </ul>
        </nav>
    </div>
    <div class="col-sm-10">
      <div class="main-content">
