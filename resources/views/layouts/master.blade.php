<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reddit</title>
	<link href="/css/bootstrap/bootstrap.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Proza+Libre" rel="stylesheet">

	<link href="/css/site.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">
					<img id="navbar-brand" src="/img/cruddit_logo.png" alt="Cruddit"></a>
			</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">All Posts <span class="sr-only">(current)</span></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-form navbar-left">
					<div class="form-group">
						<input type="text" class="form-control search">
					</div>
					<button type="button" class="btn btn-default search">
 						<span class="glyphicon glyphicon-search" aria-hidden="true"></span><span class="sr-only"> Search</span>
					</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::check())
						<li><a href="{{ action('PostsController@create') }}">Create Post</a></li>
					<li>
						<a href="#" class="welcomeLoggedInUser dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <span class="loggedInUser">{{ Auth::user()->name }}</span><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="{{ action('PostsController@create') }}">Create Post</a></li>
								<li><a href="#">My Account</a></li>
								<li><a href="{{ action('Auth\AuthController@getLogout') }}">Log Out</a></li>
							</ul>
					</li>
					@else 
					<li><a href="{{ action('Auth\AuthController@getLogin') }}">Log In</a></li>
					@endif
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container">
	@yield('content')
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/js/bootstrap/bootstrap.min.js"></script>
</body>
</html>