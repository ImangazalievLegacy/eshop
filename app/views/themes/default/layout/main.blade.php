<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'eShop CMS')</title>
	<link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
</head>
<body>

	<h1>Shop</h1>
	
	@if (Session::has('global'))

		<p>{{ Session::get('global') }}</p>

	@endif

	<div class="nav">
		@include('themes.default.layout.navigation')
	</div>

	<div class="content">
		@yield('content')
	</div>

</body>
</html>