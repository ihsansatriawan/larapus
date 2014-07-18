<?php

class SentrySeeder extends Seeder {
	/**
	 *
	 * Jalankan database seeder
	 *
	 * @return void
	 */
	public function run()
	{
		// Hapus isi table users, groups, users_groups dan throttle
		DB::table('users_groups')->delete();
		DB::table('groups')->delete();
		DB::table('users')->delete();
		DB::table('throttle')->delete();

		try
		{
			//membuat grup admin
			$group = Sentry::createGroup(array(
				'name'			=> 'admin',
				'permissions'	=> array(
					'admin' => 1,
				),
			));

			//membuat grup regular
			$grup = Sentry::createGroup(array(
				'name'			=> 'regular',
				'permissions'	=> array(
					'regular'	=> 1,
				),
			));
		}

		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}

		try
		{
			//membuat admin baru
			$admin = Sentry::register(array(
				'email'			=> 'laravel.perpustakaan@gmail.com',
				'password' 		=> '#larapus2014',
				'first_name'	=> 'Admin',
				'last_name' 	=> 'Larapus'

			), true); //langsung diaktivasi

			//cari grup admin
			$adminGroup = Sentry::findGroupByName('admin');

			// Masukkan user ke grup admin
			$admin->addGroup($adminGroup);

			// Membuat user regular baru
			$user = Sentry::register(array(
			// silahkan ganti sesuai keinginan
			'email'			=> 'ihsan.satriawan.20@gmail.com',
			'password' 		=> 'ihsansatriawan2008',
			'first_name'	=> 'Ihsan',
			'last_name' 	=> 'Satriawan'
			), true); // langsung diaktivasi

			// Cari grup regular
			$regularGroup = Sentry::findGroupByName('regular');

			// Masukkan user ke grup regular
			$user->addGroup($regularGroup);

		}

		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			echo 'User with this login already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			echo 'Group was not found.';
		}

	}
}