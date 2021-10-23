<?php

	require_once 'core/DBCore.class.php';


	class Concept extends DBcore {
		
		private $_idConceptRequest = "";

		
		function __construct($idConcept) {
			$this->db_name = 'bdComputerT';
			
			if ($idConcept === "") {
				$this->_setIdConcept();
			} else {
				$this->_idConceptRequest = $idConcept;
			}
		}

		
		private function _setIdConcept() {
			$this->query = "SELECT IDconcept AS idCoverConcept, TIConcept 
				FROM CONCEPTS 
				WHERE Bactive AND Bcoverpage 
				ORDER BY DAuploaddate DESC 
				LIMIT 1";

			$this->get_results_from_query();
			if ($this->arStatus["codMsgToUser"] === OKQUERY) {
				$this->_idConceptRequest         = $this->rows[0]['idCoverConcept'];
			}
		}

		
		public function getIdConcept() {
			return $this->_idConceptRequest;
		}

		
		public function getNameConcept() {
			$this->query = "SELECT `IDconcept` AS IDconcept, `TIconcept` AS titleConcept 
			FROM `CONCEPTS` 
			WHERE `Bactive` 
			AND `IDconcept` = {$this->_idConceptRequest}";

			$this->get_results_from_query();
		}
		
		public function getTotalPagesExplicationConcept() {
			$this->query = "SELECT COUNT( * ) AS totalPages
									FROM `EXPLANATIONS` 
									WHERE `IDconcept` = {$this->_idConceptRequest}";

			$this->get_results_from_query();
		}
		
		public function getExplicationPageConcept($page) {
			$this->query = "SELECT `IDexplanation`, `TEexplanation`
									FROM `EXPLANATIONS` 
									WHERE `IDconcept` = {$this->_idConceptRequest}
									AND `IOrder` = $page
									ORDER BY `Iorder` ASC";

			$this->get_results_from_query();
		}

		
		public function getDescendentsConcept() {
			$this->query = "SELECT `GROUPS`.`IDGroupConcept` as `idConcept`, 
				`T2`.`TIConcept` as `nameConcept`
										FROM `GROUPS`, `CONCEPTS` T1, `CONCEPTS` T2
										WHERE `GROUPS`.`IDconcept`= `T1`.`IDconcept`
										AND `GROUPS`.`IDGroupConcept` = `T2`.`IDconcept`
										AND `GROUPS`.`IDconcept` = {$this->_idConceptRequest}";

			$this->get_results_from_query();
		}

		
		public function getPrincipalImageByConcept() {
			$this->query = "SELECT `STimagefile`, `STtooltipimage`
									FROM `IMAGESBYCONCEPT`
									INNER JOIN `IMAGES`
									ON `IMAGESBYCONCEPT`.`IDimage` = `IMAGES`.`IDimage`
									WHERE `IMAGESBYCONCEPT`.`IDconcept` = {$this->_idConceptRequest}
									AND `Iorder` = 1";
			$this->get_results_from_query();
		}

		
		public function getAllImagesByConcept($ultReg) {
			$ultReg = $ultReg * 4;
			$this->query = "SELECT `STimagefile`, `STtooltipimage`
									FROM `IMAGESBYCONCEPT`
									INNER JOIN `IMAGES`
									ON `IMAGESBYCONCEPT`.`IDimage` = IMAGES.IDimage
									WHERE `IMAGESBYCONCEPT`.`IDconcept` = {$this->_idConceptRequest}
									ORDER BY `Iorder`
									LIMIT $ultReg, 4";

			$this->get_results_from_query();
		}

		public function getTotalImagesConcept() 
		{
			$this->query = "SELECT COUNT( * ) AS totalImages
									FROM `IMAGESBYCONCEPT`
									INNER JOIN `IMAGES`
									ON `IMAGESBYCONCEPT`.`IDimage` = IMAGES.IDimage
									WHERE `IMAGESBYCONCEPT`.`IDconcept` = {$this->_idConceptRequest}";
			$this->get_results_from_query();
		}

		
		public function getNumTimesVisitedExplication($idUser, $idExplication) {
			$this->query = "SELECT COUNT( * ) AS `numVisited`
									FROM `QUERIES`
									WHERE `IDuser` = $idUser 	
									AND `IDexplanation` = $idExplication";

			$this->get_results_from_query();
		}

		
		public function getRelationShipConcepts() {
			$this->query = "SELECT `T2`.`IDconcept` AS `idConcept`, `T2`.`TIConcept` AS `nameConcept`
									FROM `RELATIONSHIPCONCEPTS`
									INNER JOIN `CONCEPTS` T1
									ON `RELATIONSHIPCONCEPTS`.`IDconcept` = `T1`.`IDconcept`
									INNER JOIN `CONCEPTS` T2
									ON `RELATIONSHIPCONCEPTS`.`IDrelatedConcept` = `T2`.`IDconcept`
									WHERE `RELATIONSHIPCONCEPTS`.`IDconcept`  = {$this->_idConceptRequest}
									ORDER BY `Iorder`
									LIMIT 2";

			$this->get_results_from_query();
		}
		
		public function getTotalRelationsShipConcepts() {
			$this->query = "SELECT COUNT( * ) AS `totalRelationsShips`
									FROM `RELATIONSHIPCONCEPTS`
									WHERE `RELATIONSHIPCONCEPTS`.`IDconcept`  = {$this->_idConceptRequest}";

			$this->get_results_from_query();
		}
		
		public function getGroupsConcept($idConceptGroup) {
			$this->query = "SELECT `CONCEPTS`.`IDconcept` AS `idConceptGroup`, 
							`CONCEPTS`.`TIconcept` AS `nameConceptGroup`
							FROM `GROUPS`, `CONCEPTS`
							WHERE `GROUPS`.`IDconcept`= `CONCEPTS`.`IDconcept`
							AND `GROUPS`.`IDgroupConcept`= $idConceptGroup";

			$this->get_results_from_query();
		}

		public function getLinksByConcept() {
			$this->query = "SELECT `STlinkurl`, `STlinkuser`
									FROM `LINKSBYCONCEPT`
									WHERE `LINKSBYCONCEPT`.`IDconcept`  = {$this->_idConceptRequest}";

			$this->get_results_from_query();
		}

		
		public function setPageVisited(int $idUser, int $idExplication) {
			$now = date("Y/m/d H:i:s");

			$this->query = "INSERT INTO `QUERIES` 
					( `IDuser`, `IDexplanation`, `DAquerydate` ) 
				VALUES
					( $idUser, $idExplication, '$now' ) ";

			$this->execute_single_query();

		}
	}
	
?>
