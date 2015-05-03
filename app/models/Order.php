<?php

class Order extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $fillable = array('type', 'owner_id', 'address_id', 'firstname', 'lastname', 'email', 'phone_number', 'ip_address', 'product_list', 'comment', 'total');

}