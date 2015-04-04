<?php

class AdminController extends BaseController {

	public function getIndex()
	{
		return View::make('themes.default.admin.index');
	}

	public static function isAdmin()
	{
		return Auth::user()->role == 1; // 1 - admin
	}

}