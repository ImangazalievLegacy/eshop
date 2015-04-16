@extends('themes.default.layout.main')

@section('content')

	<h2>Добавление категории</h2>

	<form action="{{ URL::route('category.add-post') }}" method="post">

		Title:<br>
		<input type="text" name="title" size="30" value="{{ (Input::old('title')) ? e(Input::old('title')) : '' }}">
		@if ( $errors->has('title') )
			{{ $errors->first('title') }}
		@endif

		<br>URL:<br>
		<input type="text" name="url" size="30" value="{{ (Input::old('url')) ? e(Input::old('url')) : '' }}">
		@if ( $errors->has('url') )
			{{ $errors->first('url') }}
		@endif

		<br>Parent Category:<br>
		<select name="parent_id">
			@foreach (Category::getAll() as $category)

			<option value="{{ $category->id }}">{{ str_repeat('&bullet;', $category->level) }} {{  $category->title }}</option>

			@endforeach
		</select>
		@if ( $errors->has('parent_id') )
			{{ $errors->first('parent_id') }}
		@endif
		
		{{ Form::token() }}

		<br><input type="submit" value="Add">
	</form>

@stop