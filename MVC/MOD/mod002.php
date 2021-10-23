
<?php

	require( "mod001.php" );
	
	/* mod002_obtenerDecanos
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de la tabla 1000DECANOS, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado",  "datos",  que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerDecanos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerDecanos()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 1000iddecano, 1000dnidecano, 1000nomdecano, 1000apellidosdecano, 1000direcciondecano, 1000telefonodecano, 1000correodecano";
		$consulta .= " FROM 1000DECANOS";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "iddecano" ] = $fila[ "1000iddecano" ];
					$arRetorno[ "datos" ][ $i ][ "dnidecano" ] = $fila[ "1000dnidecano" ];
					$arRetorno[ "datos" ][ $i ][ "nomdecano" ] = $fila[ "1000nomdecano" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosdecano" ] = $fila[ "1000apellidosdecano" ];
					$arRetorno[ "datos" ][ $i ][ "direcciondecano" ] = $fila[ "1000direcciondecano" ];
					$arRetorno[ "datos" ][ $i ][ "telefonodecano" ] = $fila[ "1000telefonodecano" ];
					$arRetorno[ "datos" ][ $i ][ "correodecano" ] = $fila[ "1000correodecano" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerDecanosFacultad
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de las tablas 1000DECANOS, 2000FACULTADES Y 1100DECANOFACULTAD, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerDecanosFacultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerDecanosFacultad()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 1000DECANOS.1000iddecano, 2000FACULTADES.2000idfacultad, `1000nomdecano`, `1000apellidosdecano`, `2000nomfacultad`, `1100fecdecano`, `1100salariodecano`";
		$consulta .= " FROM `1000DECANOS`";
		$consulta .= " INNER JOIN `1100DECANOFACULTAD`";
		$consulta .= " ON 1000DECANOS.1000iddecano = 1100DECANOFACULTAD.1000iddecano";
		$consulta .= " INNER JOIN `2000FACULTADES`";
		$consulta .= " ON 1100DECANOFACULTAD.2000idfacultad = 2000FACULTADES.2000idfacultad";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "iddecano" ] = $fila[ "1000iddecano" ];
					$arRetorno[ "datos" ][ $i ][ "idfacultad" ] = $fila[ "2000idfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "nomdecano" ] = $fila[ "1000nomdecano" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosdecano" ] = $fila[ "1000apellidosdecano" ];
					$arRetorno[ "datos" ][ $i ][ "nomfacultad" ] = $fila[ "2000nomfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "fecdecano" ] = $fila[ "1100fecdecano" ];
					$arRetorno[ "datos" ][ $i ][ "salariodecano" ] = $fila[ "1100salariodecano" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerSumaSalariosDecanosFacultad
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener de la tabla 1100DECANOFACULTAD la suma de salarios mediante la función SUM, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerSumaSalariosDecanosFacultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerSumaSalariosDecanosFacultad()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT SUM( 1100salariodecano ) AS sumasalarios";
		$consulta .= " FROM `1100DECANOFACULTAD`";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "sumasalarios" ] = $fila[ "sumasalarios" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerFacultades
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de la tabla 2000FACULTADES, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerFacultades
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerFacultades()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 2000idfacultad, 2000nomfacultad, 2000direccionfacultad";
		$consulta .= " FROM 2000FACULTADES";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idfacultad" ] = $fila[ "2000idfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "nomfacultad" ] = $fila[ "2000nomfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "direccionfacultad" ] = $fila[ "2000direccionfacultad" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerCarreras
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de la tabla 2100CARRERAS correspondiente a un determinado id de facultad, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$idfacultad							: Es la variable que contiene el código identificativo de la facultad de la que deseamos obtener la información.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerCarreras
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerCarreras( $idfacultad )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 2100idcarrera, 2100nomcarrera";
		$consulta .= " FROM 2100CARRERAS";
		$consulta .= " WHERE 2000idfacultad = $idfacultad";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idcarrera" ] = $fila[ "2100idcarrera" ];
					$arRetorno[ "datos" ][ $i ][ "nomcarrera" ] = $fila[ "2100nomcarrera" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerAsignaturas
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de las tablas 2120ASIGNATURAS, 5000CREDITOS y 4000CURSOS correspondiente a un determinado id de carrera, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$idcarrera							: Es la variable que contiene el código identificativo de la carrera de la que deseamos obtener la información.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			 mod003_obtenerAsignaturas
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerAsignaturas( $idcarrera )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 2120nomasignatura, 4000nomcurso, 5000numcreditos, 2120bvigencia";
		$consulta .= " FROM 2120ASIGNATURAS";
		$consulta .= " INNER JOIN 5000CREDITOS";
		$consulta .= " ON 2120ASIGNATURAS.5000idcreditos = 5000CREDITOS.5000idcreditos";
		$consulta .= " INNER JOIN 4000CURSOS";
		$consulta .= " ON 2120ASIGNATURAS.4000idcurso = 4000CURSOS.4000idcurso";
		$consulta .= " WHERE 2100idcarrera = $idcarrera";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "nomasignatura" ] = $fila[ "2120nomasignatura" ];
					$arRetorno[ "datos" ][ $i ][ "nomcurso" ] = $fila[ "4000nomcurso" ];
					$arRetorno[ "datos" ][ $i ][ "idcreditos" ] = $fila[ "5000numcreditos" ];
					$arRetorno[ "datos" ][ $i ][ "vigencia" ] = $fila[ "2120bvigencia" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerDescripcionImagen_Facultad
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de la tabla 2000FACULTADES correspondiente a un determinado id de facultad, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$idfacultad							: Es la variable que contiene el código identificativo de la facultad de la que deseamos obtener la información.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerDescripcionImagen_Facultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerDescripcionImagen_Facultad( $idfacultad )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 2000descripcionfacultad, 2000nomficherofotofacultad";
		$consulta .= " FROM 2000FACULTADES";
		$consulta .= " WHERE 2000idfacultad = $idfacultad";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "descripcionfacultad" ] = $fila[ "2000descripcionfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "nomficherofotofacultad" ] = $fila[ "2000nomficherofotofacultad" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerDescripcionImagen_Carrera
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de la tabla 21000CARRERAS correspondiente a un determinado id de carrera, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$idcarrera							: Es la variable que contiene el código identificativo de la carrera de la que deseamos obtener la información.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerDescripcionImagen_Carrera
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerDescripcionImagen_Carrera( $idcarrera )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 2100descripcioncarrera, 2100nomficherofotocarrera";
		$consulta .= " FROM 2100CARRERAS";
		$consulta .= " WHERE 2100idcarrera = $idcarrera";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "descripcioncarrera" ] = $fila[ "2100descripcioncarrera" ];
					$arRetorno[ "datos" ][ $i ][ "nomficherofotocarrera" ] = $fila[ "2100nomficherofotocarrera" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerAlumnos
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de la tabla 3000ALUMNOS, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.						
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerAlumnos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerAlumnos()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 3000idalumno, 3000dnialumno, 3000nomalumno, 3000apellidosalumno, 3000direccionalumno, 3000telefonoalumno, 3000correoalumno";
		$consulta .= " FROM 3000ALUMNOS";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idalumno" ] = $fila[ "3000idalumno" ];
					$arRetorno[ "datos" ][ $i ][ "dnialumno" ] = $fila[ "3000dnialumno" ];
					$arRetorno[ "datos" ][ $i ][ "nomalumno" ] = $fila[ "3000nomalumno" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosalumno" ] = $fila[ "3000apellidosalumno" ];
					$arRetorno[ "datos" ][ $i ][ "direccionalumno" ] = $fila[ "3000direccionalumno" ];
					$arRetorno[ "datos" ][ $i ][ "telefonoalumno" ] = $fila[ "3000telefonoalumno" ];
					$arRetorno[ "datos" ][ $i ][ "correoalumno" ] = $fila[ "3000correoalumno" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerProfesores
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de la tabla 7000PROFESORES, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.						
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerProfesores
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerProfesores()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 7000idprofesor, 7000dniprofesor, 7000nomprofesor, 7000apellidosprofesor, 7000direccionprofesor, 7000telefonoprofesor, 7000correoprofesor";
		$consulta .= " FROM 7000PROFESORES";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idprofesor" ] = $fila[ "7000idprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "dniprofesor" ] = $fila[ "7000dniprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "nomprofesor" ] = $fila[ "7000nomprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosprofesor" ] = $fila[ "7000apellidosprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "direccionprofesor" ] = $fila[ "7000direccionprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "telefonoprofesor" ] = $fila[ "7000telefonoprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "correoprofesor" ] = $fila[ "7000correoprofesor" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	// Inicio Funciones Fotos
	
	/* mod002_obtenerFotosDecanos
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la imagen de la tabla 1000DECANOS correspondiente a un determinado id, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$iddecano							: Es la variable que contiene el código identificativo del decano del que deseamos obtener la información.						
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerFotosDecanos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerFotosDecanos( $iddecano )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 1000nomficherofotodecano";
		$consulta .= " FROM 1000DECANOS";
		$consulta .= " WHERE 1000iddecano = $iddecano";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "iddecano" ] = $iddecano;
					$arRetorno[ "datos" ][ $i ][ "nomficherofotodecano" ] = $fila[ "1000nomficherofotodecano" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerFotosAlumnos
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la imagen de la tabla 3000ALUMNOS correspondiente a un determinado id, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$idalumno							: Es la variable que contiene el código identificativo del alumno del que deseamos obtener la información.						
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerFotosAlumnos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerFotosAlumnos( $idalumno )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 3000nomficherofotoalumno";
		$consulta .= " FROM 3000ALUMNOS";
		$consulta .= " WHERE 3000idalumno = $idalumno";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idalumno" ] = $idalumno;
					$arRetorno[ "datos" ][ $i ][ "nomficherofotoalumno" ] = $fila[ "3000nomficherofotoalumno" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerFotosProfesores
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la imagen de la tabla 7000PROFESORES correspondiente a un determinado id, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$idprofesor							: Es la variable que contiene el código identificativo del profesor del que deseamos obtener la información.						
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerFotosProfesores
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerFotosProfesores( $idprofesor )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 7000nomficherofotoprofesor";
		$consulta .= " FROM 7000PROFESORES";
		$consulta .= " WHERE 7000idprofesor = $idprofesor";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idprofesor" ] = $idprofesor;
					$arRetorno[ "datos" ][ $i ][ "nomficherofotoprofesor" ] = $fila[ "7000nomficherofotoprofesor" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	// Fin Funciones Fotos
	
	// Inicio Funciones Paginacion
	
	/* mod002_obtenerDecanosPaginacion
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener un número determinado de registros ( $numRegistros ) partiendo de un registro inicial ( $registroInicio ) de la tabla 1000DECANOS, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$registroInicio						: Es la variable que contiene el número de registro desde el cuál partiremos.
			$numRegistros						: Es la variable que contiene el número de registros que queremos obtener de la tabla.			
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerDecanosPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerDecanosPaginacion( $registroInicio, $numRegistros )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 1000iddecano, 1000dnidecano, 1000nomdecano, 1000apellidosdecano, 1000direcciondecano, 1000telefonodecano, 1000correodecano";
		$consulta .= " FROM 1000DECANOS";
		$consulta .= " LIMIT $registroInicio, $numRegistros";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "iddecano" ] = $fila[ "1000iddecano" ];
					$arRetorno[ "datos" ][ $i ][ "dnidecano" ] = $fila[ "1000dnidecano" ];
					$arRetorno[ "datos" ][ $i ][ "nomdecano" ] = $fila[ "1000nomdecano" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosdecano" ] = $fila[ "1000apellidosdecano" ];
					$arRetorno[ "datos" ][ $i ][ "direcciondecano" ] = $fila[ "1000direcciondecano" ];
					$arRetorno[ "datos" ][ $i ][ "telefonodecano" ] = $fila[ "1000telefonodecano" ];
					$arRetorno[ "datos" ][ $i ][ "correodecano" ] = $fila[ "1000correodecano" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerDecanosTotales
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener el número total de registros de la tabla 1000DECANOS, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.		
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerDecanosTotales
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerDecanosTotales()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT COUNT( * ) AS numtotaldecanos";
		$consulta .= " FROM 1000DECANOS";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "numtotaldecanos" ] = $fila[ "numtotaldecanos" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerAlumnosPaginacion
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener un número determinado de registros ( $numRegistros ) partiendo de un registro inicial ( $registroInicio ) de la tabla 3000ALUMNOS, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$registroInicio						: Es la variable que contiene el número de registro desde el cuál partiremos.
			$numRegistros						: Es la variable que contiene el número de registros que queremos obtener de la tabla.			
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerAlumnosPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerAlumnosPaginacion( $registroInicio, $numRegistros )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 3000idalumno, 3000dnialumno, 3000nomalumno, 3000apellidosalumno, 3000direccionalumno, 3000telefonoalumno, 3000correoalumno";
		$consulta .= " FROM 3000ALUMNOS";
		$consulta .= " LIMIT $registroInicio, $numRegistros";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idalumno" ] = $fila[ "3000idalumno" ];
					$arRetorno[ "datos" ][ $i ][ "dnialumno" ] = $fila[ "3000dnialumno" ];
					$arRetorno[ "datos" ][ $i ][ "nomalumno" ] = $fila[ "3000nomalumno" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosalumno" ] = $fila[ "3000apellidosalumno" ];
					$arRetorno[ "datos" ][ $i ][ "direccionalumno" ] = $fila[ "3000direccionalumno" ];
					$arRetorno[ "datos" ][ $i ][ "telefonoalumno" ] = $fila[ "3000telefonoalumno" ];
					$arRetorno[ "datos" ][ $i ][ "correoalumno" ] = $fila[ "3000correoalumno" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerAlumnosTotales
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener el número total de registros de la tabla 3000ALUMNOS, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.		
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerAlumnosTotales
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerAlumnosTotales()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT COUNT( * ) AS numtotalalumnos";
		$consulta .= " FROM 3000ALUMNOS";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "numtotalalumnos" ] = $fila[ "numtotalalumnos" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerDecanosFacultadPaginacion
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener un número determinado de registros ( $numRegistros ) partiendo de un registro inicial ( $registroInicio ) de las tablas 1000DECANOS, 1100DECANOFACULTAD y 2000FACULTADES, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$registroInicio						: Es la variable que contiene el número de registro desde el cuál partiremos.
			$numRegistros						: Es la variable que contiene el número de registros que queremos obtener de la tabla.			
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerDecanosFacultadPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerDecanosFacultadPaginacion( $registroInicio, $numRegistros )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 1000DECANOS.1000iddecano, 2000FACULTADES.2000idfacultad, `1000nomdecano`, `1000apellidosdecano`, `2000nomfacultad`, `1100fecdecano`, `1100salariodecano`";
		$consulta .= " FROM `1000DECANOS`";
		$consulta .= " INNER JOIN `1100DECANOFACULTAD`";
		$consulta .= " ON 1000DECANOS.1000iddecano = 1100DECANOFACULTAD.1000iddecano";
		$consulta .= " INNER JOIN `2000FACULTADES`";
		$consulta .= " ON 1100DECANOFACULTAD.2000idfacultad = 2000FACULTADES.2000idfacultad";
		$consulta .= " LIMIT $registroInicio, $numRegistros";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "iddecano" ] = $fila[ "1000iddecano" ];
					$arRetorno[ "datos" ][ $i ][ "idfacultad" ] = $fila[ "2000idfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "nomdecano" ] = $fila[ "1000nomdecano" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosdecano" ] = $fila[ "1000apellidosdecano" ];
					$arRetorno[ "datos" ][ $i ][ "nomfacultad" ] = $fila[ "2000nomfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "fecdecano" ] = $fila[ "1100fecdecano" ];
					$arRetorno[ "datos" ][ $i ][ "salariodecano" ] = $fila[ "1100salariodecano" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerDecanosFacultadTotales
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener el número total de registros de la tabla 1100DECANOFACULTAD, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.		
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerDecanosFacultadTotales
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerDecanosFacultadTotales()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT COUNT( * ) AS numtotaldecanosfacultad";
		$consulta .= " FROM 1100DECANOFACULTAD";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "numtotaldecanosfacultad" ] = $fila[ "numtotaldecanosfacultad" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerProfesoresPaginacion
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener un número determinado de registros ( $numRegistros ) partiendo de un registro inicial ( $registroInicio ) de la tabla 7000PROFESORES, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$registroInicio						: Es la variable que contiene el número de registro desde el cuál partiremos.
			$numRegistros						: Es la variable que contiene el número de registros que queremos obtener de la tabla.			
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerProfesoresPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerProfesoresPaginacion( $registroInicio, $numRegistros )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 7000idprofesor, 7000dniprofesor, 7000nomprofesor, 7000apellidosprofesor, 7000direccionprofesor, 7000telefonoprofesor, 7000correoprofesor";
		$consulta .= " FROM 7000PROFESORES";
		$consulta .= " LIMIT $registroInicio, $numRegistros";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idprofesor" ] = $fila[ "7000idprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "dniprofesor" ] = $fila[ "7000dniprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "nomprofesor" ] = $fila[ "7000nomprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosprofesor" ] = $fila[ "7000apellidosprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "direccionprofesor" ] = $fila[ "7000direccionprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "telefonoprofesor" ] = $fila[ "7000telefonoprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "correoprofesor" ] = $fila[ "7000correoprofesor" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_obtenerProfesoresTotales
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener el número total de registros de la tabla 7000PROFESORES, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			Sin argumentos.		
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_obtenerProfesoresTotales
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_obtenerProfesoresTotales()
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT COUNT( * ) AS numtotalprofesores";
		$consulta .= " FROM 7000PROFESORES";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "numtotalprofesores" ] = $fila[ "numtotalprofesores" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	// Fin Funciones Paginacion
	
	// Inicio Funciones Inserciones
	
	/* mod002_insertarAlumno
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para insertar un nuevo registro en la tabla 3000ALUMNOS, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$dnialumno							: Es la variable que contiene el dni del alumno que queremos introducir.
			$nombrealumno						: Es la variable que contiene el nombre del alumno que queremos introducir.
			$apellidosalumno					: Es la variable que contiene los apellidos del alumno que queremos introducir.
			$direccionalumno					: Es la variable que contiene la direccion del alumno que queremos introducir.
			$telefonoalumno						: Es la variable que contiene el telefono del alumno que queremos introducir.
			$correoalumno						: Es la variable que contiene el correo del alumno que queremos introducir.
			$imagenalumno						: Es la variable que contiene la imagen del alumno que queremos introducir.
		-- Variables principales --             
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_insertarAlumno
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_insertarAlumno( $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno ) 
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "INSERT INTO `3000ALUMNOS`";
		$consulta .= " ( 3000idalumno, 3000dnialumno, 3000nomalumno, 3000apellidosalumno, 3000direccionalumno, 3000telefonoalumno, 3000correoalumno, 3000nomficherofotoalumno )";
		$consulta .= " VALUES";
		$consulta .= " ( null, '$dnialumno', '$nombrealumno', '$apellidosalumno', '$direccionalumno', '$telefonoalumno', '$correoalumno', '$imagenalumno' )";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				$arRetorno[ "datos" ][ 0 ][ "idAlumnoNuevo" ] = mysqli_insert_id( $conexion );
				
			} 
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_insertarProfesor
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para insertar un nuevo registro en la tabla 7000PROFESORES, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$dniprofesor						: Es la variable que contiene el dni del profesor que queremos introducir.
			$nombreprofesor						: Es la variable que contiene el nombre del profesor que queremos introducir.
			$apellidosprofesor					: Es la variable que contiene los apellidos del profesor que queremos introducir.
			$direccionprofesor					: Es la variable que contiene la direccion del profesor que queremos introducir.
			$telefonoprofesor					: Es la variable que contiene el telefono del profesor que queremos introducir.
			$correoprofesor						: Es la variable que contiene el correo del profesor que queremos introducir.
			$imagenprofesor						: Es la variable que contiene la imagen del profesor que queremos introducir.
		-- Variables principales --             
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_insertarProfesor
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_insertarProfesor( $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor ) 
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "INSERT INTO `7000PROFESORES`";
		$consulta .= " ( 7000idprofesor, 7000dniprofesor, 7000nomprofesor, 7000apellidosprofesor, 7000direccionprofesor, 7000telefonoprofesor, 7000correoprofesor, 7000nomficherofotoprofesor )";
		$consulta .= " VALUES";
		$consulta .= " ( null, '$dniprofesor', '$nombreprofesor', '$apellidosprofesor', '$direccionprofesor', '$telefonoprofesor', '$correoprofesor', '$imagenprofesor' )";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				$arRetorno[ "datos" ][ 0 ][ "idProfesorNuevo" ] = mysqli_insert_id( $conexion );
				
			} 
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_insertarDecano
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para insertar un nuevo registro en la tabla 1000DECANOS, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$dnidecano							: Es la variable que contiene el dni del decano que queremos introducir.
			$nombredecano						: Es la variable que contiene el nombre del decano que queremos introducir.
			$apellidosdecano					: Es la variable que contiene los apellidos del decano que queremos introducir.
			$direcciondecano					: Es la variable que contiene la direccion del decano que queremos introducir.
			$telefonodecano						: Es la variable que contiene el telefono del decano que queremos introducir.
			$correodecano						: Es la variable que contiene el correo del decano que queremos introducir.
			$imagendecano						: Es la variable que contiene la imagen del decano que queremos introducir.
		-- Variables principales --             
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_insertarDecano
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_insertarDecano( $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano ) 
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "INSERT INTO `1000DECANOS`";
		$consulta .= " ( 1000iddecano, 1000dnidecano, 1000nomdecano, 1000apellidosdecano, 1000direcciondecano, 1000telefonodecano, 1000correodecano, 1000nomficherofotodecano )";
		$consulta .= " VALUES";
		$consulta .= " ( null, '$dnidecano', '$nombredecano', '$apellidosdecano', '$direcciondecano', '$telefonodecano', '$correodecano', '$imagendecano' )";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				$arRetorno[ "datos" ][ 0 ][ "idDecanoNuevo" ] = mysqli_insert_id( $conexion );
				
			} 
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	// Fin Funciones Inserciones
	
	// Inicio Funciones Ediciones
	
	/* mod002_editarAlumno
	
		-- Descripcion larga --
			Realiza una transacción sobre la base de datos para actualizar un registro de la tabla 3000ALUMNOS, primero actualizamos los campos dni, nombre, apellidos, dirección, teléfono y correo, si la consulta tiene éxito entonces actualizamos el campo imagen, de lo contrario deshacemos la consulta. Si las consultas devuelven resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$idalumno							: Es la variable que contiene el id del alumno que queremos actualizar.
			$dnialumno							: Es la variable que contiene el dni del alumno que queremos actualizar.
			$nombrealumno						: Es la variable que contiene el nombre del alumno que queremos actualizar.
			$apellidosalumno					: Es la variable que contiene los apellidos del alumno que queremos actualizar.
			$direccionalumno					: Es la variable que contiene la direccion del alumno que queremos actualizar.
			$telefonoalumno						: Es la variable que contiene el telefono del alumno que queremos actualizar.
			$correoalumno						: Es la variable que contiene el correo del alumno que queremos actualizar.
			$imagenalumno						: Es la variable que contiene la imagen del alumno que queremos actualizar.
		-- Variables principales --             
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_editarAlumno
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_editarAlumno( $idalumno, $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno )
	{
		
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "START TRANSACTION";
		$resultado = mysqli_query( $conexion, $consulta );
		
		$consulta = "UPDATE `3000ALUMNOS` SET
							3000dnialumno = '$dnialumno',
							3000nomalumno = '$nombrealumno',
							3000apellidosalumno = '$apellidosalumno',
							3000direccionalumno = '$direccionalumno',
							3000telefonoalumno = '$telefonoalumno',
							3000correoalumno = '$correoalumno'
						    WHERE 3000idalumno = $idalumno";
							
		$resultado = mysqli_query( $conexion, $consulta );
		
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
			$arRetorno[ "estado" ][ "consulta" ] = $consulta; 
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 ) 
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
			} 
			else 
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
			
			$consulta = "UPDATE `3000ALUMNOS` SET
							3000nomficherofotoalumno = '$imagenalumno'
							WHERE 3000idalumno = $idalumno";
						   
			$resultado = mysqli_query( $conexion, $consulta );
			
			if ( $resultado ) 
			{
				$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;  
				if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 ) 
				{
					$arRetorno[ "estado" ][ "codError" ] = "000";
				} 
				else 
				{
					$arRetorno[ "estado" ][ "codError" ] = "001";
					$arRetorno[ "estado" ][ "consulta" ] = $consulta;
				}
				
				$consulta = "COMMIT";
				$resultado = mysqli_query( $conexion, $consulta );

			} 
			else 
			{
				$arRetorno[ "estado" ][ "codError" ] = "002";
				$arRetorno[ "estado" ][ "codError" ] = $consulta;
				$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
				$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
				
				$consulta = "ROLLBACK";
				$resultado = mysqli_query( $conexion, $consulta );
			}
		}
		else 
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "codError" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
			
			$consulta = "ROLLBACK";
			$resultado = mysqli_query( $conexion, $consulta );
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;					
	}
	
	/* mod002_editarProfesor
	
		-- Descripcion larga --
			Realiza una transacción sobre la base de datos para actualizar un registro de la tabla 7000PROFESORES, primero actualizamos los campos dni, nombre, apellidos, dirección, teléfono y correo, si la consulta tiene éxito entonces actualizamos el campo imagen, de lo contrario deshacemos la consulta. Si las consultas devuelven resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$idprofesor							: Es la variable que contiene el id del profesor que queremos actualizar.
			$dniprofesor						: Es la variable que contiene el dni del profesor que queremos actualizar.
			$nombreprofesor						: Es la variable que contiene el nombre del profesor que queremos actualizar.
			$apellidosprofesor					: Es la variable que contiene los apellidos del profesor que queremos actualizar.
			$direccionprofesor					: Es la variable que contiene la direccion del profesor que queremos actualizar.
			$telefonoprofesor					: Es la variable que contiene el telefono del profesor que queremos actualizar.
			$correoprofesor						: Es la variable que contiene el correo del profesor que queremos actualizar.
			$imagenprofesor						: Es la variable que contiene la imagen del profesor que queremos actualizar.
		-- Variables principales --             
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_editarProfesor
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_editarProfesor( $idprofesor, $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor )
	{
		
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "START TRANSACTION";
		$resultado = mysqli_query( $conexion, $consulta );
		
		$consulta = "UPDATE `7000PROFESORES` SET
							7000dniprofesor = '$dniprofesor',
							7000nomprofesor = '$nombreprofesor',
							7000apellidosprofesor = '$apellidosprofesor',
							7000direccionprofesor = '$direccionprofesor',
							7000telefonoprofesor = '$telefonoprofesor',
							7000correoprofesor = '$correoprofesor'
						    WHERE 7000idprofesor = $idprofesor";
							
		$resultado = mysqli_query( $conexion, $consulta );
		
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
			$arRetorno[ "estado" ][ "consulta" ] = $consulta; 
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 ) 
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
			} 
			else 
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
			
			$consulta = "UPDATE `7000PROFESORES` SET
							7000nomficherofotoprofesor = '$imagenprofesor'
							WHERE 7000idprofesor = $idprofesor";
						   
			$resultado = mysqli_query( $conexion, $consulta );
			
			if ( $resultado ) 
			{
				$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;  
				if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 ) 
				{
					$arRetorno[ "estado" ][ "codError" ] = "000";
				} 
				else 
				{
					$arRetorno[ "estado" ][ "codError" ] = "001";
					$arRetorno[ "estado" ][ "consulta" ] = $consulta;
				}
				
				$consulta = "COMMIT";
				$resultado = mysqli_query( $conexion, $consulta );

			} 
			else 
			{
				$arRetorno[ "estado" ][ "codError" ] = "002";
				$arRetorno[ "estado" ][ "codError" ] = $consulta;
				$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
				$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
				
				$consulta = "ROLLBACK";
				$resultado = mysqli_query( $conexion, $consulta );
			}
		}
		else 
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "codError" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
			
			$consulta = "ROLLBACK";
			$resultado = mysqli_query( $conexion, $consulta );
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;					
	}
	
	/* mod002_editarDecano
	
		-- Descripcion larga --
			Realiza una transacción sobre la base de datos para actualizar un registro de la tabla 10000DECANOS, primero actualizamos los campos dni, nombre, apellidos, dirección, teléfono y correo, si la consulta tiene éxito entonces actualizamos el campo imagen, de lo contrario deshacemos la consulta. Si las consultas devuelven resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$iddecano							: Es la variable que contiene el id del decano que queremos actualizar.
			$dnidecano							: Es la variable que contiene el dni del decano que queremos actualizar.
			$nombredecano						: Es la variable que contiene el nombre del decano que queremos actualizar.
			$apellidosdecano					: Es la variable que contiene los apellidos del decano que queremos actualizar.
			$direcciondecano					: Es la variable que contiene la direccion del decano que queremos actualizar.
			$telefonodecano						: Es la variable que contiene el telefono del decano que queremos actualizar.
			$correodecano						: Es la variable que contiene el correo del decano que queremos actualizar.
			$imagendecano						: Es la variable que contiene la imagen del decano que queremos actualizar.
		-- Variables principales --             
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_editarDecano
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_editarDecano( $iddecano, $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano )
	{
		
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "START TRANSACTION";
		$resultado = mysqli_query( $conexion, $consulta );
		
		$consulta = "UPDATE `1000DECANOS` SET
							1000dnidecano = '$dnidecano',
							1000nomdecano = '$nombredecano',
							1000apellidosdecano = '$apellidosdecano',
							1000direcciondecano = '$direcciondecano',
							1000telefonodecano = '$telefonodecano',
							1000correodecano = '$correodecano'
						    WHERE 1000iddecano = $iddecano";
							
		$resultado = mysqli_query( $conexion, $consulta );
		
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
			$arRetorno[ "estado" ][ "consulta" ] = $consulta; 
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 ) 
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
			} 
			else 
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
			
			$consulta = "UPDATE `1000DECANOS` SET
							1000nomficherofotodecano = '$imagendecano'
							WHERE 1000iddecano = $iddecano";
						   
			$resultado = mysqli_query( $conexion, $consulta );
			
			if ( $resultado ) 
			{
				$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;  
				if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 ) 
				{
					$arRetorno[ "estado" ][ "codError" ] = "000";
				} 
				else 
				{
					$arRetorno[ "estado" ][ "codError" ] = "001";
					$arRetorno[ "estado" ][ "consulta" ] = $consulta;
				}
				
				$consulta = "COMMIT";
				$resultado = mysqli_query( $conexion, $consulta );

			} 
			else 
			{
				$arRetorno[ "estado" ][ "codError" ] = "002";
				$arRetorno[ "estado" ][ "codError" ] = $consulta;
				$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
				$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
				
				$consulta = "ROLLBACK";
				$resultado = mysqli_query( $conexion, $consulta );
			}
		}
		else 
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "codError" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
			
			$consulta = "ROLLBACK";
			$resultado = mysqli_query( $conexion, $consulta );
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;					
	}
	
	// Fin Funciones Ediciones
	
	// Inicio Funciones Búsqueda
	
	/* mod002_buscarAlumno
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos en la tabla 3000ALUMNOS para obtener aquellos registros en los que alguno de sus campos coincida con el argumento de entrada $busqueda, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_buscarAlumno
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_buscarAlumno( $busqueda )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 3000dnialumno, 3000nomalumno, 3000apellidosalumno, 3000direccionalumno, 3000telefonoalumno, 3000correoalumno, 3000nomficherofotoalumno";
		$consulta .= " FROM 3000ALUMNOS";
		$consulta .= " WHERE (";
		$consulta .= " 3000dnialumno LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 3000nomalumno LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 3000apellidosalumno LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 3000direccionalumno LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 3000telefonoalumno LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 3000correoalumno LIKE '%" . $busqueda . "%'";
		$consulta .= ");";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "dnialumno" ] = $fila[ "3000dnialumno" ];
					$arRetorno[ "datos" ][ $i ][ "nomalumno" ] = $fila[ "3000nomalumno" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosalumno" ] = $fila[ "3000apellidosalumno" ];
					$arRetorno[ "datos" ][ $i ][ "direccionalumno" ] = $fila[ "3000direccionalumno" ];
					$arRetorno[ "datos" ][ $i ][ "telefonoalumno" ] = $fila[ "3000telefonoalumno" ];
					$arRetorno[ "datos" ][ $i ][ "correoalumno" ] = $fila[ "3000correoalumno" ];
					$arRetorno[ "datos" ][ $i ][ "nomficherofotoalumno" ] = $fila[ "3000nomficherofotoalumno" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_buscarProfesor
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos en la tabla 7000PROFESORES para obtener aquellos registros en los que alguno de sus campos coincida con el argumento de entrada $busqueda, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_buscarProfesor
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_buscarProfesor( $busqueda )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 7000dniprofesor, 7000nomprofesor, 7000apellidosprofesor, 7000direccionprofesor, 7000telefonoprofesor, 7000correoprofesor, 7000nomficherofotoprofesor";
		$consulta .= " FROM 7000PROFESORES";
		$consulta .= " WHERE (";
		$consulta .= " 7000dniprofesor LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 7000nomprofesor LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 7000apellidosprofesor LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 7000direccionprofesor LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 7000telefonoprofesor LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 7000correoprofesor LIKE '%" . $busqueda . "%'";
		$consulta .= ");";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "dniprofesor" ] = $fila[ "7000dniprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "nomprofesor" ] = $fila[ "7000nomprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosprofesor" ] = $fila[ "7000apellidosprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "direccionprofesor" ] = $fila[ "7000direccionprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "telefonoprofesor" ] = $fila[ "7000telefonoprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "correoprofesor" ] = $fila[ "7000correoprofesor" ];
					$arRetorno[ "datos" ][ $i ][ "nomficherofotoprofesor" ] = $fila[ "7000nomficherofotoprofesor" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_buscarDecano
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos en la tabla 1000DECANOS para obtener aquellos registros en los que alguno de sus campos coincida con el argumento de entrada $busqueda, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_buscarDecano
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_buscarDecano( $busqueda )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 1000dnidecano, 1000nomdecano, 1000apellidosdecano, 1000direcciondecano, 1000telefonodecano, 1000correodecano, 1000nomficherofotodecano";
		$consulta .= " FROM 1000DECANOS";
		$consulta .= " WHERE (";
		$consulta .= " 1000dnidecano LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 1000nomdecano LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 1000apellidosdecano LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 1000direcciondecano LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 1000telefonodecano LIKE '%" . $busqueda . "%' OR ";
		$consulta .= " 1000correodecano LIKE '%" . $busqueda . "%'";
		$consulta .= ");";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "dnidecano" ] = $fila[ "1000dnidecano" ];
					$arRetorno[ "datos" ][ $i ][ "nomdecano" ] = $fila[ "1000nomdecano" ];
					$arRetorno[ "datos" ][ $i ][ "apellidosdecano" ] = $fila[ "1000apellidosdecano" ];
					$arRetorno[ "datos" ][ $i ][ "direcciondecano" ] = $fila[ "1000direcciondecano" ];
					$arRetorno[ "datos" ][ $i ][ "telefonodecano" ] = $fila[ "1000telefonodecano" ];
					$arRetorno[ "datos" ][ $i ][ "correodecano" ] = $fila[ "1000correodecano" ];
					$arRetorno[ "datos" ][ $i ][ "nomficherofotodecano" ] = $fila[ "1000nomficherofotodecano" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_buscarFacultad
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos en la tabla 2000FACULTADES para obtener aquellos registros en los que alguno de sus campos coincida con el argumento de entrada $busqueda, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_buscarFacultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_buscarFacultad( $busqueda )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 2000idfacultad, 2000nomfacultad, 2000direccionfacultad, 2000nomficherofotofacultad";
		$consulta .= " FROM 2000FACULTADES";
		$consulta .= " WHERE (";
		$consulta .= " 2000nomfacultad LIKE '%" . $busqueda . "%'";
		$consulta .= ");";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idfacultad" ] = $fila[ "2000idfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "nomfacultad" ] = $fila[ "2000nomfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "direccionfacultad" ] = $fila[ "2000direccionfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "nomficherofotofacultad" ] = $fila[ "2000nomficherofotofacultad" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_buscarCarrera
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos en la tabla 2100CARRERAS para obtener aquellos registros en los que alguno de sus campos coincida con el argumento de entrada $busqueda, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_buscarCarrera
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_buscarCarrera( $busqueda )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 2100idcarrera, 2000idfacultad, 2100nomcarrera, 2100nomficherofotocarrera";
		$consulta .= " FROM 2100CARRERAS";
		$consulta .= " WHERE (";
		$consulta .= " 2100nomcarrera LIKE '%" . $busqueda . "%'";
		$consulta .= ");";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idcarrera" ] = $fila[ "2100idcarrera" ];
					$arRetorno[ "datos" ][ $i ][ "idfacultad" ] = $fila[ "2000idfacultad" ];
					$arRetorno[ "datos" ][ $i ][ "nomcarrera" ] = $fila[ "2100nomcarrera" ];
					$arRetorno[ "datos" ][ $i ][ "nomficherofotocarrera" ] = $fila[ "2100nomficherofotocarrera" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_buscarAsignatura
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos en las tablas 2120ASIGNATURAS, 5000CREDITOS, 4000CURSOS y 2100CARRERAS para obtener aquellos registros en los que alguno de sus campos coincida ( en la tabla 2120ASIGNATURAS ) con el argumento de entrada $busqueda, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_buscarAsignatura
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_buscarAsignatura( $busqueda )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 2120nomasignatura, 4000nomcurso, 5000numcreditos, 2120bvigencia, 2100nomcarrera";
		$consulta .= " FROM 2120ASIGNATURAS";
		$consulta .= " INNER JOIN 5000CREDITOS";
		$consulta .= " ON 2120ASIGNATURAS.5000idcreditos = 5000CREDITOS.5000idcreditos";
		$consulta .= " INNER JOIN 4000CURSOS";
		$consulta .= " ON 2120ASIGNATURAS.4000idcurso = 4000CURSOS.4000idcurso";
		$consulta .= " INNER JOIN 2100CARRERAS";
		$consulta .= " ON 2120ASIGNATURAS.2100idcarrera = 2100CARRERAS.2100idcarrera";
		$consulta .= " WHERE (";
		$consulta .= " 2120nomasignatura LIKE '%" . $busqueda . "%'";
		$consulta .= ");";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "nomasignatura" ] = $fila[ "2120nomasignatura" ];
					$arRetorno[ "datos" ][ $i ][ "nomcurso" ] = $fila[ "4000nomcurso" ];
					$arRetorno[ "datos" ][ $i ][ "numcreditos" ] = $fila[ "5000numcreditos" ];
					$arRetorno[ "datos" ][ $i ][ "vigencia" ] = $fila[ "2120bvigencia" ];
					$arRetorno[ "datos" ][ $i ][ "nomcarrera" ] = $fila[ "2100nomcarrera" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	// Fin Funciones Búsqueda
	
	// Inicio Funciones Registro e Iniciar Sesion
	
	/* mod002_registrarUsuario
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para insertar un nuevo registro en la tabla 10000USUARIOS`, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$nomusuario							: Es la variable que contiene el nombre del usuario que queremos introducir.
			$correousuario						: Es la variable que contiene el correo del usuario que queremos introducir.
			$contrasennausuario					: Es la variable que contiene la contraseña del usuario que queremos introducir.
		-- Variables principales --             
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_registrarUsuario
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_registrarUsuario( $nomusuario, $correousuario, $contrasennausuario )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "INSERT INTO `10000USUARIOS`";
		$consulta .= " ( 10000idusuario, 10000nomusuario, 10000correousuario, 10000contrasennausuario )";
		$consulta .= " VALUES";
		$consulta .= " ( null, '$nomusuario', '$correousuario', '$contrasennausuario' )";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_affected_rows( $conexion );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				$arRetorno[ "datos" ][ 0 ][ "idAlumnoNuevo" ] = mysqli_insert_id( $conexion );
				
			} 
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	/* mod002_iniciarSesionUsuario
	
		-- Descripcion larga --
			Realiza una consulta sobre la base de datos para obtener la información de la tabla 10000USUARIOS correspondiente a un determinado correo y contraseña de usuario, si la consulta devuelve resultados los guarda en el array $arRetorno ( "datos" ), en caso de que o bien no tenga resultados o la consulta esté mal realizada guardará dicha información en el mismo array arRetorno ( "estado" -> "numFilas" / "codError" / "consulta" / "codErrorSQL" / "desErrorSQL" ).
		-- Argumentos --
			$correousuario						: Es la variable que contiene el correo del usuario que queremos tratar.
			$contrasennausuario					: Es la variable que contiene la contraseña del usuario quq queremos tratar.
		-- Variables principales --
			$conexion							: Es la variable que indica el enlace a la base de datos.
			$consulta							: Es la variable en la que escribimos la consulta para la base de datos.
			$resultado							: Es la variable en la que se guardan los resultados de la consulta, toma valores booleanos y tiene forma de objeto.
			$fila								: Es una variable con forma de array asociativo que va recuperando cada registro de la variable $resultado.
		-- Retorno --
			$arRetorno							: Devuelve un array con los índices "estado", "codError", y "datos" que contiene los errores y la información obtenida de la base de datos.
		-- Funciones a las que llama --
			mod001_conectaBaseDatos				: Nos conecta con la base de datos para acceder a la informacion.
			mod001_desconectaBaseDatos			: Nos desconecta de la base de datos una vez que hemos obtenido la información.
		-- Funciones que la llaman --
			mod003_iniciarSesionUsuario
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod002_iniciarSesionUsuario( $correousuario, $contrasennausuario )
	{
		$conexion = mod001_conectaBaseDatos();
		
		$consulta = "SELECT 10000idusuario, 10000nomusuario";
		$consulta .= " FROM `10000USUARIOS`";
		$consulta .= " WHERE 10000correousuario = '$correousuario'";
		$consulta .= " AND 10000contrasennausuario = '$contrasennausuario'";
		
		$resultado = mysqli_query( $conexion, $consulta );
		
		$i = 0;
		if ( $resultado ) 
		{
			$arRetorno[ "estado" ][ "numFilas" ] = mysqli_num_rows( $resultado );
			if ( $arRetorno[ "estado" ][ "numFilas" ] !== 0 )
			{
				$arRetorno[ "estado" ][ "codError" ] = "000";
				while ( $fila = mysqli_fetch_array( $resultado ) ) 
				{
					$arRetorno[ "datos" ][ $i ][ "idusuario" ] = $fila[ "10000idusuario" ];
					$arRetorno[ "datos" ][ $i ][ "nomusuario" ] = $fila[ "10000nomusuario" ];
					$i++;
				}
			}
			else
			{
				$arRetorno[ "estado" ][ "codError" ] = "001";
				$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			}
		}
		else
		{
			$arRetorno[ "estado" ][ "codError" ] = "002";
			$arRetorno[ "estado" ][ "consulta" ] = $consulta;
			$arRetorno[ "estado" ][ "codErrorSQL" ] = mysqli_errno( $conexion );
			$arRetorno[ "estado" ][ "desErrorSQL" ] = mysqli_error( $conexion ); 
		}
		
		mod001_desconectaBaseDatos( $conexion );
		
		return $arRetorno;
	}
	
	// Fin Funciones Registro e Iniciar Sesion
	
?>
