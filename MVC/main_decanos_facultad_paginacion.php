
<?php
	
	/* main_decanos_facultad_paginacion
	
		-- Descripcion larga --
			En éste controlador comprobamos si existe o no la variable $_SESSION[ "nomusuario" ], en caso de existir creamos una estructura HTML con ella y otra estructura HTML para incluir un botón de "Cerrar Sesion".
			En caso de no existir creamos una estructura para crear los botones "Registrarse" e "Iniciar Sesion". También incluye el archivo mod004 y obtiene de la función mod004_obtenerDecanosFacultadPaginacion el array con el código de error, la tabla con la información de los registros y la estructura para el menú de paginación para, a continuación, incluir un archivo vista u otro en función de susodicho código de error. En el propio enlace al controlador fijado en mod004_obtenerDecanosFacultadPaginacion se incluye un número de página que recuperamos con $_GET y fijando un número de registros por página ya tenemos los dos argumentos a enviar a mod004_obtenerDecanosFacultadPaginacion.
		-- Argumentos --
			$_SESSION[ "nomusuario" ]			: Es la variable de tipo sesión que contiene el nombre del usuario que se haya registrado e iniciado sesión.
			$arTablaDecanosFacultad				: Es el array respuesta de la función mod004_obtenerDecanosFacultadPaginacion, contiene el código de error, la tabla HTML para representar datos y la estructura para el menú de paginación.
		-- Variables principales -- 
			$mensaje							: Es la variable de tipo texto que contiene la estructura HTML para sacar por pantalla el mensaje con la variable $_SESSION.
			$estructura							: Es la variable de tipo texto en la que guardamos el código HTML para sacar por pantalla los botones correspondientes a cada situación.
			$pag								: Es la variable que indica la página en la que estamos.
			$numRegistros						: Es la variable que indica el número de registros que deseamos por página.
			$datosError							: Es la variable que contiene el código de error de $arTablaDecanosFacultad.
		-- Archivos a los que llama --
			vista_main_decanos_facultad_paginacion / vista_error
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
	
	if ( isset( $_GET[ "pag" ] ) ) 
	{
		$pag = $_GET[ "pag" ];
	} 
	else 
	{
		$pag = 1;
	}
		
	$numRegistros = 5;
	
	$arTablaDecanosFacultad = mod004_obtenerDecanosFacultadPaginacion( $pag, $numRegistros );
	
	if ( $arTablaDecanosFacultad[ 0 ] !== "002" ) 
	{
		require ( "VISTA/vista_main_decanos_facultad_paginacion.php" );
	} 
	else 
	{
		$datosError = $arTablaDecanosFacultad[ 1 ];
		require ( "VISTA/vista_error.php" );
	}
	
?>
