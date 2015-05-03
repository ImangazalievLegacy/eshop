@extends('themes.default.layout.main')

@section('content')

	<h2>Оформление заказа</h2>

	<form action="{{ URL::route('order.make-post') }}" method="post">

	@if (Auth::guest() or !isset($address))
		Фамилия и имя:<br>
		<input type="text" name="full_name" size="30" value="{{ (Input::old('full_name')) ? e(Input::old('full_name')) : '' }}">
		@if ( $errors->has('full_name') )
			{{ $errors->first('full_name') }}
		@endif

		<br>Адрес электронной почты:<br>
		<input type="text" name="email" size="30" value="{{ (Input::old('email')) ? e(Input::old('email')) : '' }}">
		@if ( $errors->has('email') )
			{{ $errors->first('email') }}
		@endif

		<br>Телефон:<br>
		<input type="text" name="phone_number" size="30" value="{{ (Input::old('phone_number')) ? e(Input::old('phone_number')) : '' }}">
		@if ( $errors->has('phone_number') )
			{{ $errors->first('phone_number') }}
		@endif
	@else

			{{ $address->full_name }}

			<input type="hidden" name="full_name" value="{{ $address->full_name }}">
			<input type="hidden" name="email" value="{{ Auth::user()->email }}">
			<input type="hidden" name="phone_number" value="{{ $address->phone_number }}">
			<input type="hidden" name="address_id" value="{{ $address->id }}">
			
	@endif

		<br>Комментарий:<br>
		<textarea name="comment" id="" cols="30" rows="10">{{ (Input::old('comment')) ?  e(Input::old('comment')) : '' }}</textarea>
		@if ( $errors->has('comment') )
			{{ $errors->first('comment') }}
		@endif

		<br>Способ доставки:<br>
		<select name="shipping_method">

			@if(isset($shippingMethods) && count($shippingMethods)>0)

				@foreach ($shippingMethods as $shippingMethod)

					<option value="{{ $shippingMethod->title }}">{{ $shippingMethod->title }}</option>

				@endforeach

			@endif

		</select>

		<br>Способ оплаты:<br>
		<select name="payment_method">

			<option value="cash">Наличный расчет</option>
			<option value="bank_transfer">Банковскй перевод</option>
			<option value="electronic">Электронный кошелек</option>

		</select>

		{{ Form::token() }}

		<br><br><input type="submit" value="Make Order">
	</form>

@stop