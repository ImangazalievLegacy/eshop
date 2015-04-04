<nav>

	<h3>Навигация</h3>

	<ul>
		<li><a href="{{ URL::route('home') }}">Home</a></li>

		@if (Auth::check())

			<li><a href="{{ URL::route('account.logout') }}">Log Out</a></li>
			<li><a href="{{ URL::route('admin.index') }}">Admin panel</a></li>

		@else

			<li><a href="{{ URL::route('account.login') }}">Log In</a></li>
			<li><a href="{{ URL::route('account.create') }}">Create an account</a></li>
		
		@endif

	</ul>

	<h3>Категории</h3>

	@include('themes.default.layout.categories')
</nav>
