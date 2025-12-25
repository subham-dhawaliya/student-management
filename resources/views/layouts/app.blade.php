<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel Auth</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg bg-warning mb-4 ">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">Laravel App</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
					<ul class="navbar-nav">
						@if(Auth::check())
							<li class="nav-item">
								<a class="nav-link" href="{{ route('dashboard') }}"><h5>Dashboard</h5></a>
							</li>
						@else
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}"><h5>Login</h5></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}"><h5>Register</h5></a>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			@if (session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			@endif
			@yield('content')
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>


