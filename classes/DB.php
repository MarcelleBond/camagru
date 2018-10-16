<?php
	require_once 'core/init.php';

	class DB
	{
		private static $_instance = null;
		private $_pdo,
				$_query,
				$_error = false,
				$_results,
				$_count = 0;

		private function __construct()
		{
			try
			{
				$this->_pdo = new PDO('mysql:host=' . config::get('mysql/host') .';
				dbname=' . config::get('mysql/db'), config::get('mysql/user'),
				config::get('mysql/password'));

			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}

		public static function getInstance()
		{
			if (!isset(self::$_instance)) {
				self::$_instance = new DB();
			}
			return (self::$_instance);
		}

		public function query($sql,$params = array())
		{
			$this->_error = false;
			if ($this->_query = $this->_pdo->prepare($sql))
			{
				$x = 1;
				if(count($params))
				{
					foreach ($params as $key) {
						$this->_query->bindValue($x,$key);
						$x++;
					}
				}
				if ($this->_query->execute()) {
					echo "sucesse";
				}
			}
		}
	}

?>
