<?php

	require_once 'core/init.php';

	class user
	{
		private $_db,
				$_data,
				$_sessionName,
				$_cookieName,
				$_isLoggedin;


		public function __construct($user = null)
		{
			$this->_db = DB::getInstance();

			$this->_sessionName = config::get('session/session_name');
			$this->_cookieName = config::get('remember/cookie_name');

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

		public function login($username = null, $passwd = null, $remember = false)
		{
			$user = $this->find($username);
			if (!$username && !$passwd && $this->exists()) {
				session::put($this->_sessionName, $this->data()->id);
			} else {
				if($user)
				{
					if (!strcmp($this->_data->username, $username)) {
					
						if($this->data()->passwd === hash::make($passwd))
						{
							session::put($this->_sessionName, $this->data()->user_id);
							if ($remember) {
								$hash = hash::unique();
								$hashcheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->user_id));
								if(!$hashcheck->count())
								{
									$this->_db->insert('users_session', array(
										'user_id' => $this->data()->user_id,
										'hash' => $hash
									));

								}
								else
								{
									$hash = $hashcheck->first()->hash;

								}
								cookie::put($this->_cookieName, $hash, config::get('remember/cookie_expiry'));
							}

							return true;
						}
					}
				}
			}
			return false;
		}

		public function exists()
		{
			return (!empty($this->_data)) ? true : false;
		}

		public function data()
		{
			return $this->_data;
		}

		public function logout()
		{
			$this->_db->delete('users_session', array('user_id', '=', $this->data()->user_id));

			session::delete($this->_sessionName);
			cookie::delete($this->_cookieName);
		}

		public function isloggedin()
		{
			return $this->_isLoggedin;
		}
	}

?>
