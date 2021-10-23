<?php

	require_once 'core/DBCore.class.php';

	class User extends DBcore {
		protected $idUser = "";                                
		protected $nameUser = "";

		function __construct($email, $password) {
			$this->db_name = 'bdComputerT';

			$this->idUser         = "";
			$this->nameUser       = "";

			$_isValid = $this->_isValidLoginUser($email, $password);

			if ($_isValid) {
				$this->setSessionUser();
			}
		}

		private function setSessionUser() {
			$_SESSION["idUser"]   = $this->idUser;
			$_SESSION["nameUser"] = $this->nameUser;
		}

	   
		private function _isValidLoginUser($email, $password) {
			$_isValid = false;
			$this->query = "SELECT IDuser, STusername 
								FROM USERS 
								WHERE STemail   = '{$email}'  
								AND STpassword  = '{$password}'";

			$this->get_results_from_query();
			var_dump($this);
			if ($this->arStatus["codMsgToUser"] === OKQUERY && $this->arStatus["num_rows"] === 1) {
				$this->idUser         = $this->rows[0]['IDuser'];
				$this->nameUser       = $this->rows[0]['STusername'];
				$_isValid = true;
			} else {
				$this->idUser         = "";
				$this->nameUser       = "";
				$_isValid = false;
			}

			return $_isValid;
		}
	} 
	
?>