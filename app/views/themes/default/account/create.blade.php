@extends('themes.default.layout.main')

@section('content')

	<h2>Форма регистрации</h2>

	<form action="{{ URL::route('account.create-post') }}" method="post">

		Username:<br>
		<input type="text" name="username" size="30" value="{{ (Input::old('username')) ? e(Input::old('username')) : '' }}">
		@if ( $errors->has('username') )
			{{ $errors->first('username') }}
		@endif

		<br>Email:<br>
		<input type="text" name="email" size="50" value="{{ (Input::old('email')) ?  e(Input::old('email')) : '' }}">
		@if ( $errors->has('email') )
			{{ $errors->first('email') }}
		@endif

		<br>Password:<br>
		<input type="text" name="password" size="30">
		@if ( $errors->has('password') )
			{{ $errors->first('password') }}
		@endif
		
		{{ Form::token() }}

		<br><input type="submit" value="Register">
	</form>

@stop