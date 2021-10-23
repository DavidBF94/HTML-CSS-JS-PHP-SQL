<?php
	class DBcore {
		private static $db_host = 'localhost';		
		private static $db_user = 'root';			
		private static $db_pass = '';				

		private $link;								
		protected $db_name = '';					
		
		protected $query = "";						

		protected $queryT1 = "";					
		protected $queryT2 = "";					
		
		protected $rows = array();					
		
		protected $arStatus = [ 	"codErrorDB"	=> "",
									"desErrorDB"	=> "",
									"num_rows"		=> -1,
									"affected_rows"	=> -1,
									"codMsgToUser"	=> "",
									"strSQL"		=> "" ];
		
		private function open_connection() {
			$this -> link = new mysqli( self::$db_host, self::$db_user, self::$db_pass, $this -> db_name );
		}
		
		private function close_connection() {
			$this -> link -> close();
		}
		
		protected function execute_single_query() {
			$this -> open_connection();
			$this -> link -> query( $this -> query );
			
			$this -> arStatus[ "codErrorDB" ] = $this -> link -> errno;
			$this -> arStatus[ "desErrorDB" ] = $this -> link -> error;
			
			if ( $this -> arStatus[ "codErrorDB" ] === 0 ) {
				$this -> arStatus[ "codMsgToUser" ] 	= OKQUERY;
				$this -> arStatus[ "affected_rows" ] 	= $this -> link -> affected_rows;
				$this -> arStatus[ "strSQL" ] 			= $this -> query;
			} else {
				$this -> arStatus[ "codMsgToUser" ] 	= UNEXPECTEDERROR;
				$this -> arStatus[ "affected_rows" ] 	= $this -> link -> affected_rows;
				$this -> arStatus[ "strSQL" ] 			= $this -> query;
			}
			
			$this -> close_connection();	
		}

		protected function execute_transaction() {
			
			$this -> open_connection();
			$this -> link -> query( "START TRANSACTION" );
			
			$this -> link -> query( $this -> queryT1 );
			
			$this -> arStatus[ "codErrorDB" ] = $this -> link -> errno;
			$this -> arStatus[ "desErrorDB" ] = $this -> link -> error;
			
			if ( $this -> arStatus[ "codErrorDB" ] === 0 ) {
				$this -> link -> query( $this -> queryT2 );
				$this -> affected_rows+= $this -> link -> affected_rows;
			
				$this -> arStatus[ "codErrorDB" ] = $this -> link -> errno;
				$this -> arStatus[ "desErrorDB" ] = $this -> link -> error;
				if ( $this -> arStatus[ "codErrorDB" ] === 0 ) {
					$this -> link -> query( "COMMIT" );
					$this -> arStatus[ "codMsgToUser" ] 	= OKQUERY;
				} else {
					$this -> arStatus[ "codMsgToUser" ] 	= "000";
				}
			} else {
				$this -> link -> query( "ROLLBACK" );

			}
			$this -> arStatus[ "num_rows" ] = -1;
			$this -> arStatus[ "strSQL" ] = $this -> queryT1 . " -- " .$this -> queryT2;
			
			$this -> close_connection();
		}

		protected function get_results_from_query() {
			$this -> open_connection();
			unset ( $this -> rows );

			if ( $result = $this -> link -> query( $this -> query ) ) {
				if ( $result -> num_rows !== 0 ) {
					$this -> arStatus[ "codErrorDB" ] 			= $this -> link -> errno;
					$this -> arStatus[ "desErrorDB" ] 			= $this -> link -> error;
					$this -> arStatus[ "codMsgToUser" ] 		= OKQUERY;
					$this -> arStatus[ "num_rows" ] 			= $result -> num_rows;
					
					while ( $this -> rows[] = $result -> fetch_assoc() );
					
					$result -> close();
				} else { 
					$this -> arStatus[ "codErrorDB" ] 			= $this -> link -> errno;
					$this -> arStatus[ "desErrorDB" ] 			= $this -> link -> error;
					$this -> arStatus[ "num_rows" ] 			= $result -> num_rows;
					$this -> arStatus[ "codMsgToUser" ] 		= WITHOUTDATAQUERY;
					$this -> arStatus[ "strSQL" ] 				= $this -> query;
				}
			} else {
				$this -> arStatus[ "codErrorDB" ] 				= $this -> link -> errno;
				$this -> arStatus[ "desErrorDB" ] 				= $this -> link -> error;
				$this -> arStatus[ "strSQL" ] 					= $this -> query;
				$this -> arStatus[ "codMsgToUser" ] 			= UNEXPECTEDERROR;
			}
			
			$this -> close_connection();
			
			if ( isset( $this -> rows ) ) {
				array_pop( $this -> rows );	
			}
		}
	}
?>