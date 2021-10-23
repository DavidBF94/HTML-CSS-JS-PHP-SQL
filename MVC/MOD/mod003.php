
<?php 
	
	require( "mod002.php" );
	
	// Funciones Generales
	
	/* mod003_obtenerFechaFormateada
	
		-- Descripcion larga --
			A partir de una fecha de la forma: año - mes - día, la cambiamos a una forma del tipo: mes de año.
		-- Argumentos --
			$fecha								: Es la variable que contiene la fecha que deseamos cambiar con formato texto.
		-- Variables principales --
			$arMeses							: Es la variable que contiene un array con los nombres en castellano de los 12 meses.
			$arFecha							: Es la variable en la que iremos guardando el año, mes y día de la variable $fecha.
			$contador							: Es la variable con la que controlamos que hemos pasado un guión de la variable $fecha.
		-- Retorno --
			$fechaFormateada					: Es la variable con formato texto en la que ya fijamos la fecha con forma: mes de año.
		-- Funciones a las que llama --
			Ninguna
		-- Funciones que la llaman --
			mod003_obtenerDecanosFacultad
			mod003_obtenerDecanosFacultadPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function obtenerFechaFormateada( $fecha )
	{
		$arMeses = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];
		$arFecha = ["","",""];
		
		$contador = 0;
		for ( $i = 0; $i < strlen( $fecha ); $i++)
		{
			if ( $fecha[ $i ] !== "-" )
			{
				$arFecha[ $contador ] .= $fecha[ $i ];
			}
			else
			{
				$contador++;
			}
		}
		
		$arFecha = array_map('intval', $arFecha);
		$arFecha[ 1 ] = $arMeses[ $arFecha[ 1 ] - 1 ];
		
		$fechaFormateada = $arFecha[ 1 ] . " de " . $arFecha[ 0 ];
		
		return $fechaFormateada;
	}
	
	// Fin Funciones Generales
	
	/* mod003_obtenerFechaFormateada
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerDecanos para obtener el array con la información de su consulta.
		-- Argumentos --
			Ninguno
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arDecanos							: Es el array resultado de llamar a la función mod002_obtenerDecanos.
		-- Funciones a las que llama --
			mod002_obtenerDecanos
		-- Funciones que la llaman --
			mod004_obtenerDecanos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerDecanos()
	{
		$arDecanos = mod002_obtenerDecanos();
		
		return $arDecanos;
	}
	
	/* mod003_obtenerDecanosFacultad
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerDecanosFacultad para obtener el array con la información de su consulta y modifica los registros con las fechas ( función obtenerFechaFormateada ) y con los salarios añandiendo puntos, comas y euros.
		-- Argumentos --
			Ninguno
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arDecanosFacultad					: Es el array resultado de llamar a la función mod002_obtenerDecanosFacultad y tratar sus campos salario y fecha.
		-- Funciones a las que llama --
			mod002_obtenerDecanosFacultad
			obtenerFechaFormateada
		-- Funciones que la llaman --
			mod004_obtenerDecanosFacultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerDecanosFacultad()
	{
		$arDecanosFacultad = mod002_obtenerDecanosFacultad();
		
		if ( $arDecanosFacultad[ "estado" ][ "codError" ] === "000" )
		{
			for ( $i = 0; $i < count ( $arDecanosFacultad[ "datos" ] ); $i++ ) 
			{
				$arDecanosFacultad[ "datos" ][ $i ][ "fecdecano" ] = obtenerFechaFormateada( $arDecanosFacultad[ "datos" ][ $i ][ "fecdecano" ] );
				
				$arDecanosFacultad[ "datos" ][ $i ][ "salariodecano" ] = number_format( $arDecanosFacultad[ "datos" ][ $i ][ "salariodecano" ], 2, ",", "." );
				$arDecanosFacultad[ "datos" ][ $i ][ "salariodecano" ] .= " euros";
			}
		}
		
		return $arDecanosFacultad;
	}
	
	/* mod003_obtenerSumaSalariosDecanosFacultad
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerSumaSalariosDecanosFacultad para obtener el array con la información de su consulta y modifica los registros con los salarios añandiendo puntos, comas y euros.
		-- Argumentos --
			Ninguno
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arSumaSalariosDecanosFacultad		: Es el array resultado de llamar a la función mod002_obtenerSumaSalariosDecanosFacultad y tratar sus campos salario y fecha.
		-- Funciones a las que llama --
			mod002_obtenerSumaSalariosDecanosFacultad
		-- Funciones que la llaman --
			mod004_obtenerDecanosFacultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerSumaSalariosDecanosFacultad()
	{
		$arSumaSalariosDecanosFacultad = mod002_obtenerSumaSalariosDecanosFacultad();
		
		if ( $arSumaSalariosDecanosFacultad[ "estado" ][ "codError" ] === "000" )
		{
			for ( $i = 0; $i < count ( $arSumaSalariosDecanosFacultad[ "datos" ] ); $i++ ) 
			{
				$arSumaSalariosDecanosFacultad[ "datos" ][ $i ][ "sumasalarios" ] = number_format( $arSumaSalariosDecanosFacultad[ "datos" ][ $i ][ "sumasalarios" ], 2, ",", "." );
				$arSumaSalariosDecanosFacultad[ "datos" ][ $i ][ "sumasalarios" ] .= " euros";
			}
		}
		
		return $arSumaSalariosDecanosFacultad;
	}
	
	/* mod003_obtenerFacultades
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerFacultades para obtener el array con la información de su consulta.
		-- Argumentos --
			Ninguno
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arFacultades						: Es el array resultado de llamar a la función mod002_obtenerFacultades.
		-- Funciones a las que llama --
			mod002_obtenerFacultades
		-- Funciones que la llaman --
			mod004_obtenerFacultades
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerFacultades()
	{
		$arFacultades = mod002_obtenerFacultades();
		
		return $arFacultades;
	}
	
	/* mod003_obtenerCarreras
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerCarreras para obtener el array con la información de su consulta.
		-- Argumentos --
			$idfacultad							: Es la variable que contiene el código identificativo de la facultad de la que deseamos obtener la información.
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arCarreras							: Es el array resultado de llamar a la función mod002_obtenerCarreras.
		-- Funciones a las que llama --
			mod002_obtenerCarreras
		-- Funciones que la llaman --
			mod004_obtenerCarreras
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerCarreras( $idfacultad )
	{
		$arCarreras = mod002_obtenerCarreras( $idfacultad );
		
		return $arCarreras;
	}
	
	/* mod003_obtenerAsignaturas
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerAsignaturas para obtener el array con la información de su consulta para después tratar el campo vigencia y escribir vigente o no vigente según el valor de dicho registro.
		-- Argumentos --
			$idcarrera							: Es la variable que contiene el código identificativo de la carrera de la que deseamos obtener la información.
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arAsignaturas						: Es el array resultado de llamar a la función mod002_obtenerAsignaturas.
		-- Funciones a las que llama --
			mod002_obtenerAsignaturas
		-- Funciones que la llaman --
			mod004_obtenerAsignaturas
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerAsignaturas( $idcarrera)
	{
		$arAsignaturas = mod002_obtenerAsignaturas( $idcarrera );
		
		if ( $arAsignaturas[ "estado" ][ "codError" ] === "000" )
		{
			for ( $i = 0; $i < count ( $arAsignaturas[ "datos" ] ); $i++ )
			{
				if ( $arAsignaturas[ "datos" ][ $i ][ "vigencia" ] === "1" )
				{
					$arAsignaturas[ "datos" ][ $i ][ "vigencia" ] = "Vigente";
				}
				else
				{
					$arAsignaturas[ "datos" ][ $i ][ "vigencia" ] = "No Vigente";
				}
			}
		}			
		
		return $arAsignaturas;
	}
	
	/* mod003_obtenerDescripcionImagen_Facultad
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerDescripcionImagen_Facultad para obtener el array con la información de su consulta.
		-- Argumentos --
			$idfacultad							: Es la variable que contiene el código identificativo de la facultad de la que deseamos obtener la información.
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arDescripcionImagenFacultad		: Es el array resultado de llamar a la función mod002_obtenerDescripcionImagen_Facultad.
		-- Funciones a las que llama --
			mod002_obtenerDescripcionImagen_Facultad
		-- Funciones que la llaman --
			mod004_obtenerDescripcionImagen_Facultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerDescripcionImagen_Facultad( $idfacultad )
	{
		$arDescripcionImagenFacultad = mod002_obtenerDescripcionImagen_Facultad( $idfacultad );
		
		return $arDescripcionImagenFacultad;
	}
	
	/* mod003_obtenerDescripcionImagen_Carrera
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerDescripcionImagen_Carrera para obtener el array con la información de su consulta.
		-- Argumentos --
			$idcarrera							: Es la variable que contiene el código identificativo de la carrera de la que deseamos obtener la información.
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arDescripcionImagenCarrera			: Es el array resultado de llamar a la función mod002_obtenerDescripcionImagen_Carrera.
		-- Funciones a las que llama --
			mod002_obtenerDescripcionImagen_Carrera
		-- Funciones que la llaman --
			mod004_obtenerDescripcionImagen_Carrera
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerDescripcionImagen_Carrera( $idcarrera )
	{
		$arDescripcionImagenCarrera = mod002_obtenerDescripcionImagen_Carrera( $idcarrera );
		
		return $arDescripcionImagenCarrera;
	}
	
	/* mod003_obtenerAlumnos
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerAlumnos para obtener el array con la información de su consulta.
		-- Argumentos --
			Ninguno
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arAlumnos							: Es el array resultado de llamar a la función mod002_obtenerAlumnos.
		-- Funciones a las que llama --
			mod002_obtenerAlumnos
		-- Funciones que la llaman --
			mod004_obtenerAlumnos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerAlumnos()
	{
		$arAlumnos = mod002_obtenerAlumnos();
		
		return $arAlumnos;
	}
	
	/* mod003_obtenerProfesores
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerProfesores para obtener el array con la información de su consulta.
		-- Argumentos --
			Ninguno
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arProfesores						: Es el array resultado de llamar a la función mod002_obtenerProfesores.
		-- Funciones a las que llama --
			mod002_obtenerProfesores
		-- Funciones que la llaman --
			function mod004_obtenerProfesores
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerProfesores()
	{
		$arProfesores = mod002_obtenerProfesores();
		
		return $arProfesores;
	}
	
	// Inicio Funciones Fotos
	
	/* mod003_obtenerFotosDecanos
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerFotosDecanos para obtener el array con la información de su consulta del decano ( iddecano ) indicado, si no logra ningún resultado ( error = 001 ) entonces fija la imagen generico.png.
		-- Argumentos --
			$iddecano							: Es la variable que contiene el código identificativo del decano del que deseamos obtener la información.
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arNomFicheroFotoDecano				: Es el array resultado de llamar a la función mod002_obtenerFotosDecanos.
		-- Funciones a las que llama --
			mod002_obtenerFotosDecanos
		-- Funciones que la llaman --
			mod004_obtenerFotosDecanos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerFotosDecanos( $iddecano )
	{
		$arNomFicheroFotoDecano = mod002_obtenerFotosDecanos( $iddecano );
		
		if ( $arNomFicheroFotoDecano[ "estado" ][ "codError" ] === "001" ) 
		{
			$arNomFicheroFotoDecano[ "datos" ][ 0 ][ "iddecano" ] = 0;
			$arNomFicheroFotoDecano[ "datos" ][ 0 ][ "nomficherofotodecano" ] = "IMG/generico.png";
		}
		
		return $arNomFicheroFotoDecano;
	}
	
	/* mod003_obtenerFotosAlumnos
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerFotosAlumnos para obtener el array con la información de su consulta del alumno ( idalumno ) indicado, si no logra ningún resultado ( error = 001 ) entonces fija la imagen generico.png.
		-- Argumentos --
			$idalumno							: Es la variable que contiene el código identificativo del alumno del que deseamos obtener la información.
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arNomFicheroFotoAlumno				: Es el array resultado de llamar a la función mod002_obtenerFotosAlumnos.
		-- Funciones a las que llama --
			mod002_obtenerFotosAlumnos
		-- Funciones que la llaman --
			mod004_obtenerFotosAlumnos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerFotosAlumnos( $idalumno )
	{
		$arNomFicheroFotoAlumno = mod002_obtenerFotosAlumnos( $idalumno );
		
		if ( $arNomFicheroFotoAlumno[ "estado" ][ "codError" ] === "001" ) 
		{
			$arNomFicheroFotoAlumno[ "datos" ][ 0 ][ "idalumno" ] = 0;
			$arNomFicheroFotoAlumno[ "datos" ][ 0 ][ "nomficherofotoalumno" ] = "IMG/generico.png";
		}
		
		return $arNomFicheroFotoAlumno;
	}
	
	/* mod003_obtenerFotosProfesores
	
		-- Descripcion larga --
			Llama a la función mod002_obtenerFotosProfesores para obtener el array con la información de su consulta del profesor ( idprofesor ) indicado, si no logra ningún resultado ( error = 001 ) entonces fija la imagen generico.png.
		-- Argumentos --
			$idprofesor							: Es la variable que contiene el código identificativo del profesor del que deseamos obtener la información.
		-- Variables principales --
			Ninguna
		-- Retorno --
			$arNomFicheroFotoProfesor			: Es el array resultado de llamar a la función mod002_obtenerFotosProfesores.
		-- Funciones a las que llama --
			mod002_obtenerFotosProfesores
		-- Funciones que la llaman --
			mod004_obtenerFotosProfesores
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerFotosProfesores( $idprofesor )
	{
		$arNomFicheroFotoProfesor = mod002_obtenerFotosProfesores( $idprofesor );
		
		if ( $arNomFicheroFotoProfesor[ "estado" ][ "codError" ] === "001" ) 
		{
			$arNomFicheroFotoProfesor[ "datos" ][ 0 ][ "idprofesor" ] = 0;
			$arNomFicheroFotoProfesor[ "datos" ][ 0 ][ "nomficherofotoprofesor" ] = "IMG/generico.png";
		}
		
		return $arNomFicheroFotoProfesor;
	}
	
	// Fin Funciones Fotos
	
	// Inicio Funciones Paginacion
	
	/* mod003_obtenerDecanosPaginacion
	
		-- Descripcion larga --
			A partir del número de registros deseados y la página desde la que se parte se halla el registro inicial en la tabla de la que queremos hallar la información, para luego enviarlo a la respectiva función del mod002 junto con el número de registros.
		-- Argumentos --
			$pag								: Es la variable que contiene el número de página en el que nos encontramos.
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales --
			$registroInicio						: Es la variable que indica el registro inicial desde el que debemos partir a la hora de seleccionar datos de la tabla.
		-- Retorno --
			$arDecanosPaginacion				: Es el array resultado de llamar a la función mod002_obtenerDecanosPaginacion.
		-- Funciones a las que llama --
			mod002_obtenerDecanosPaginacion
		-- Funciones que la llaman --
			mod004_obtenerDecanosPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerDecanosPaginacion( $pag, $numRegistros ) 
	{
		$registroInicio = ( $pag - 1 ) * $numRegistros;
		$arDecanosPaginacion = mod002_obtenerDecanosPaginacion( $registroInicio, $numRegistros );
		
		return $arDecanosPaginacion;
	}
	
	/* mod003_obtenerDecanosTotales
	
		-- Descripcion larga --
			A partir del número de registros deseados y de la llamada a la función mod002_obtenerDecanosTotales halla el número total de páginas que serán necesarias para presentar todos los datos de la tabla en cuestión.
		-- Argumentos --
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales --
			$arDecanosTotales					: Es la variable retornada de la función mod002_obtenerDecanosTotales y que contiene el número total de registros de la tabla. 
		-- Retorno --
			$totalPaginas						: Es la variable que indica el número total de páginas que serán necesarias para presentar todos los datos de la tabla en cuestión.
		-- Funciones a las que llama --
			mod002_obtenerDecanosTotales
		-- Funciones que la llaman --
			mod004_obtenerDecanosPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerDecanosTotales( $numRegistros ) 
	{
		$arDecanosTotales = mod002_obtenerDecanosTotales();
		
		if ( $arDecanosTotales[ "estado" ][ "codError" ] === "000" ) 
		{
			$totalPaginas = ceil( $arDecanosTotales[ "datos" ][ 0 ][ "numtotaldecanos" ] / $numRegistros ); 
		} 
		else  
		{ 
		
		}
		
		return $totalPaginas;
	}
	
	/* mod003_obtenerAlumnosPaginacion
	
		-- Descripcion larga --
			A partir del número de registros deseados y la página desde la que se parte se halla el registro inicial en la tabla de la que queremos hallar la información, para luego enviarlo a la respectiva función del mod002 junto con el número de registros.
		-- Argumentos --
			$pag								: Es la variable que contiene el número de página en el que nos encontramos.
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales --
			$registroInicio						: Es la variable que indica el registro inicial desde el que debemos partir a la hora de seleccionar datos de la tabla.
		-- Retorno --
			$arAlumnosPaginacion				: Es el array resultado de llamar a la función mod002_obtenerAlumnosPaginacion.
		-- Funciones a las que llama --
			mod002_obtenerAlumnosPaginacion
		-- Funciones que la llaman --
			mod004_obtenerAlumnosPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerAlumnosPaginacion( $pag, $numRegistros ) 
	{
		$registroInicio = ( $pag - 1 ) * $numRegistros;
		$arAlumnosPaginacion = mod002_obtenerAlumnosPaginacion( $registroInicio, $numRegistros );
		
		return $arAlumnosPaginacion;
	}
	
	/* mod003_obtenerAlumnosTotales
	
		-- Descripcion larga --
			A partir del número de registros deseados y de la llamada a la función mod002_obtenerAlumnosTotales halla el número total de páginas que serán necesarias para presentar todos los datos de la tabla en cuestión.
		-- Argumentos --
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales --
			$arAlumnosTotales					: Es la variable retornada de la función mod002_obtenerAlumnosTotales y que contiene el número total de registros de la tabla. 
		-- Retorno --
			$totalPaginas						: Es la variable que indica el número total de páginas que serán necesarias para presentar todos los datos de la tabla en cuestión.
		-- Funciones a las que llama --
			mod002_obtenerAlumnosTotales
		-- Funciones que la llaman --
			mod004_obtenerAlumnosPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerAlumnosTotales( $numRegistros ) 
	{
		$arAlumnosTotales = mod002_obtenerAlumnosTotales();
		
		if ( $arAlumnosTotales[ "estado" ][ "codError" ] === "000" ) 
		{
			$totalPaginas = ceil( $arAlumnosTotales[ "datos" ][ 0 ][ "numtotalalumnos" ] / $numRegistros ); 
		} 
		else  
		{ 
		
		}
		
		return $totalPaginas;
	}
	
	/* mod003_obtenerDecanosFacultadPaginacion
	
		-- Descripcion larga --
			A partir del número de registros deseados y la página desde la que se parte se halla el registro inicial en la tabla de la que queremos hallar la información, para luego enviarlo a la respectiva función del mod002 junto con el número de registros.
			También formatea los registros de las fechas ( mediante la función obtenerFechaFormateada ) y los registros de los salarios, incluyendo puntos, comas y euros.
		-- Argumentos --
			$pag								: Es la variable que contiene el número de página en el que nos encontramos.
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales --
			$registroInicio						: Es la variable que indica el registro inicial desde el que debemos partir a la hora de seleccionar datos de la tabla.
		-- Retorno --
			$arDecanosFacultadPaginacion		: Es el array resultado de llamar a la función mod002_obtenerDecanosFacultadPaginacion.
		-- Funciones a las que llama --
			mod002_obtenerAlumnosPaginacion
			obtenerFechaFormateada
		-- Funciones que la llaman --
			mod004_obtenerDecanosFacultadPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerDecanosFacultadPaginacion( $pag, $numRegistros ) 
	{
		$registroInicio = ( $pag - 1 ) * $numRegistros;
		$arDecanosFacultadPaginacion = mod002_obtenerDecanosFacultadPaginacion( $registroInicio, $numRegistros );
		
		if ( $arDecanosFacultadPaginacion[ "estado" ][ "codError" ] === "000" )
		{
			for ( $i = 0; $i < count ( $arDecanosFacultadPaginacion[ "datos" ] ); $i++ ) 
			{
				$arDecanosFacultadPaginacion[ "datos" ][ $i ][ "fecdecano" ] = obtenerFechaFormateada( $arDecanosFacultadPaginacion[ "datos" ][ $i ][ "fecdecano" ] );
				
				$arDecanosFacultadPaginacion[ "datos" ][ $i ][ "salariodecano" ] = number_format( $arDecanosFacultadPaginacion[ "datos" ][ $i ][ "salariodecano" ], 2, ",", "." );
				$arDecanosFacultadPaginacion[ "datos" ][ $i ][ "salariodecano" ] .= " euros";
			}
		}
		
		return $arDecanosFacultadPaginacion;
	}
	
	/* mod003_obtenerDecanosFacultadTotales
	
		-- Descripcion larga --
			A partir del número de registros deseados y de la llamada a la función mod002_obtenerDecanosFacultadTotales halla el número total de páginas que serán necesarias para presentar todos los datos de la tabla en cuestión.
		-- Argumentos --
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales --
			$arDecanosFacultadTotales			: Es la variable retornada de la función mod002_obtenerDecanosFacultadTotales y que contiene el número total de registros de la tabla. 
		-- Retorno --
			$totalPaginas						: Es la variable que indica el número total de páginas que serán necesarias para presentar todos los datos de la tabla en cuestión.
		-- Funciones a las que llama --
			mod002_obtenerDecanosFacultadTotales
		-- Funciones que la llaman --
			mod004_obtenerDecanosFacultadPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerDecanosFacultadTotales( $numRegistros ) 
	{
		$arDecanosFacultadTotales = mod002_obtenerDecanosFacultadTotales();
		
		if ( $arDecanosFacultadTotales[ "estado" ][ "codError" ] === "000" ) 
		{
			$totalPaginas = ceil( $arDecanosFacultadTotales[ "datos" ][ 0 ][ "numtotaldecanosfacultad" ] / $numRegistros ); 
		} 
		else  
		{ 
		
		}
		
		return $totalPaginas;
	}
	
	/* mod003_obtenerProfesoresPaginacion
	
		-- Descripcion larga --
			A partir del número de registros deseados y la página desde la que se parte se halla el registro inicial en la tabla de la que queremos hallar la información, para luego enviarlo a la respectiva función del mod002 junto con el número de registros.
		-- Argumentos --
			$pag								: Es la variable que contiene el número de página en el que nos encontramos.
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales --
			$registroInicio						: Es la variable que indica el registro inicial desde el que debemos partir a la hora de seleccionar datos de la tabla.
		-- Retorno --
			$arProfesoresPaginacion				: Es el array resultado de llamar a la función mod002_obtenerProfesoresPaginacion.
		-- Funciones a las que llama --
			mod002_obtenerProfesoresPaginacion
		-- Funciones que la llaman --
			mod004_obtenerProfesoresPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerProfesoresPaginacion( $pag, $numRegistros ) 
	{
		$registroInicio = ( $pag - 1 ) * $numRegistros;
		$arProfesoresPaginacion = mod002_obtenerProfesoresPaginacion( $registroInicio, $numRegistros );
		
		return $arProfesoresPaginacion;
	}
	
	/* mod003_obtenerProfesoresTotales
	
		-- Descripcion larga --
			A partir del número de registros deseados y de la llamada a la función mod002_obtenerProfesoresTotales halla el número total de páginas que serán necesarias para presentar todos los datos de la tabla en cuestión.
		-- Argumentos --
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales --
			$arProfesoresTotales				: Es la variable retornada de la función mod002_obtenerProfesoresTotales y que contiene el número total de registros de la tabla. 
		-- Retorno --
			$totalPaginas						: Es la variable que indica el número total de páginas que serán necesarias para presentar todos los datos de la tabla en cuestión.
		-- Funciones a las que llama --
			mod002_obtenerProfesoresTotales
		-- Funciones que la llaman --
			mod004_obtenerProfesoresPaginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_obtenerProfesoresTotales( $numRegistros ) 
	{
		$arProfesoresTotales = mod002_obtenerProfesoresTotales();
		
		if ( $arProfesoresTotales[ "estado" ][ "codError" ] === "000" ) 
		{
			$totalPaginas = ceil( $arProfesoresTotales[ "datos" ][ 0 ][ "numtotalprofesores" ] / $numRegistros ); 
		} 
		else  
		{ 
		
		}
		
		return $totalPaginas;
	}
	
	// Fin Funciones Paginacion
	
	// Inicio Funciones Inserciones
	
	/* mod003_insertarAlumno
	
		-- Descripcion larga --
			Llama a la función mod002_insertarAlumno para pasarla los argumentos a insertar en la tabla correspondiente.
		-- Argumentos --
			$dnialumno							: Es la variable que contiene el dni del alumno que queremos introducir.
			$nombrealumno						: Es la variable que contiene el nombre del alumno que queremos introducir.
			$apellidosalumno					: Es la variable que contiene los apellidos del alumno que queremos introducir.
			$direccionalumno					: Es la variable que contiene la direccion del alumno que queremos introducir.
			$telefonoalumno						: Es la variable que contiene el telefono del alumno que queremos introducir.
			$correoalumno						: Es la variable que contiene el correo del alumno que queremos introducir.
			$imagenalumno						: Es la variable que contiene la imagen del alumno que queremos introducir.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arInsertarAlumno					: Es el array resultado de llamar a la función mod002_insertarAlumno, contiene información de los errores al insertar registros y datos.
		-- Funciones a las que llama --
			mod002_insertarAlumno
		-- Funciones que la llaman --
			mod004_insertarAlumno
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_insertarAlumno( $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno )
	{
		$arInsertarAlumno = mod002_insertarAlumno( $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno );
		
		return $arInsertarAlumno;
	}
	
	/* mod003_insertarProfesor
	
		-- Descripcion larga --
			Llama a la función mod003_insertarProfesor para pasarla los argumentos a insertar en la tabla correspondiente.
		-- Argumentos --
			$dniprofesor						: Es la variable que contiene el dni del profesor que queremos introducir.
			$nombreprofesor						: Es la variable que contiene el nombre del profesor que queremos introducir.
			$apellidosprofesor					: Es la variable que contiene los apellidos del profesor que queremos introducir.
			$direccionprofesor					: Es la variable que contiene la direccion del profesor que queremos introducir.
			$telefonoprofesor					: Es la variable que contiene el telefono del profesor que queremos introducir.
			$correoprofesor						: Es la variable que contiene el correo del profesor que queremos introducir.
			$imagenprofesor						: Es la variable que contiene la imagen del profesor que queremos introducir.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arInsertarProfesor					: Es el array resultado de llamar a la función mod003_insertarProfesor, contiene información de los errores al insertar registros y datos.
		-- Funciones a las que llama --
			mod003_insertarProfesor
		-- Funciones que la llaman --
			mod004_insertarProfesor
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_insertarProfesor( $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor ) 
	{
		$arInsertarProfesor = mod002_insertarProfesor( $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor );
		
		return $arInsertarProfesor;
	}
	
	/* mod003_insertarDecano
	
		-- Descripcion larga --
			Llama a la función mod003_insertarDecano para pasarla los argumentos a insertar en la tabla correspondiente.
		-- Argumentos --
			$dnidecano							: Es la variable que contiene el dni del decano que queremos introducir.
			$nombredecano						: Es la variable que contiene el nombre del decano que queremos introducir.
			$apellidosdecano					: Es la variable que contiene los apellidos del decano que queremos introducir.
			$direcciondecano					: Es la variable que contiene la direccion del decano que queremos introducir.
			$telefonodecano						: Es la variable que contiene el telefono del decano que queremos introducir.
			$correodecano						: Es la variable que contiene el correo del decano que queremos introducir.
			$imagendecano						: Es la variable que contiene la imagen del decano que queremos introducir.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arInsertarDecano					: Es el array resultado de llamar a la función mod002_insertarDecano, contiene información de los errores al insertar registros y datos.
		-- Funciones a las que llama --
			mod002_insertarDecano
		-- Funciones que la llaman --
			mod004_insertarDecano
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_insertarDecano( $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano ) 
	{
		$arInsertarDecano = mod002_insertarDecano( $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano );
		
		return $arInsertarDecano;
	}
	
	// Fin Funciones Inserciones
	
	// Inicio Funciones Ediciones
	
	/* mod003_editarAlumno
	
		-- Descripcion larga --
			Llama a la función mod002_editarAlumno para pasarla los argumentos que queremos actualizar en la tabla correspondiente.
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
			Ninguna
		-- Retorno --
			$arEdicionAlumno					: Es el array resultado de llamar a la función mod002_editarAlumno, contiene información de los posibles errores al actualizar los registros.
		-- Funciones a las que llama --
			mod002_editarAlumno
		-- Funciones que la llaman --
			mod004_editarAlumno
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_editarAlumno( $idalumno, $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno )
	{
		$arEdicionAlumno = mod002_editarAlumno( $idalumno, $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno );
		
		return $arEdicionAlumno;
	}
	
	/* mod003_editarProfesor
	
		-- Descripcion larga --
			Llama a la función mod002_editarProfesor para pasarla los argumentos que queremos actualizar en la tabla correspondiente.
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
			Ninguna
		-- Retorno --
			$arEdicionProfesor					: Es el array resultado de llamar a la función mod002_editarProfesor, contiene información de los posibles errores al actualizar los registros.
		-- Funciones a las que llama --
			mod002_editarProfesor
		-- Funciones que la llaman --
			mod004_editarProfesor
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_editarProfesor( $idprofesor, $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor )
	{
		$arEdicionProfesor = mod002_editarProfesor( $idprofesor, $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor );
		
		return $arEdicionProfesor;
	}
	
	/* mod003_editarDecano
	
		-- Descripcion larga --
			Llama a la función mod002_editarDecano para pasarla los argumentos que queremos actualizar en la tabla correspondiente.
		-- Argumentos --
			$idalumno							: Es la variable que contiene el id del decano que queremos actualizar.
			$dnidecano							: Es la variable que contiene el dni del decano que queremos actualizar.
			$nombredecano						: Es la variable que contiene el nombre del decano que queremos actualizar.
			$apellidosdecano					: Es la variable que contiene los apellidos del decano que queremos actualizar.
			$direcciondecano					: Es la variable que contiene la direccion del decano que queremos actualizar.
			$telefonodecano						: Es la variable que contiene el telefono del decano que queremos actualizar.
			$correodecano						: Es la variable que contiene el correo del decano que queremos actualizar.
			$imagendecano						: Es la variable que contiene la imagen del decano que queremos actualizar.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arEdicionDecano					: Es el array resultado de llamar a la función mod002_editarDecano, contiene información de los posibles errores al actualizar los registros.
		-- Funciones a las que llama --
			mod002_editarDecano
		-- Funciones que la llaman --
			mod004_editarDecano
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_editarDecano( $iddecano, $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano )
	{
		$arEdicionDecano = mod002_editarDecano( $iddecano, $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano );
		
		return $arEdicionDecano;
	}
	
	// Fin Funciones Ediciones
	
	// Inicio Funciones Búsqueda
	
	/* mod003_buscarAlumno
	
		-- Descripcion larga --
			Llama a la función mod002_buscarAlumno con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarAlumno						: Es el array resultado de llamar a la función mod002_buscarAlumno, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod002_buscarAlumno
		-- Funciones que la llaman --
			mod004_buscarAlumno
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_buscarAlumno( $busqueda )
	{
		$arBuscarAlumno = mod002_buscarAlumno( $busqueda );
		
		return $arBuscarAlumno;
	}
	
	/* mod003_buscarProfesor
	
		-- Descripcion larga --
			Llama a la función mod002_buscarProfesor con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarProfesor					: Es el array resultado de llamar a la función mod002_buscarProfesor, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod002_buscarProfesor
		-- Funciones que la llaman --
			mod004_buscarProfesor
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_buscarProfesor( $busqueda )
	{
		$arBuscarProfesor = mod002_buscarProfesor( $busqueda );
		
		return $arBuscarProfesor;
	}
	
	/* mod003_buscarDecano
	
		-- Descripcion larga --
			Llama a la función mod002_buscarDecano con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarDecano						: Es el array resultado de llamar a la función mod002_buscarDecano, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod002_buscarDecano
		-- Funciones que la llaman --
			mod004_buscarDecano
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_buscarDecano( $busqueda )
	{
		$arBuscarDecano = mod002_buscarDecano( $busqueda );
		
		return $arBuscarDecano;
	}
	
	/* mod003_buscarFacultad
	
		-- Descripcion larga --
			Llama a la función mod002_buscarFacultad con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarFacultad					: Es el array resultado de llamar a la función mod002_buscarFacultad, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod002_buscarFacultad
		-- Funciones que la llaman --
			mod004_buscarFacultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_buscarFacultad( $busqueda )
	{
		$arBuscarFacultad = mod002_buscarFacultad( $busqueda );
		
		return $arBuscarFacultad;
	}
	
	/* mod003_buscarCarrera
	
		-- Descripcion larga --
			Llama a la función mod002_buscarCarrera con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarCarrera					: Es el array resultado de llamar a la función mod002_buscarCarrera, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod002_buscarCarrera
		-- Funciones que la llaman --
			mod004_buscarCarrera
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_buscarCarrera( $busqueda )
	{
		$arBuscarCarrera = mod002_buscarCarrera( $busqueda );
		
		return $arBuscarCarrera;
	}
	
	/* mod003_buscarAsignatura
	
		-- Descripcion larga --
			Llama a la función mod002_buscarAsignatura con el argumento $busqueda, si encuentra resultados ( error 000 ) cambia los registros vigencia por vigente si es 1 y no vigente si es 0.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarAsignatura					: Es el array resultado de llamar a la función mod002_buscarAsignatura, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod002_buscarAsignatura
		-- Funciones que la llaman --
			mod004_buscarAsignatura
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_buscarAsignatura( $busqueda )
	{
		$arBuscarAsignatura = mod002_buscarAsignatura( $busqueda );
		
		if ( $arBuscarAsignatura[ "estado" ][ "codError" ] === "000" )
		{
			for ( $i = 0; $i < count ( $arBuscarAsignatura[ "datos" ] ); $i++ )
			{
				if ( $arBuscarAsignatura[ "datos" ][ $i ][ "vigencia" ] === "1" )
				{
					$arBuscarAsignatura[ "datos" ][ $i ][ "vigencia" ] = "Vigente";
				}
				else
				{
					$arBuscarAsignatura[ "datos" ][ $i ][ "vigencia" ] = "No Vigente";
				}
			}
		}			
		
		return $arBuscarAsignatura;
	}
	
	// Fin Funciones Búsqueda
	
	// Inicio Funciones Registro e Iniciar Sesion
	
	/* mod003_registrarUsuario
	
		-- Descripcion larga --
			Llama a la función mod002_registrarUsuario con los argumentos $nomusuario, $correousuario, $contrasennausuario.
		-- Argumentos --
			$nomusuario							: Es la variable que contiene el nombre del usuario que queremos introducir.
			$correousuario						: Es la variable que contiene el correo del usuario que queremos introducir.
			$contrasennausuario					: Es la variable que contiene la contraseña del usuario que queremos introducir.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arRegistroUsuario					: Es el array resultado de llamar a la función mod002_registrarUsuario, contiene aquellos resultados del registro ó información de los errores.
		-- Funciones a las que llama --
			mod002_registrarUsuario
		-- Funciones que la llaman --
			mod004_registrarUsuario
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_registrarUsuario( $nomusuario, $correousuario, $contrasennausuario )
	{
		$arRegistroUsuario = mod002_registrarUsuario( $nomusuario, $correousuario, $contrasennausuario );
		
		return $arRegistroUsuario;
	}
	
	/* mod003_iniciarSesionUsuario
	
		-- Descripcion larga --
			Llama a la función mod002_iniciarSesionUsuario con los argumentos $correousuario y $contrasennausuario.
		-- Argumentos --
			$correousuario						: Es la variable que contiene el correo del usuario que queremos comprobar si existe.
			$contrasennausuario					: Es la variable que contiene la contraseña del usuario que queremos comprobar si existe.
		-- Variables principales --            
			$_SESSION[ "idusuario" ]			: Es la variable de sesión en la que guardamos el id del usuario. 
			$_SESSION[ "nomusuario" ]			: Es la variable de sesión en la que guardamos el nombre del usuario.
		-- Retorno --
			$arIniciarSesionUsuario				: Es el array resultado de llamar a la función mod002_iniciarSesionUsuario, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod002_iniciarSesionUsuario
		-- Funciones que la llaman --
			mod004_iniciarSesionUsuario
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_iniciarSesionUsuario( $correousuario, $contrasennausuario )
	{
		$arIniciarSesionUsuario = mod002_iniciarSesionUsuario( $correousuario, $contrasennausuario );
		
		if ( $arIniciarSesionUsuario[ "estado" ][ "codError" ] === "000" )
		{
			$_SESSION[ "idusuario" ] = $arIniciarSesionUsuario[ "datos" ][ 0 ][ "idusuario" ];
			$_SESSION[ "nomusuario" ] = $arIniciarSesionUsuario[ "datos" ][ 0 ][ "nomusuario" ];
		}
		
		return $arIniciarSesionUsuario;
	}
	
	/* mod003_cerrarSesionUsuario
	
		-- Descripcion larga --
			Cierra la sesión actual.
		-- Argumentos --
			Ninguno
		-- Variables principales --            
			Ninguna
		-- Retorno --
			Ninguno
		-- Funciones a las que llama --
			Ninguna
		-- Funciones que la llaman --
			mod004_cerrarSesionUsuario
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod003_cerrarSesionUsuario()
	{
		session_destroy();
	}
	
	// Fin Funciones Registro e Iniciar Sesion
	
?>
