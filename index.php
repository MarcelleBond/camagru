<?php
	require_once 'core/init.php';

	$user = DB::getInstance()->insert('users',array(
		'username' => 'Dale',
		'password' => '123456',
		'salt' => 'salt'));

	if ($user) {
		echo "yay";
	} else {
		echo "i fucked up";
	}

?>
