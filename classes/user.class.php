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

		public function find($user = null)
		{
			if ($user) {
				$field = (is_numeric($user)) ? 'id' : 'username';
			}
		}

		public function login($username = null, $password = null)
		{
			$user = $this->find($username);
			return false;
		}
	}

?>