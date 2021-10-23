<?php
	class DBcore 
	{
		private static $db_host = 'localhost';		
		private static $db_user = 'root';			
		private static $db_pass = '';				

		private $dsn;
		private $link;								
		private $stmt;
		private $result;

		protected $db_name 	= "";					
		
		protected $query 	= "";						

		
		protected $queryT1 = "";					
		protected $queryT2 = "";					
		
		protected $affected_rows;
		protected $rows = array();					
		
		protected $arStatus = [ 	"codErrorDB"	=> "",
									"desErrorDB"	=> "",
									"num_rows"		=> -1,
									"affected_rows"	=> -1,
									"codMsgToUser"	=> "",
									"strSQL"		=> "" ];
		
		
		private function open_connection() 
		{
			$this -> dsn 	= "mysql:host=localhost;dbname=" . $this -> db_name;
			$this -> link 	= new PDO( $this -> dsn, self::$db_user, self::$db_pass );
		}
		
		
		private function close_connection() 
		{
			$this -> link = null;
		}
		
		
		protected function execute_single_query() 
		{
			$this -> open_connection();
			
			$this -> stmt 	= $this -> link -> prepare( $this -> query );
			$this -> result = $this -> stmt -> execute();

			$this -> affected_rows = $this -> stmt -> rowCount();
			
			$this -> arStatus[ "codErrorDB" ] 	= $this -> link -> errorCode();
			$this -> arStatus[ "desErrorDB" ] 	= $this -> link -> errorInfo();
			
			if ( $this -> arStatus[ "codErrorDB" ] === 0 ) 
			{
				
				$this -> arStatus[ "codMsgToUser" ] 	= OKQUERY;
				$this -> arStatus[ "affected_rows" ] 	= $this -> stmt -> rowCount();
				$this -> arStatus[ "strSQL" ] 			= $this -> query;
			} 
			else 
			{
				
				$this -> arStatus[ "codMsgToUser" ] 	= UNEXPECTEDERROR;
				$this -> arStatus[ "affected_rows" ] 	= $this -> stmt -> rowCount();
				$this -> arStatus[ "strSQL" ] 			= $this -> query;
			}
			
			$this -> close_connection();	
		}

		
		protected function execute_transaction() {
			
			$this -> open_connection();
			
			$this -> query 	= "START TRANSACTION";
			$this -> stmt 	= $this -> link -> prepare( $this -> query );
			$this -> result = $this -> stmt -> execute();
			
			
			$this -> stmt 	= $this -> link -> prepare( $this -> queryT1 );
			$this -> result = $this -> stmt -> execute();

			$this -> affected_rows = $this -> stmt -> rowCount();
			
			$this -> arStatus[ "codErrorDB" ] = $this -> link -> errorCode();
			$this -> arStatus[ "desErrorDB" ] = $this -> link -> errorInfo();
			
			if ( $this -> arStatus[ "codErrorDB" ] === 0 ) 
			{
				$this -> stmt 	= $this -> link -> prepare( $this -> queryT2 );
				$this -> result = $this -> stmt -> execute();

				$this -> affected_rows += $this -> stmt -> rowCount();
			
				$this -> arStatus[ "codErrorDB" ] = $this -> link -> errorCode();
				$this -> arStatus[ "desErrorDB" ] = $this -> link -> errorInfo();

				if ( $this -> arStatus[ "codErrorDB" ] === 0 ) 
				{
					
					$this -> query 						= "COMMIT";
					$this -> stmt 						= $this -> link -> prepare( $this -> query );
					$this -> result 					= $this -> stmt -> execute();
					$this -> arStatus[ "codMsgToUser" ] = OKQUERY;
				} 
				else 
				{
					$this -> arStatus[ "codMsgToUser" ] = "000";
					$this -> query 						= "ROLLBACK";
					$this -> stmt 						= $this -> link -> prepare( $this -> query );
					$this -> result 					= $this -> stmt -> execute();
				}
			} 
			else 
			{
				
				$this -> query 	= "ROLLBACK";
				$this -> stmt 	= $this -> link -> prepare( $this -> query );
				$this -> result = $this -> stmt -> execute();
			}
			$this -> arStatus[ "num_rows" ] = -1;
			$this -> arStatus[ "strSQL" ] 	= $this -> queryT1 . " -- " . $this -> queryT2;
			
			$this -> close_connection();
		}

		
		protected function get_results_from_query() 
		{
			$this -> open_connection();
			
			unset ( $this -> rows );

			$this -> stmt 	= $this -> link -> prepare( $this -> query );
			$this -> stmt -> setFetchMode( PDO::FETCH_ASSOC );
			$this -> result = $this -> stmt -> execute();
			
			if ( $this -> result ) 
			{
				if ( $this -> stmt -> rowCount() !== 0 ) 
				{
					$this -> arStatus[ "codErrorDB" ] 	= $this -> link -> errorCode();
					$this -> arStatus[ "desErrorDB" ] 	= $this -> link -> errorInfo();
					$this -> arStatus[ "codMsgToUser" ] = OKQUERY;
					$this -> arStatus[ "num_rows" ] 	= $this -> stmt -> rowCount();
					
					while ( $this -> rows[] = $this -> stmt -> fetch() );
					
				} 
				else 
				{ 
					$this -> arStatus[ "codErrorDB" ] 	= $this -> link -> errorCode();
					$this -> arStatus[ "desErrorDB" ] 	= $this -> link -> errorInfo();
					$this -> arStatus[ "num_rows" ] 	= $this -> stmt -> rowCount();
					$this -> arStatus[ "codMsgToUser" ] = WITHOUTDATAQUERY;
					$this -> arStatus[ "strSQL" ] 		= $this -> query;
				}
			} 
			else 
			{
				$this -> arStatus[ "codErrorDB" ] 	= $this -> link -> errorCode();
				$this -> arStatus[ "desErrorDB" ] 	= $this -> link -> errorInfo();
				$this -> arStatus[ "strSQL" ] 		= $this -> query;
				$this -> arStatus[ "codMsgToUser" ] = UNEXPECTEDERROR;
			}
			
			$this -> close_connection();
			
			
			if ( isset( $this -> rows ) ) 
			{
				array_pop( $this -> rows );	
			}
		}
	}
?>