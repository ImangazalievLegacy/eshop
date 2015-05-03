<?php

class Currency extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'currencies';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $fillable = array('title', 'code', 'symbol', 'position');

	const POSITION_BEFORE = 1;
	const POSITION_AFTER = 2;

	public static function getCodes() {

		return Currency::lists('code');

	}

}