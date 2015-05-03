@extends('themes.default.layout.main')

@section('content')

	<h2>Добавление товара</h2>

	<form action="{{ URL::route('products.add-post') }}" method="post">

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

		<br>Article Number:<br>
		<input type="text" name="article_number" size="30" value="{{ (Input::old('article_number')) ? e(Input::old('article_number')) : '' }}">
		@if ( $errors->has('article_number') )
			{{ $errors->first('article_number') }}
		@endif

		<br>Description:<br>
		<textarea name="description" id="" cols="30" rows="10">{{ (Input::old('description')) ?  e(Input::old('description')) : '' }}</textarea>
		@if ( $errors->has('description') )
			{{ $errors->first('description') }}
		@endif

		<br>Price:<br>
		<input type="text" name="price" size="10" value="{{ (Input::old('price')) ?  e(Input::old('price')) : '' }}">
		@if ( $errors->has('price') )
			{{ $errors->first('price') }}
		@endif

		<br>Category:<br>
		<select name="category_id">
			@foreach (Category::getAll() as $category)

			<option value="{{ $category->id }}">{{ str_repeat('&bullet;', $category->level) }} {{  $category->title }}</option>

			@endforeach
		</select>
		@if ( $errors->has('category_id') )
			{{ $errors->first('category_id') }}
		@endif

		<br>Currency:<br>
		<select name="currency">
			@if(isset($currencies) && count($currencies)>0)

					@foreach ($currencies as $currency)

						<option value="{{ $currency->code }}">{{ $currency->title }}</option>

					@endforeach

			@endif
		</select>
		@if ( $errors->has('currency') )
			{{ $errors->first('currency') }}
		@endif
		
		{{ Form::token() }}

		<br><input type="submit" value="Add">
	</form>

@stop