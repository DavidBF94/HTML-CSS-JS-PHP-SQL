<?php

	require_once dirname(__DIR__) . '../Model/Concept.class.php';

	class CntConcept extends Concept {

		public $ultReg;

		public $arDataConcept = [ 
			"idConcept"             =>     "",
			"nameConcept"           =>     "",
			"IdExplanation"         =>     "",
			"TEexplanation"         =>     "",
			"totalPages"            =>     "",
			"mainImageFile"         =>     "",
			"mainImageToolTip"      =>     "",
			"numVisited"            =>     "",

			"txtVisited"            =>     "Inicia sesión para registrar que has aprendido.",

			"relationShipConcepts"      =>     [
				"numRelations"          => "",
				"dataRelations"         =>     [
					[
						"idConcept"     => "",
						"nameConcept"   => ""
					],
					[
						"idConcept"     => "",
						"nameConcept"    => ""
					]
				]
			],
			"descendents"        =>    [
				
				"numDescendents"    =>    0,
			   
				"items"                =>    []
			],
			"groups"            =>    [
				
				[
					"idConceptGroup"     => "",
					"nameConceptGroup"     => ""
				]
			],
			"images"             =>     [
				[
					"STimagefile" => "",
					"STtooltipimage"     => ""
				],
				[
					"STimagefile" => "",
					"STtooltipimage"     => ""
				],
				[
					"STimagefile" => "",
					"STtooltipimage"     => ""
				],
				[
					"STimagefile" => "",
					"STtooltipimage"     => ""
				],
			],
			"totalImagesConcept"    =>  [
				[
					"totalImages" => ""
				]
			],
			"linksbyconcept"        => [
				[
					"STlinkurl" => "",
					"STlinkuser" => ""
				],
				[
					"STlinkurl" => "",
					"STlinkuser" => ""
				],
				[
					"STlinkurl" => "",
					"STlinkuser" => ""
				]
			]
		];


		public function __construct($idConcept = "", $typeCall = "synchronous", $ultReg) {
		   $this->ultReg = $ultReg;
			$arDataUser = cntUser::getUserLogin();

			parent::__construct($idConcept);
			$this->arDataConcept["idConcept"] = parent::getIdConcept();


			switch ($typeCall) {
				case "synchronous":
					$this->getAllDataConcept();
					if ($arDataUser["idUser"] !== "") {
						$this->setPageVisitedbyUser(
							$arDataUser["idUser"],
							$this->arDataConcept["IdExplanation"]
						);

						$this->getNumTimesVisited($this->arDataConcept["IdExplanation"]);
					}

					$this->view($this, $arDataUser);
					break;
				case "Asynchronous":

					break;
			}
		}

		public function setPageVisitedbyUser(int $idUser, int $idExplication) {
			parent::setPageVisited($idUser, $idExplication);
		}

		public function getIdExplication() {
			return $this->arDataConcept["IdExplanation"];
		}

		private function getAllDataConcept($requestedPage = 1) {
			$i = 0;

			parent::getNameConcept();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				$this->arDataConcept["nameConcept"]
					= $this->rows[0]['titleConcept'];
			} else {
				$this->arDataConcept["nameConcept"]
					= "Error.";
			}

			parent::getExplicationPageConcept(1);
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				$this->arDataConcept["IdExplanation"]
					= $this->rows[0]['IDexplanation'];
				$this->arDataConcept["TEexplanation"]
					= $this->rows[0]['TEexplanation'];
			} else {
				$this->arDataConcept["IdExplanation"]         = 0;
				$this->arDataConcept["TEexplanation"]         = "No information on the 
				concept";
			}

			parent::getTotalPagesExplicationConcept();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				$this->arDataConcept["totalPages"]
					= $this->rows[0]['totalPages'];
			} else {
				$this->arDataConcept["totalPages"]             = 1;
			}

			parent::getPrincipalImageByConcept();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				$this->arDataConcept["mainImageFile"]
					= $this->rows[0]['STimagefile'];
				$this->arDataConcept["mainImageToolTip"]
					= $this->rows[0]['STtooltipimage'];
			} else {
				$this->arDataConcept["mainImageFile"]           = "";
				$this->arDataConcept["mainImageToolTip"]        = "";
			}

			parent::getAllImagesByConcept($this->ultReg);
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				foreach ($this->rows as $index => $arFila) {
					foreach ($arFila as $clave => $valor) {
						$this->arDataConcept["images"][$index][$clave] = $valor;
					}
				}
			}

			parent::getTotalImagesConcept();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				foreach ($this->rows as $index => $arFila) {
					foreach ($arFila as $clave => $valor) {
						$this->arDataConcept["totalImagesConcept"][$index][$clave] = $valor;
					}
				}
			}

			parent::getRelationShipConcepts();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				foreach ($this->rows as $index => $arFila) {
					foreach ($arFila as $clave => $valor) {
						$this->arDataConcept["relationShipConcepts"]["dataRelations"][$index][$clave]
							= $valor;
					}
				}
			}

			parent::getTotalRelationsShipConcepts();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				$this->arDataConcept["relationShipConcepts"]["numRelations"]
					= $this->rows[0]['totalRelationsShips'];
			}

			$idConceptGroup = $this->arDataConcept["idConcept"];
			do {
				parent::getGroupsConcept($idConceptGroup);
				if ($this->arStatus["codMsgToUser"] === OKQUERY) {

					$this->arDataConcept["groups"][$i]["idConceptGroup"]
						= $this->rows[0]['idConceptGroup'];
					$this->arDataConcept["groups"][$i]["nameConceptGroup"]
						= $this->rows[0]['nameConceptGroup'];
					$idConceptGroup = $this->rows[0]['idConceptGroup'];
				}

				$i++;
			} while ($this->arStatus["codMsgToUser"] === OKQUERY);

			parent::getDescendentsConcept();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				$this->arDataConcept["descendents"]["numDescendents"]
					= count($this->rows);
				foreach ($this->rows as $index => $arFila) {
					foreach ($arFila as $clave => $valor) {
						$this->arDataConcept["descendents"]["items"][$index][$clave]
							= $valor;
					}
				}
			}

			parent::getLinksByConcept();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) 
			{
				foreach ($this->rows as $index => $arFila) 
				{
					foreach ($arFila as $clave => $valor) 
					{
						$this->arDataConcept["linksbyconcept"][$index][$clave] = $valor;
					}
				}
			}
		}

		public function getNumTimesVisited($idExplication) {
			$arDataUser = cntUser::getUserLogin();
			if ($arDataUser["loggedin"] ) { 

				parent::getNumTimesVisitedExplication(
					$arDataUser["idUser"],
					$idExplication
				);

				if ($this->arStatus["codMsgToUser"] === OKQUERY) {

					$this->arDataConcept["numVisited"] = $this->rows[0]['numVisited'];

					$this->arDataConcept["txtVisited"] = VISITED_1 .
						$this->rows[0]['numVisited'];
					if ($this->rows[0]['numVisited'] === 1) {
						$this->arDataConcept["txtVisited"] .= VISITED_3;
					} else {
						$this->arDataConcept["txtVisited"] .= VISITED_2;
					}
				} else {
					$this->arDataConcept["numVisited"] = "";
					$this->arDataConcept["txtVisited"] = "Error.";
				}
			}
		}

		public function getExplicationConcept($requestedPage) {
			parent::getExplicationPageConcept($requestedPage);
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				$this->arDataConcept["IdExplanation"] = $this->rows[0]['IDexplanation'];
				$this->arDataConcept["TEExplication"] = $this->rows[0]['TEexplanation'];

				$arDataUser = cntUser::getUserLogin();
				if ($arDataUser["idUser"] !== "") {
					$this->setPageVisitedbyUser(
						$arDataUser["idUser"],
						$this->arDataConcept["IdExplanation"]
					);
					$this->getNumTimesVisited($this->arDataConcept["IdExplanation"]);
				}
			} else {
				$this->arDataConcept["TEExplication"] = "Error.";
			}
		}
		

		public function view($objNewConcept, $arDataUser) {
			if (file_exists("View/view_main.php")) {
				include_once "View/view_main.php";
			} else {
				die("Ohhh. The view doesn't exists.");
			}
		}
	}
	
?>