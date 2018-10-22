<?php

	session_start();

	$GLOBALS['config'] = array(
		'mysql' => array(
			'host' => 'localhost',
			'user' => 'root',
			'password' => '',
			'db' => "camagru"
		),
		'remember' => array(
			'cookie_name' => 'hash',
			'cookie_expiry' => 604800,
		),
		'session' => array(
			'session_name' => 'user',
			'token_name' => 'token',
		),
	);

	spl_autoload_register(function($class){
		require_once 'classes/' . $class .'.class'. '.php';
	});

	require_once 'functions/sanitize.php';

	if(cookie::exists(config::get('remember/cookie_name')) && session::exists(config::get('session/session_name')))
	{
		$hash = config::get('cookie/cookie_name');
		$hashcheck = DB::get('users_session', array('hash', '=', $hash));

		if($hashcheck->count())
		{
			$user = new user($hashcheck);
		}
	}

?>
