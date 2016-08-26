<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cruddit</title>
	<link href="/css/bootstrap/bootstrap.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Proza+Libre" rel="stylesheet">
	<link href="/css/site.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href=" {{ action('PostsController@index') }} ">
					<img id="navbar-brand" src="/img/cruddit_logo.png" alt="Cruddit"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href=" {{ action('PostsController@index') }}">All Posts<span class="sr-only">All Posts</span></a></li>
					<li><a href=" {{ action('PostsController@newest') }}">Newest<span class="sr-only">Newest</span></a></li>
				</ul>
				<form method="GET" action="{{ action('PostsController@index') }}" class="navbar-form">
					{!! csrf_field() !!}
					<div class="form-group">
						<input type="text" name="post_search" class="form-control search" placeholder="SEARCH">
					</div>
					<button type="button" class="btn btn-default search">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						<span class="sr-only">Search</span>
					</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::check())
						<li>
							<a href="{{ action('PostsController@create') }}">Create Post</a>
						</li>
						<li>
							<a href="#" class="welcomeLoggedInUser dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <span class="loggedInUser">{{ Auth::user()->name }}</span><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{ action('PostsController@create') }}">Create Post</a></li>
									<li><a href="{{ action('UsersController@show', ['id' => Auth::user()->id]) }}">My Account</a></li>
									<li><a href="{{ action('Auth\AuthController@getLogout') }}">Log Out</a></li>
								</ul>
						</li>
					@else 
						<li><a href="{{ action('Auth\AuthController@getLogin') }}">Log In</a></li>
						<li><a href="{{ action('Auth\AuthController@getRegister') }}">Register</a></li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
	@yield('content')
	</div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
					<p id="finePrint" class="text-center">Cruddit is a Reddit.com parody built by someone who had literally never used Reddit before. The baby poop yellow-brown color, content, design choices, and all other seemingly arbitrary style decisions are the intellectual property of Randi Mays.</p>
				</div>
			</div>
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/js/bootstrap/bootstrap.min.js"></script>
</body>
</html>