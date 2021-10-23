
<?php
	
	/* main_asignaturas
	
		-- Descripcion larga --
			En éste controlador comprobamos si existe o no la variable $_SESSION[ "nomusuario" ], en caso de existir creamos una estructura HTML con ella y otra estructura HTML para incluir un botón de "Cerrar Sesion".
			En caso de no existir creamos una estructura para crear los botones "Registrarse" e "Iniciar Sesion". También incluye el archivo mod004, obtiene de la función mod004_obtenerAsignaturas el array con el código de error y la tabla con la información de los registros, del mismo modo con la función mod004_obtenerDescripcionImagen_Carrera. Los argumentos de dichas funciones $idcarrera y $idfacultad los obtiene por el método $_GET del propio enlace al controlador. En función de los códigos de error de $arTablaAsignaturas y $arTablaDescripcionImagenCarrera incluiremos un archivo vista u otro.
		-- Argumentos --
			$_SESSION[ "nomusuario" ]			: Es la variable de tipo sesión que contiene el nombre del usuario que se haya registrado e iniciado sesión.
			$arTablaAsignaturas					: Es el array respuesta de la función mod004_obtenerAsignaturas, contiene el código de error y la tabla HTML para representar datos.
			$arTablaDescripcionImagenCarrera	: Es el array respuesta de la función mod004_obtenerDescripcionImagen_Carrera, contiene el código de error y la tabla HTML para representar datos.
			$idcarrera							: Es el id de la carrera obtenido del enlace al controlador.
			$idfacultad							: Es el id de la facultad obtenido del enlace al controlador.
		-- Variables principales -- 
			$mensaje							: Es la variable de tipo texto que contiene la estructura HTML para sacar por pantalla el mensaje con la variable $_SESSION.
			$estructura							: Es la variable de tipo texto en la que guardamos el código HTML para sacar por pantalla los botones correspondientes a cada situación. 
			$datosError							: Es la variable que contiene el código de error de $arTablaAsignaturas	.
		-- Archivos a los que llama --
			vista_main_asignaturas / vista_error
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	session_start();
	
	if ( isset( ( $_SESSION[ "nomusuario" ] ) ) )
	{
		$mensaje = $_SESSION[ "nomusuario" ];
		
		$mensaje = "<span>" . $mensaje . "</span>";
		
		$mensaje = "<div class = 'mensaje'><span>¡¡</span> Hola " . $mensaje . " , gracias por visitarnos <span>!!</span> </div>";
		
		$estructura = " <div class = 'Registrarse_Sesion'>
							<div>
								<form name = 'Registrarse_IniciarSesion'>
									<input type='button' name= 'CerrarSesion' value='Cerrar Sesión'/>
								</form>
							</div>
						</div>";
	}
	else
	{
		$mensaje = "";
		
		$estructura = " <div class = 'Registrarse_Sesion'>
							<div>
								<form name = 'Registrarse_IniciarSesion'>
									<input type='button' name= 'Registro' value='Registrarse'/>
									<input type='button' name= 'Sesion' value='Iniciar Sesión'/>
								</form>
							</div>
						</div>";
	}
	
	require ( "MOD/mod004.php" );
	
	$idcarrera = $_GET[ "idcarrera" ];
	
	$idfacultad = $_GET[ "idfacultad" ];
	
	$arTablaAsignaturas = mod004_obtenerAsignaturas( $idcarrera );
	
	$arTablaDescripcionImagenCarrera = mod004_obtenerDescripcionImagen_Carrera( $idcarrera );
	
	if ( $arTablaAsignaturas[ 0 ] !== "002" && $arTablaDescripcionImagenCarrera[ 0 ] !== "002" ) 
	{
		require ( "VISTA/vista_main_asignaturas.php" );
	} 
	else if ( $arTablaAsignaturas[ 0 ] === "002" )
	{
		$datosError = $arTablaAsignaturas[ 1 ];
		require ( "VISTA/vista_error.php" );
	}
	else if ( $arTablaDescripcionImagenCarrera[ 0 ] === "002" )
	{
		$datosError = $arTablaDescripcionImagenCarrera[ 1 ];
		require ( "VISTA/vista_error.php" );
	}
	
?>
