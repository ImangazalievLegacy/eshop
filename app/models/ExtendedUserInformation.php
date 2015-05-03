<?php

class ExtendedUserInformation extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'extended_user_information';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $fillable = array('owner_id', 'default_address_id');

	public static function getDefaultAddressId($ownerId)
	{
		return ExtendedUserInformation::where('owner_id', '=', $ownerId)->get()->first()->default_address_id;
	}

	public static function setDefaultAddressId($ownerId, $addressId)
	{
		return ExtendedUserInformation::where('owner_id', '=', $ownerId)->update(array('default_address_id' => $addressId));
	}

}