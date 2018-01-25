<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
	<meta name="apple-mobile-web-app-title" content="DC Message" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="mobile-web-app-capable" content="yes" />
	<link rel="apple-touch-startup-image" href="{{ URL::asset('/') }}assets/images/icons/startup-image.png">
	<link href="{{ URL::asset('/') }}assets/images/icons/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
	<link href="{{ URL::asset('/') }}assets/images/icons/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
	<link href="{{ URL::asset('/') }}assets/images/icons/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('/') }}assets/images/icons/favicon.ico" />
	{{ HTML::style('assets/css/bootstrap.min.css'); }}
	{{ HTML::style('assets/css/font-awesome.min.css'); }}
	{{ HTML::style('assets/css/master.css'); }}
	{{ HTML::style('assets/css/mobile.css'); }}
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js?ver=4.0'></script>
	{{ HTML::script('assets/js/main.js'); }}
	<title>DC Message</title>
</head>

<body class="minimal">
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="jumbotron">
			  	<h1>Page Not Found</h1>
				<p>Sorry the page you were looking for cannot be found.</p>
				<p><a class="btn btn-primary btn-lg" href="{{url()}}" role="button">Back to Dashboard</a></p>
			</div>
		</div>
	</div>
</div>
{{ HTML::script('assets/js/retina.min.js'); }}
</body>
</html>