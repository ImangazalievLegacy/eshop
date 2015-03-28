<?php

class HomeController extends BaseController {

	public function home()
	{
		return View::make('themes.default.home');
	}

}
