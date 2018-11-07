<?php
	require_once 'core/init.php';

	$user = new user();

	if (!$user->isloggedin()) {
		redirect::to('index.php');
	}


	function passwordupdate()
	{
		if (input::exists()) {
			if (token::check(input::get('token'))) {
				
				$validate = new validate();
				$validation = $validate->check($_POST, array(
					'passwd_current' => array(
						'required' => true,
						'min' => 6
					),
					'passwd_new' => array(
						'required' => true,
						'min' => 6
					),
					'passwd_new_again' => array(
						'required' => true,
						'min' => 6,
						'matches' => 'passwd_new'
					)
				));
	
				if ($validation->passed()) {
					if (hash::make(input::get('passwd_current')) !== $user->data()->passwd)
					{
						echo "Your current password was incorrect :(";
					}
					else
					{
						$user->update(array(
							'passwd' => hash::make(input::get('passwd_new'))
						));
						session::flash('home', 'Your password was updated');
						redirect::to('index.php');
					}
				} else {
					foreach ($validation->errors() as $error) {
						echo $error, "<br>";
					}
				}
				
			}
		}
	}

	function usernameupdate()
	{
		if (input::exists()) {
			if (token::check(input::get('token'))) {
				
				$validate = new validate();
				$validation = $validate->check($_POST, array(
					'username' => array(
						'min' => 2,
						'max' => 20,
						'unique' => 'users'
					),
				));
				if ($validation->passed())
				{
					try{
						$user->update(array(
							'username' => escape(input::get('username')),
						));
						session::flash('home', 'your details have been updated');
						redirect::to('index.php');
					}
					catch(Exception $e)
					{
						die($e->getMessage()); 
					}
				}
				else{
					foreach ($validation->errors() as $error) {
						echo $error, '<br>';
					}
				}
			}
		}
	}
	
	function emailupdate()
	{
		if (input::exists()) {
			if (token::check(input::get('token'))) {
				
				$validate = new validate();
				$validation = $validate->check($_POST, array(
					'email' => array(
						'required' => true,
						'unique' => 'users'
					),
					'email_again' => array(
						'required' => true,
						'matches' => 'email'
					)
				));
	
				if ($validation->passed()) {
					if (hash::make(input::get('passwd_current')) !== $user->data()->passwd)
					{
						echo "Your current password was incorrect :(";
					}
					else
					{
						$user->update(array(
							'email' => hash::make(input::get('email'))
						));
						session::flash('home', 'Your password was updated');
						redirect::to('index.php');
					}
				} else {
					foreach ($validation->errors() as $error) {
						echo $error, "<br>";
					}
				}
				
			}
		}
	}
?>