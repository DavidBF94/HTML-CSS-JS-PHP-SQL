<?php

	require_once dirname(__DIR__) . '../Model/User.class.php';

	class CntUser extends User {
		public $arDataUser = [
			"loggedin"         => false,
			"idUser"           => "",
			"nameUser"         => ""
		];

		public function __construct($email = "", $password = "") {
			if ($email !== "" && $password !== "") {
				parent::__construct($email, $password);

				if ($this->arStatus["codMsgToUser"] === OKQUERY) {
					
					echo $_SESSION["idUser"];


					$this->arDataUser["loggedin"]     = true;
					$this->arDataUser["idUser"]       = $_SESSION["idUser"];
					$this->arDataUser["nameUser"]     = $_SESSION["nameUser"];
				} else {

					$this->arDataUser["loggedin"]     = false;
					$this->arDataUser["idUser"]       = "";
					$this->arDataUser["nameUser"]     = "";
				}
			}
		}

		
		static public function getUserLogin() {
			$isLogged = self::_isUserLogin();

			if ($isLogged) {
				$arDataUser["loggedin"]     = true;
				$arDataUser["idUser"]       = $_SESSION["idUser"];
				$arDataUser["nameUser"]     = $_SESSION["nameUser"];
			} else {
				$arDataUser["loggedin"]     = false;
				$arDataUser["idUser"]       = "";
				$arDataUser["nameUser"]     = "Guest.";
			}

			return $arDataUser;
		}

		private static function _isUserLogin() {

			if (isset($_SESSION["idUser"])) {
				if ($_SESSION["idUser"] !== "") {
					$isLogged = true;
				} else {
					$isLogged = false;
				}
			} else {
				$isLogged = false;
			}

			return $isLogged;
		}
	} 

?>