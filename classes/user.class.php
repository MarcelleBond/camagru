<?php

	require_once 'core/init.php';

	class user
	{
		private $_db,
				$_data,
				$_sessionName,
				$_isLoggedin;


		public function __construct($user = null)
		{
			$this->_db = DB::getInstance();

			$this->_sessionName = config::get('session/session_name');

			if (!$user) {
				if (session::exists($this->_sessionName)) {
					$user = session::get($this->_sessionName);

					if($this->find($user))
					{
						$this->_isLoggedin = true;
					}
					else
					{

					}
				}
				else
				{
					$this->find($user);
				}
			}
		}

		public function create($fields)
		{
			if(!$this->_db->insert('users', $fields))
				throw new Exception("problem creating user");
		}

		public function find($user = null)
		{
			if ($user) {
				$field = (is_numeric($user)) ? 'user_id' : 'username';
				$data = $this->_db->get('users', array($field, '=', $user));

				if($data->count())
				{
					$this->_data = $data->first();
					return true;
				}
			}
			return false;
		}

		public function login($username = null, $passwd = null)
		{
			$user = $this->find($username);

			if($user)
			{
				if($this->data()->passwd === hash::make($passwd))
				{
					session::put($this->_sessionName, $this->data()->user_id);
					return true;
				}

			}
			return false;
		}

		public function data()
		{
			return $this->_data;
		}

		public function isloggedin()
		{
			return $this->_isLoggedin;
		}
	}

?>
