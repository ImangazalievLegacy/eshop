<?php

class ProfileController extends BaseController {

	public function getIndex()
	{
		return View::make('themes.default.profile.index');
	}

	public function getAddressList()
	{
		$userId = Auth::user()->id;

		$addresses = Address::getByOwnerId($userId);

		return View::make('themes.default.profile.addresses.index')->with('addresses', $addresses);
	}

}