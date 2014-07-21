<?php

class HomeController extends BaseController {

	/**
	* Layout yang akan digunakan untuk controller ini
	*/

	protected $layout = 'layouts.master';

	public function dashboard()
	{
		$this->layout->content = View::make('dashboard.index')->withTitle('Dashboard');
	}

	public function logout()
	{
		// Logout user
		Sentry::logout();
		// Redirect user ke halaman login
		return Redirect::to('login')->with('successMessage', 'Anda berhasil logout');
	}

	public function authenticate()
	{
		//ambil credentials dari $_POST variable
		$credentials = array(
			'email'		=> Input::get('email'),
			'password'	=> Input::get('password')
		);

		try {
			//authentikasi user
			$user = Sentry::authenticate($credentials, false);
			//Redirect user to dashboard
			return Redirect::intended('dashboard');
		} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
			return Redirect::back()->with('errorMessage', 'Password yang anda masukan salah.');
		} catch (Exception $e) {
			//kembalikan user ke halaman sebelum nya
			return Redirect::back()->with('errorMessage', trans('Akun dengan email tersebut tidak ditemukan di sistem kami.'));
		}
	}

}
