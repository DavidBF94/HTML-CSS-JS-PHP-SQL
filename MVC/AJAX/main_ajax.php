
<?php
	
	/* main_profesores_paginacion
	
		-- Descripcion larga --
			El controlador main_ajax se encarga de tratar todas las peticiones asíncronas realizadas desde los archivos JavaScript correspondientes mediante el método $_POST sobre la variable accion, para después en base al valor de dicha variable accion ejecutar distintas funcionalidades. Para ejecutar ello se carga también el archivo mod004 para hacer uso de sus funciones.
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	session_start();
	
	require ( "../MOD/mod004.php" );
	
	$accion = $_POST[ "accion" ];
	
	switch ( $accion )
	{
		
		/*
	
		En el caso "obtenerImagAlumno" el evento ocurre al hacer click en cada segundo td de la tabla listaalumnos.
		Se obtiene mediante el método $_POST el id de dicho td y se pasa como dato ( $idalumno ). 
		Enviamos ésta variable como argumento a la función mod004_obtenerFotosAlumnos del archivo mod004 para obtener la imagen del alumno con dicho id y lo devolvemos en representación JSON al archivo JavaScript js_main_alumnos, a la función obtenerFotoAlumno.
	
		*/
		
		case "obtenerImagAlumno":
			
			$idalumno = $_POST[ "idalumno" ];
	
			$arRetorno = mod004_obtenerFotosAlumnos( $idalumno );
			
			echo json_encode( $arRetorno );
			
		break;
		
		/*
	
		En el caso "obtenerImagDecano" el evento ocurre al hacer click en cada segundo td de la tabla listadecanos.
		Se obtiene mediante el método $_POST el id de dicho td y se pasa como dato ( $iddecano ). 
		Enviamos ésta variable como argumento a la función mod004_obtenerFotosDecanos del archivo mod004 para obtener la imagen del decano con dicho id y lo devolvemos en representación JSON al archivo JavaScript js_main_decanos, a la función obtenerFotoDecano.
	
		*/
	
		case "obtenerImagDecano":
			
			$iddecano = $_POST[ "iddecano" ];
	
			$arRetorno = mod004_obtenerFotosDecanos( $iddecano );
			
			echo json_encode( $arRetorno );
			
		break;
		
		/*
	
		En el caso "obtenerImagProfesor" el evento ocurre al hacer click en cada segundo td de la tabla listaprofesores.
		Se obtiene mediante el método $_POST el id de dicho td y se pasa como dato ( $idprofesor ). 
		Enviamos ésta variable como argumento a la función mod004_obtenerFotosProfesores del archivo mod004 para obtener la imagen del profesor con dicho id y lo devolvemos en representación JSON al archivo JavaScript js_main_profesores, a la función obtenerFotoProfesor.
	
		*/
		
		case "obtenerImagProfesor":
			
			$idprofesor = $_POST[ "idprofesor" ];
	
			$arRetorno = mod004_obtenerFotosProfesores( $idprofesor );
			
			echo json_encode( $arRetorno );
			
		break;
		
		/*
	
		En el caso "insertarAlumno" el evento ocurre al hacer click en el input[ type='button' ] del div formulario ( si se ha pasado la validación ).
		Se obtienen mediante el método $_POST el dnialumno, nombrealumno, apellidosalumno, direccionalumno, telefonoalumno, correoalumno y la imagenalumno que se pasan como datos ( $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno ).
		Se pasan como argumentos a la función mod004_insertarAlumno del archivo mod004 para insertar dichos datos y obtener un array con información de los errores.
	
		*/
		
		case "insertarAlumno":
			
			$dnialumno = $_POST[ "dnialumno" ];
			$nombrealumno = $_POST[ "nombrealumno" ];
			$apellidosalumno = $_POST[ "apellidosalumno" ];
			$direccionalumno = $_POST[ "direccionalumno" ];
			$telefonoalumno = $_POST[ "telefonoalumno" ];
			$correoalumno = $_POST[ "correoalumno" ];
			$imagenalumno = $_POST[ "imagenalumno" ];
			
			$arRetorno = mod004_insertarAlumno( $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno );
			
			echo $arRetorno;
			
		break;
		
		/*
	
		En el caso "insertarProfesor" el evento ocurre al hacer click en el input[ type='button' ] del div formulario ( si se ha pasado la validación ).
		Se obtienen mediante el método $_POST el dniprofesor, nombreprofesor, apellidosprofesor, direccionprofesor, telefonoprofesor, correoprofesor y la imagenprofesor que se pasan como datos ( $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor ).
		Se pasan como argumentos a la función mod004_insertarProfesor del archivo mod004 para insertar dichos datos y obtener un array con información de los errores.
	
		*/
		
		case "insertarProfesor":
			
			$dniprofesor = $_POST[ "dniprofesor" ];
			$nombreprofesor = $_POST[ "nombreprofesor" ];
			$apellidosprofesor = $_POST[ "apellidosprofesor" ];
			$direccionprofesor = $_POST[ "direccionprofesor" ];
			$telefonoprofesor = $_POST[ "telefonoprofesor" ];
			$correoprofesor = $_POST[ "correoprofesor" ];
			$imagenprofesor = $_POST[ "imagenprofesor" ];
			
			$arRetorno = mod004_insertarProfesor( $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor );
			
			echo $arRetorno;
			
		break;
		
		/*
	
		En el caso "insertarDecano" el evento ocurre al hacer click en el input[ type='button' ] del div formulario ( si se ha pasado la validación ).
		Se obtienen mediante el método $_POST el dnidecano, nombredecano, apellidosdecano, direcciondecano, telefonodecano, correodecano y la imagendecano que se pasan como datos ( $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano ).
		Se pasan como argumentos a la función mod004_insertarDecano del archivo mod004 para insertar dichos datos y obtener un array con información de los errores.
	
		*/
		
		case "insertarDecano":
			
			$dnidecano = $_POST[ "dnidecano" ];
			$nombredecano = $_POST[ "nombredecano" ];
			$apellidosdecano = $_POST[ "apellidosdecano" ];
			$direcciondecano = $_POST[ "direcciondecano" ];
			$telefonodecano = $_POST[ "telefonodecano" ];
			$correodecano = $_POST[ "correodecano" ];
			$imagendecano = $_POST[ "imagendecano" ];
			
			$arRetorno = mod004_insertarDecano( $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano );
			
			echo $arRetorno;
			
		break;
		
		/*
	
		En el caso "editarAlumno" el evento ocurre al hacer click en el input[ type='button' ] del div formulario2 ( si se ha pasado la validación ).
		Se obtienen mediante el método $_POST el idalumno, dnialumno, nombrealumno, apellidosalumno, direccionalumno, telefonoalumno, correoalumno y la imagenalumno que se pasan como datos ( $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno ).
		Se pasan como argumentos a la función mod004_editarAlumno del archivo mod004 para actualizar dichos datos y obtener un array con información de los errores.
		El array se devuelve en forma JSON al archivo JavaScript js_main_alumnos, a la función edicionAlumnos.
	
		*/
		
		case "editarAlumno":
			
			$idalumno = $_POST[ "idalumno" ];
			$dnialumno = $_POST[ "dnialumno" ];
			$nombrealumno = $_POST[ "nombrealumno" ];
			$apellidosalumno = $_POST[ "apellidosalumno" ];
			$direccionalumno = $_POST[ "direccionalumno" ];
			$telefonoalumno = $_POST[ "telefonoalumno" ];
			$correoalumno = $_POST[ "correoalumno" ];
			$imagenalumno = $_POST[ "imagenalumno" ];
			
			$arRetorno = mod004_editarAlumno( $idalumno, $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno );
			
			echo json_encode( $arRetorno );
			
		break;
		
		/*
	
		En el caso "editarProfesor" el evento ocurre al hacer click en el input[ type='button' ] del div formulario2 ( si se ha pasado la validación ).
		Se obtienen mediante el método $_POST el idprofesor, dniprofesor, nombreprofesor, apellidosprofesor, direccionprofesor, telefonoprofesor, correoprofesor y la imagenprofesor que se pasan como datos ( $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor ).
		Se pasan como argumentos a la función mod004_editarProfesor del archivo mod004 para actualizar dichos datos y obtener un array con información de los errores.
		El array se devuelve en forma JSON al archivo JavaScript js_main_profesores, a la función edicionProfesores.
	
		*/
		
		case "editarProfesor":
			
			$idprofesor = $_POST[ "idprofesor" ];
			$dniprofesor = $_POST[ "dniprofesor" ];
			$nombreprofesor = $_POST[ "nombreprofesor" ];
			$apellidosprofesor = $_POST[ "apellidosprofesor" ];
			$direccionprofesor = $_POST[ "direccionprofesor" ];
			$telefonoprofesor = $_POST[ "telefonoprofesor" ];
			$correoprofesor = $_POST[ "correoprofesor" ];
			$imagenprofesor = $_POST[ "imagenprofesor" ];
			
			$arRetorno = mod004_editarProfesor( $idprofesor, $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor );
			
			echo json_encode( $arRetorno );
			
		break;
		
		/*
	
		En el caso "editarDecano" el evento ocurre al hacer click en el input[ type='button' ] del div formulario2 ( si se ha pasado la validación ).
		Se obtienen mediante el método $_POST el iddecano, dnidecano, nombredecano, apellidosdecano, direcciondecano, telefonodecano, correodecano y la imagendecano que se pasan como datos ( $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano ).
		Se pasan como argumentos a la función mod004_editarDecano del archivo mod004 para actualizar dichos datos y obtener un array con información de los errores.
		El array se devuelve en forma JSON al archivo JavaScript js_main_decanos, a la función edicionDecanos.
		
		*/
		
		case "editarDecano":
			
			$iddecano = $_POST[ "iddecano" ];
			$dnidecano = $_POST[ "dnidecano" ];
			$nombredecano = $_POST[ "nombredecano" ];
			$apellidosdecano = $_POST[ "apellidosdecano" ];
			$direcciondecano = $_POST[ "direcciondecano" ];
			$telefonodecano = $_POST[ "telefonodecano" ];
			$correodecano = $_POST[ "correodecano" ];
			$imagendecano = $_POST[ "imagendecano" ];
			
			$arRetorno = mod004_editarDecano( $iddecano, $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano );
			
			echo json_encode( $arRetorno );
			
		break;
		
		/*
	
		En el caso "buscar" el evento ocurre al hacer click en el input[name='boton_busqueda'].
		Se envía mediante el método $_POST el texto con la búsqueda ( $busqueda ).
		Dicha variable $busqueda se pasa como argumento a las funciones del archivo mod004: mod004_buscarAlumno, mod004_buscarProfesor, mod004_buscarDecano, mod004_buscarFacultad, mod004_buscarCarrera, mod004_buscarAsignatura.
		Cada una de dichas funciones devuelven arrays con información de los errores y datos de sus respectivas tablas ( si han encontrado registros compatibles con la busqueda ).
		Cada uno de éstos arrays se van agrupando en la variable $arRetorno, que devolvemos al archivo JavaScript js_buscador a la función buscador en formato JSON.
		
		*/
		
		case "buscar":
			
			$busqueda = $_POST[ "busqueda" ];
			
			$arRetorno[] = mod004_buscarAlumno( $busqueda );
			$arRetorno[] = mod004_buscarProfesor( $busqueda );
			$arRetorno[] = mod004_buscarDecano( $busqueda );
			$arRetorno[] = mod004_buscarFacultad( $busqueda );
			$arRetorno[] = mod004_buscarCarrera( $busqueda );
			$arRetorno[] = mod004_buscarAsignatura( $busqueda );
			
			echo json_encode( $arRetorno );
		
		break;
		
		/*
	
		En el caso "registrarUsuario" el evento ocurre al hacer click en el input[ type='button' ] del div formulario3 ( si se ha pasado la validación ).
		Se obtienen mediante el método $_POST el nomusuario, correousuario y la contrasennausuario que se pasan como datos ( $nomusuario, $correousuario, $contrasennausuario ).
		Se pasan como argumentos a la función mod004_registrarUsuario del archivo mod004 para insertar dichos datos y obtener un array con información de los errores.
		El array se envía en formato JSON de vuelta al archivo JavaScript js_registro_iniciarsesion a la función registroUsuario.
	
		*/
		
		case "registrarUsuario":
		
			$nomusuario = $_POST[ "nomusuario" ];
			$correousuario = $_POST[ "correousuario" ];
			$contrasennausuario = $_POST[ "contrasennausuario" ];
			
			$arRetorno = mod004_registrarUsuario( $nomusuario, $correousuario, $contrasennausuario); 
			
			echo json_encode( $arRetorno );
		
		break;
		
		/*
	
		En el caso "iniciarSesionUsuario" el evento ocurre al hacer click en el input[ type='button' ] del div formulario4 ( si se ha pasado la validación ).
		Se obtienen mediante el método $_POST el correousuario y la contrasennausuario que se pasan como datos ( $correousuario, $contrasennausuario ).
		Se pasan como argumentos a la función mod004_iniciarSesionUsuario del archivo mod004 para obtener información de los errores y poder saber si dicho registro estaba ya dado de alta ( caso "registrarUsuario" ).
		El array de respuesta de la función con dicha información se envía de vuelta al archivo JavaScript js_registro_iniciarsesion a la función inicioSesionUsuario.
		*/
		
		case "iniciarSesionUsuario":
		
			$correousuario = $_POST[ "correousuario" ];
			$contrasennausuario = $_POST[ "contrasennausuario" ];
			
			$arRetorno = mod004_iniciarSesionUsuario( $correousuario, $contrasennausuario); 
			
			echo json_encode( $arRetorno );
		
		break;
		
		/*
	
		En el caso "cerrarSesionUsuario" el evento ocurre al hacer click en el "input[name='CerrarSesion']".
		La funcionalidad se reduce a llamar a la función del archivo mod004 mod004_cerrarSesionUsuario que a su vez llamará a la función del archivo mod003 mod003_cerrarSesionUsuario y cerrará la sesión actual ( creada en el caso "iniciarSesionUsuario" ).
			
		*/
		
		case "cerrarSesionUsuario":
		
			mod004_cerrarSesionUsuario();
		
		break;
	}
	
?>
