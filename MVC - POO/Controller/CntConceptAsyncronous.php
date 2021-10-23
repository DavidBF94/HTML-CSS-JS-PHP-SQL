<?php

	session_start();

	require_once "cntConcept.class.php";
	require_once "cntUser.class.php";
	require_once "../config/constants.php";
	require_once '../../env.php';

	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

	if ($contentType === "application/json") {
		
		$content = trim(file_get_contents("php://input"));

		$dataAction = json_decode($content, true);

		if (is_array($dataAction)) {
			switch ($dataAction["action"]) {
				case "paginationExplication":
					$objOtherPageConcept = new CntConcept(
						$dataAction["idconcept"],
						"Asynchronous", 0
					);

					$objOtherPageConcept->getExplicationConcept(
						$dataAction["requestpage"]
					);

					$objOtherPageConcept->getNumTimesVisited(
						$objOtherPageConcept->arDataConcept["IdExplanation"]
					);
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
		echo json_encode($objOtherPageConcept);
	}

?>