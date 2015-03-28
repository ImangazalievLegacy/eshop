<?php

class AdminController extends BaseController {

	public function getIndex()
	{
		return View::make('themes.default.admin.index');
	}

}