
<?php
	
	/* main_carreras
	
		-- Descripcion larga --
			En éste controlador comprobamos si existe o no la variable $_SESSION[ "nomusuario" ], en caso de existir creamos una estructura HTML con ella y otra estructura HTML para incluir un botón de "Cerrar Sesion".
			En caso de no existir creamos una estructura para crear los botones "Registrarse" e "Iniciar Sesion". También incluye el archivo mod004, obtiene de la función mod004_obtenerCarreras el array con el código de error y la tabla con la información de los registros, del mismo modo con la función mod004_obtenerDescripcionImagen_Facultad. El argumento de dichas funciones $idfacultad lo obtiene por el método $_GET del propio enlace al controlador. En función de los códigos de error de $arTablaCarreras y $arTablaDescripcionImagenFacultad incluiremos un archivo vista u otro.
		-- Argumentos --
			$_SESSION[ "nomusuario" ]			: Es la variable de tipo sesión que contiene el nombre del usuario que se haya registrado e iniciado sesión.
			$arTablaCarreras					: Es el array respuesta de la función mod004_obtenerCarreras, contiene el código de error y la tabla HTML para representar datos.
			$arTablaDescripcionImagenFacultad	: Es el array respuesta de la función mod004_obtenerDescripcionImagen_Facultad, contiene el código de error y la tabla HTML para representar datos.
			$idfacultad							: Es el id de la facultad obtenido del enlace al controlador.
		-- Variables principales -- 
			$mensaje							: Es la variable de tipo texto que contiene la estructura HTML para sacar por pantalla el mensaje con la variable $_SESSION.
			$estructura							: Es la variable de tipo texto en la que guardamos el código HTML para sacar por pantalla los botones correspondientes a cada situación. 
			$datosError							: Es la variable que contiene el código de error de $arTablaCarreras.
		-- Archivos a los que llama --
			vista_main_carreras / vista_error
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
	
	$idfacultad = $_GET[ "idfacultad" ];
	
	$arTablaCarreras = mod004_obtenerCarreras( $idfacultad );
	
	$arTablaDescripcionImagenFacultad = mod004_obtenerDescripcionImagen_Facultad( $idfacultad );
	
	if ( $arTablaCarreras[ 0 ] !== "002" && $arTablaDescripcionImagenFacultad[ 0 ] !== "002" ) 
	{
		require ( "VISTA/vista_main_carreras.php" );
	} 
	else if ( $arTablaCarreras[ 0 ] === "002" )
	{
		$datosError = $arTablaCarreras[ 1 ];
		require ( "VISTA/vista_error.php" );
	}
	else if ( $arTablaDescripcionImagenFacultad[ 0 ] === "002" )
	{
		$datosError = $arTablaDescripcionImagenFacultad[ 1 ];
		require ( "VISTA/vista_error.php" );
	}
	
?>
