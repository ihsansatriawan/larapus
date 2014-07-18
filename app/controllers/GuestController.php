<?php

class GuestController extends BaseController {

	/**
	 * Layout digunakan
	 */
	protected $layout = 'layouts.guest';

	public function login()
	{
		$this->layout->content = View::make('guest.login');
	}
} 
?>