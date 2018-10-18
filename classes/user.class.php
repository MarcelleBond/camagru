<?php

	require_once 'core/init.php';

	class user
	{
		private $_db;

		public function __construct($user = null)
		{
			$this->_db = DB::getInstance();
		}

		public function create($fields)
		{
			if(!$this->_db->insert('users', $fields))
				throw new Exception("problem creating user");
		}
	}

?>