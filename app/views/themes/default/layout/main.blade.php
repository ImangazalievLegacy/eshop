<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'eShop CMS')</title>
	<link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
</head>
<body>

	@if (Session::has('global'))

		<p>{{ Session::get('global') }}</p>

	@endif

	@yield('content')

</body>
</html>