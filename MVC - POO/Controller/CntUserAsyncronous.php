<?php

	session_start();

	require_once "CntUser.class.php";
	require_once "../config/constants.php";
	require_once '../../env.php';
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

	if ($contentType === "application/json") {
		
		$content = trim(file_get_contents("php://input"));

		$dataAction = json_decode($content, true);

		if (is_array($dataAction)) {
			switch ($dataAction["action"]) {
				case "loginUser":
					$objUser = new CntUser(
						$dataAction["email"],
						$dataAction["password"]
					);
					break;

				case "isUserSession":
					$objUser = CntUser::getUserLogin();
					break;

				case "userLogout":
					session_destroy();
					$objUser["loggedin"] = false;
					$objUser["idUser"] = "";
					$objUser["nameUser"] = "Guest";
					break;
			}
		} else {
			$dataReturn["desError"]  = "Incorrect data received, not an array";
		}
	} else {
		$dataReturn["desError"]  = "Incorrect header, expected application/json.";
	}

	if (isset($dataReturn)) {
		echo json_encode($dataReturn);
	} else {
		echo json_encode($objUser);
	}

?>