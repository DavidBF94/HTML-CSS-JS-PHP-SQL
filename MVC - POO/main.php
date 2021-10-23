<?php

	session_start();

	require_once "Controller/CntConcept.class.php";
	require_once "Controller/CntUser.class.php";
	require_once "config/CONSTANTS.php";
	require_once '../env.php';

	if (isset($_GET["idconcept"])) 
	{
		$idConcept = $_GET["idconcept"];
	} 
	else 
	{
		$idConcept = "";
	}

	if (isset($_GET["pagImg"])) 
	{
		$ultReg = $_GET["pagImg"];
		$ultReg = intval($ultReg);
	} 
	else 
	{
		$ultReg = 0;
	}

	$objNewConcept = new CntConcept($idConcept, "synchronous", $ultReg);
	
?>