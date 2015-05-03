@extends('themes.default.layout.main')

@section('content')

	<h2>Адреса</h2>

	@if(isset($addresses) && count($addresses)>0)

			@foreach ($addresses as $address)

				@include('themes.default.profile.addresses.item')

			@endforeach

	@endif
	<br>
	<button>Add Address</button>

@stop