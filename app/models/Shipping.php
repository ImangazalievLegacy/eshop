<?php

class Shipping extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'shipping';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $fillable = array('title', 'lang_code', 'cost', 'delivery_time', 'status');

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED  = 1;

	public static function getTitles() {

		return Shipping::lists('title');

	}

	public static function getMethods() {

		return Shipping::where('status', '=', self::STATUS_ENABLED)->get();

	}

}
