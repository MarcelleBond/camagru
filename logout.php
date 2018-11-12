<?php
	require_once 'core/init.php';
	
	$user = new user();
	if (!$user->isloggedin())
		redirect::to('index.php');
	$user->logout();

	redirect::to('index.php');
?>
