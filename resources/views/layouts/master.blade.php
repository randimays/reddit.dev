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
					<li><a href=" {{ action('PostsController@index') }}">All Posts<span class="sr-only">(current)</span></a></li>
					<li><a href=" {{ action('PostsController@newest') }}">Newest<span class="sr-only">(current)</span></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::check())
						<li><a href="{{ action('PostsController@create') }}">Create Post</a></li>
					<li>
						<a href="#" class="welcomeLoggedInUser dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <span class="loggedInUser">{{ Auth::user()->name }}</span><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="{{ action('PostsController@create') }}">Create Post</a></li>
								<li><a href="# ">My Account</a></li>
								<li><a href="{{ action('Auth\AuthController@getLogout') }}">Log Out</a></li>
							</ul>
					</li>
					@else 
					<li><a href="{{ action('Auth\AuthController@getLogin') }}">Log In</a></li>
					@endif
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
		<div class="container secondary">
			<form method="GET" action="{{ action('PostsController@index') }}" class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" name="post_search" class="form-control search" placeholder="Search Posts">
				</div>
				<button type="button" class="btn btn-default search">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span><span class="sr-only"> Search</span>
				</button>
			</form>
			<form method="GET" action="" class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" name="user_search" class="form-control search" placeholder="Search Users">
				</div>
				<button type="button" class="btn btn-default search">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span><span class="sr-only"> Search</span>
				</button>
			</form>
		</div>
	</nav>
	<div class="container">
	@yield('content')
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/js/bootstrap/bootstrap.min.js"></script>
</body>
</html>