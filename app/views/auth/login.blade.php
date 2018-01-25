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
	{{ HTML::style('assets/css/bootstrap.min.css'); }}
	{{ HTML::style('assets/css/font-awesome.min.css'); }}
	{{ HTML::style('assets/css/master.css'); }}
	{{ HTML::style('assets/css/mobile.css'); }}
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js?ver=4.0'></script>
	{{ HTML::script('assets/js/main.js'); }}
	<title>DC Message</title>
</head>

<body class="login">
<div class="container">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<img src="{{ url() }}/assets/images/template/dc-message-logo.png" class="main-logo" />
			<div class="login-block">	
				<h1>Login Below</h1>
				@if(Session::has('error'))
				<div class="alert-box danger">
				    <p>{{ Session::get('error') }}</p>
				</div>
				@endif
				@if(Session::has('success'))
				<div class="alert-box success">
				    <p>{{ Session::get('success') }}</p>
				</div>
				@endif
				<form class="form-login" role="form" action="login" method="POST">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			        <label for="inputEmail" class="sr-only">Email address</label>
			        <input type="text" class="form-control" placeholder="Username" required="" autofocus="" name="username">
			        <label for="inputPassword" class="sr-only">Password</label>
			        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
			        <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
			    </form>
				
			</div>
		</div>
	</div>
</div>
{{ HTML::script('assets/js/retina.min.js'); }}
</body>
</html>
