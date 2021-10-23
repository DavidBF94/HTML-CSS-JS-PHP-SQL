
<?php

	require ( "mod003.php" );
	
	/* mod004_obtenerDecanos
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerDecanos, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. En el caso 000 asignamos un data-id en la columna nomdecano.
		-- Argumentos --
			Ninguno
		-- Variables principales -- 
			$arDecanos							: Es el array de respuesta de la función mod003_obtenerDecanos.
			$tablaDecanos						: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arDecanos que nos interesen. 
		-- Retorno --
			$arTablaDecanos						: Es el array de retorno, en la posicion 0 guardamos el código de error de $arDecanos y en la posicion 1 guardamos $tablaDecanos.
		-- Funciones a las que llama --
			mod003_obtenerDecanos
		-- Archivos que la llaman --
			main_decanos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerDecanos() 
	{
		$arDecanos = mod003_obtenerDecanos();	
		
		switch ( $arDecanos[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaDecanos = "<table id = 'listadecanos'>
									<thead>
										<tr>
											<th>
												DNI Decano
											</th>
											<th>
												Nombre Decano
											</th>
											<th>
												Apellidos Decano
											</th>
											<th>
												Direccion Decano
											</th>
											<th>
												Telefono Decano
											</th>
											<th>
												Correo Decano
											</th>
											<th>
												Accion
											</th>
										</tr>
									</thead>
									<tbody>";
				
				for ( $i = 0; $i < count ( $arDecanos[ "datos" ] ); $i++ ) 
				{
					$tablaDecanos .= "<tr>";
					foreach ( $arDecanos[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave === "iddecano" )
						{
							$iddecano = $valor;
						}
						else
						{
							if ( $clave === "nomdecano" )
							{
								$tablaDecanos .= "<td data-id='$iddecano'>";
								$tablaDecanos .= $valor;
								$tablaDecanos .= "</td>";
							}
							else
							{
								$tablaDecanos .= "<td>";
								$tablaDecanos .= $valor;
								$tablaDecanos .= "</td>";
							}
						}
					}
					$tablaDecanos .= "<td>";
					$tablaDecanos .= "Editar";
					$tablaDecanos .= "</td>";
					$tablaDecanos .= "</tr>";
				}
				$tablaDecanos .= "</tbody>";
				$tablaDecanos .= "</table>";
			break;
			
			case "001":
				$tablaDecanos = "<table>
									<thead>
										<tr>
											<th>
												DNI Decano
											</th>
											<th>
												Nombre Decano
											</th>
											<th>
												Apellidos Decano
											</th>
											<th>
												Direccion Decano
											</th>
											<th>
												Telefono Decano
											</th>
											<th>
												Correo Decano
											</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='6'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaDecanos = "<div>" . $arDecanos[ "estado" ][ "consulta" ] . "</div>";
				$tablaDecanos .= "<div>" . $arDecanos[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaDecanos .= "<div>" . $arDecanos[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaDecanos[ 0 ] = $arDecanos[ "estado" ][ "codError" ];
		$arTablaDecanos[ 1 ] = $tablaDecanos;
		
		return $arTablaDecanos;
	}
	
	/* mod004_obtenerDecanosFacultad
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerDecanosFacultad, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. Llama también a la función mod003_obtenerSumaSalariosDecanosFacultad para obtener la suma de salarios de todos los decanos.
		-- Argumentos --
			Ninguno
		-- Variables principales -- 
			$arDecanosFacultad					: Es el array de respuesta de la función mod003_obtenerDecanosFacultad.
			$arSumaSalariosDecanosFacultad		: Es el array de respuesta de la función mod003_obtenerSumaSalariosDecanosFacultad.
			$tablaDecanosFacultad				: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arDecanosFacultad y $arSumaSalariosDecanosFacultad que nos interesen. 
		-- Retorno --
			$arTablaDecanosFacultad				: Es el array de retorno, en la posicion 0 guardamos el código de error de $arDecanosFacultad y en la posicion 1 guardamos $tablaDecanosFacultad.
		-- Funciones a las que llama --
			mod003_obtenerDecanosFacultad
			mod003_obtenerSumaSalariosDecanosFacultad
		-- Archivos que la llaman --
			main_decanos_facultad
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerDecanosFacultad()
	{
		$arDecanosFacultad = mod003_obtenerDecanosFacultad();	
		
		$arSumaSalariosDecanosFacultad = mod003_obtenerSumaSalariosDecanosFacultad();

		switch ( $arDecanosFacultad[ "estado" ][ "codError" ] && $arSumaSalariosDecanosFacultad[ "estado" ][ "codError" ] )
		{
		
			case "000":
				$tablaDecanosFacultad = "<table>
											<thead>
												<tr>
													<th>
														Nombre Decano
													</th>
													<th>
														Apellidos Decano
													</th>
													<th>
														Nombre Facultad
													</th>
													<th>
														Fecha Inicio Decano
													</th>
													<th>
														Salario Decano
													</th>
												</tr>
											</thead>
											<tbody>";
											
				for ( $i = 0; $i < count ( $arDecanosFacultad[ "datos" ] ); $i++ ) 
				{
					$tablaDecanosFacultad .= "<tr>";
					foreach ( $arDecanosFacultad[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave !== "iddecano" && $clave !== "idfacultad" )
						{
							$tablaDecanosFacultad .= "<td>";
							$tablaDecanosFacultad .= $valor;
							$tablaDecanosFacultad .= "</td>";
						}
					}
					$tablaDecanosFacultad .= "</tr>";
				}
				
				$tablaDecanosFacultad .= "<tr>";
				$tablaDecanosFacultad .= "<td colspan='4'><u>Suma Salario Total</u></td>";
				$tablaDecanosFacultad .= "<td>";
				$tablaDecanosFacultad .= $arSumaSalariosDecanosFacultad[ "datos" ][ 0 ][ "sumasalarios" ];
				$tablaDecanosFacultad .= "</td>";
				$tablaDecanosFacultad .= "<tr>";
				
				$tablaDecanosFacultad .= "</tbody>";
				$tablaDecanosFacultad .= "</table>";
			break;
		
			case "001":
				$tablaDecanosFacultad = "<table>
									<thead>
										<tr>
											<th>
												Nombre Decano
											</th>
											<th>
												Apellidos Decano
											</th>
											<th>
												Nombre Facultad
											</th>
											<th>
												Fecha Inicio Decano
											</th>
											<th>
												Salario Decano
											</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='5'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaDecanosFacultad = "<div>" . $arDecanosFacultad[ "estado" ][ "consulta" ] . "</div>";
				$tablaDecanosFacultad .= "<div>" . $arDecanosFacultad[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaDecanosFacultad .= "<div>" . $arDecanosFacultad[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		
		}
		
		$arTablaDecanosFacultad[ 0 ] = $arDecanosFacultad[ "estado" ][ "codError" ];
		$arTablaDecanosFacultad[ 1 ] = $tablaDecanosFacultad;
		
		return $arTablaDecanosFacultad;
	}
	
	/* mod004_obtenerFacultades
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerFacultades, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. En el caso 000 asignamos un enlace en los registros nomfacultad.
		-- Argumentos --
			Ninguno
		-- Variables principales -- 
			$arFacultades						: Es el array de respuesta de la función mod003_obtenerFacultades.
			$tablaFacultades					: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arFacultades que nos interesen. 
		-- Retorno --
			$arTablaFacultades					: Es el array de retorno, en la posicion 0 guardamos el código de error de $arFacultades y en la posicion 1 guardamos $tablaFacultades.
		-- Funciones a las que llama --
			mod003_obtenerFacultades
		-- Archivos que la llaman --
			main_facultades
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerFacultades()
	{
		$arFacultades = mod003_obtenerFacultades();	

		switch ( $arFacultades[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaFacultades = "<table>
										<thead>
											<tr>
												<th>
													Nombre Facultad
												</th>
												<th>
													Direccion Facultad
												</th>
											</tr>
										</thead>
										<tbody>";
											
				for ( $i = 0; $i < count ( $arFacultades[ "datos" ] ); $i++ ) 
				{
					$tablaFacultades .= "<tr>";
					foreach ( $arFacultades[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave === "idfacultad" )
						{
							$valor2 = $valor;
						}
						if ( $clave === "nomfacultad" )
						{
							$tablaFacultades .= "<td>";
							$tablaFacultades .= "<a href='main_carreras.php?idfacultad=" . $valor2 . "'>";
							$tablaFacultades .= $valor;
							$tablaFacultades .= "</a>";
							$tablaFacultades .= "</td>";
						}
						else if ( $clave === "direccionfacultad" )
						{
							$tablaFacultades .= "<td>";
							$tablaFacultades .= $valor;
							$tablaFacultades .= "</td>";
						}
					}
					$tablaFacultades .= "</tr>";
				}
				$tablaFacultades .= "</tbody>";
				$tablaFacultades .= "</table>";
			break;
			
			case "001":
				$tablaFacultades = "<table>
									<thead>
										<tr>
											<th>
												Nombre Facultad
											</th>
											<th>
												Direccion Facultad
											</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='2'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaFacultades = "<div>" . $arFacultades[ "estado" ][ "consulta" ] . "</div>";
				$tablaFacultades .= "<div>" . $arFacultades[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaFacultades .= "<div>" . $arFacultades[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaFacultades[ 0 ] = $arFacultades[ "estado" ][ "codError" ];
		$arTablaFacultades[ 1 ] = $tablaFacultades;
		
		return $arTablaFacultades;
	}
	
	/* mod004_obtenerCarreras
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerCarreras con el argumento $idfacultad, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. En el caso 000 asignamos un enlace en los registros nomcarrera.
		-- Argumentos --
			$idfacultad							: Es la variable que contiene el id de la facultad de la que queremos hallar las carreras.
		-- Variables principales -- 
			$arCarreras							: Es el array de respuesta de la función mod003_obtenerCarreras.
			$tablaCarreras						: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arCarreras que nos interesen. 
		-- Retorno --
			$arTablaCarreras					: Es el array de retorno, en la posicion 0 guardamos el código de error de $arCarreras y en la posicion 1 guardamos $tablaCarreras.
		-- Funciones a las que llama --
			mod003_obtenerCarreras
		-- Archivos que la llaman --
			main_carreras
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerCarreras( $idfacultad )
	{
		$arCarreras = mod003_obtenerCarreras( $idfacultad );
		
		switch ( $arCarreras[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaCarreras = "<table>
									<thead>
										<tr>
											<th>
												Nombre Carrera
											</th>
										</tr>
									</thead>
									<tbody>";
				for ( $i = 0; $i < count ( $arCarreras[ "datos" ] ); $i++ ) 
				{
					$tablaCarreras .= "<tr>";
					foreach ( $arCarreras[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave === "idcarrera" )
						{
							$valor2 = $valor;
						}
						if ( $clave === "nomcarrera" )
						{
							$tablaCarreras .= "<td>";
							$tablaCarreras .= "<a href='main_asignaturas.php?idcarrera=" . $valor2 . "&" . "idfacultad=" . $idfacultad . "'>";
							$tablaCarreras .= $valor;
							$tablaCarreras .= "</a>";
							$tablaCarreras .= "</td>";
						}
					}
					$tablaCarreras .= "</tr>";
				}
				$tablaCarreras .= "</tbody>";
				$tablaCarreras .= "</table>";
			break;
			
			case "001":
				$tablaCarreras = "<table>
									<thead>
										<tr>
											<th>
												Nombre Carrera
											</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='1'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaCarreras = "<div>" . $arCarreras[ "estado" ][ "consulta" ] . "</div>";
				$tablaCarreras .= "<div>" . $arCarreras[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaCarreras .= "<div>" . $arCarreras[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaCarreras[ 0 ] = $arCarreras[ "estado" ][ "codError" ];
		$arTablaCarreras[ 1 ] = $tablaCarreras;
		
		return $arTablaCarreras;							
	}
	
	/* mod004_obtenerAsignaturas
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerAsignaturas con el argumento $idcarrera, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error.
		-- Argumentos --
			$idcarrera							: Es la variable que contiene el id de la carrera de la que queremos hallar las asignaturas.
		-- Variables principales -- 
			$arAsignaturas						: Es el array de respuesta de la función mod003_obtenerAsignaturas.
			$tablaAsignaturas					: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arAsignaturas que nos interesen. 
		-- Retorno --
			$arTablaAsignaturas					: Es el array de retorno, en la posicion 0 guardamos el código de error de $arAsignaturas y en la posicion 1 guardamos $tablaAsignaturas.
		-- Funciones a las que llama --
			mod003_obtenerAsignaturas
		-- Archivos que la llaman --
			main_asignaturas
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerAsignaturas( $idcarrera )
	{
		$arAsignaturas = mod003_obtenerAsignaturas( $idcarrera );
		
		switch ( $arAsignaturas[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaAsignaturas = "<table>
										<thead>
											<tr>
												<th>
													Nombre Asignatura
												</th>
												<th>
													Nombre Curso
												</th>
												<th>
													Número Creditos
												</th>
												<th>
													Vigencia
												</th>
											</tr>
										</thead>
										<tbody>";
				
				for ( $i = 0; $i < count ( $arAsignaturas[ "datos" ] ); $i++ ) 
				{
					$tablaAsignaturas .= "<tr>";
					foreach ( $arAsignaturas[ "datos" ][ $i ] as $clave => $valor )
					{	
						$tablaAsignaturas .= "<td>";
						$tablaAsignaturas .= $valor;
						$tablaAsignaturas .= "</td>";
					}
					$tablaAsignaturas .= "</tr>";
				}
				$tablaAsignaturas .= "</tbody>";
				$tablaAsignaturas .= "</table>";
			break;
			
			case "001":
				$tablaAsignaturas = "<table>
										<thead>
											<tr>
												<th>
													Nombre Asignatura
												</th>
												<th>
													Nombre Curso
												</th>
												<th>
													Número Creditos
												</th>
												<th>
													Vigencia
												</th>
											</tr>
										</thead>
										<tbody><tr><td colspan='4'>Sin datos</td></tr></tbody>
									</table>";
			break;
			
			case "002":
				$tablaAsignaturas = "<div>" . $arAsignaturas[ "estado" ][ "consulta" ] . "</div>";
				$tablaAsignaturas .= "<div>" . $arAsignaturas[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaAsignaturas .= "<div>" . $arAsignaturas[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaAsignaturas[ 0 ] = $arAsignaturas[ "estado" ][ "codError" ];
		$arTablaAsignaturas[ 1 ] = $tablaAsignaturas;
		
		return $arTablaAsignaturas;
	}
	
	/* mod004_obtenerDescripcionImagen_Facultad
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerDescripcionImagen_Facultad con el argumento $idfacultad, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) fija una imagen generica y escribe "sin datos", si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error.
		-- Argumentos --
			$idfacultad							: Es la variable que contiene el id de la facultad de la que queremos hallar la imagen y la descripcion.
		-- Variables principales -- 
			$arDescripcionImagenFacultad		: Es el array de respuesta de la función mod003_obtenerDescripcionImagen_Facultad.
			$tablaDescripcionImagenFacultad		: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arDescripcionImagenFacultad que nos interesen. 
		-- Retorno --
			$arTablaDescripcionImagenFacultad	: Es el array de retorno, en la posicion 0 guardamos el código de error de $arDescripcionImagenFacultad y en la posicion 1 guardamos $tablaDescripcionImagenFacultad.
		-- Funciones a las que llama --
			mod003_obtenerDescripcionImagen_Facultad
		-- Archivos que la llaman --
			main_carreras
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerDescripcionImagen_Facultad( $idfacultad )
	{
		$arDescripcionImagenFacultad = mod003_obtenerDescripcionImagen_Facultad( $idfacultad );
		
		switch ( $arDescripcionImagenFacultad[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaDescripcionImagenFacultad = "<div class = 'CajaDescripcionImagen'>
														<div class = 'Imagen'><img src = '" . $arDescripcionImagenFacultad[ "datos" ][ 0 ][ "nomficherofotofacultad" ] . "'/></div>
														<div class = 'Descripcion'>" . $arDescripcionImagenFacultad[ "datos" ][ 0 ][ "descripcionfacultad" ] . "</div>
													</div>";
			break;
			
			case "001":
				$tablaDescripcionImagenFacultad = "<div class = 'CajaDescripcionImagen'>
														<div class = 'Imagen'><img src = 'IMG/generico.png'/></div>
														<div class = 'Descripcion'>SIN DATOS</div>
													</div>";
			break;
			
			case "002":
				$tablaDescripcionImagenFacultad = "<div>" . $arDescripcionImagenFacultad[ "estado" ][ "consulta" ] . "</div>";
				$tablaDescripcionImagenFacultad .= "<div>" . $arDescripcionImagenFacultad[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaDescripcionImagenFacultad .= "<div>" . $arDescripcionImagenFacultad[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaDescripcionImagenFacultad[ 0 ] = $arDescripcionImagenFacultad[ "estado" ][ "codError" ];
		$arTablaDescripcionImagenFacultad[ 1 ] = $tablaDescripcionImagenFacultad;
		
		return $arTablaDescripcionImagenFacultad;							
	}
	
	/* mod004_obtenerDescripcionImagen_Carrera
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerDescripcionImagen_Carrera con el argumento $idcarrera, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) fija una imagen generica y escribe "sin datos", si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error.
		-- Argumentos --
			$idcarrera							: Es la variable que contiene el id de la carrera de la que queremos hallar la imagen y la descripcion.
		-- Variables principales -- 
			$arDescripcionImagenCarrera			: Es el array de respuesta de la función mod003_obtenerDescripcionImagen_Carrera.
			$tablaDescripcionImagenCarrera		: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arDescripcionImagenCarrera que nos interesen. 
		-- Retorno --
			$arTablaDescripcionImagenCarrera	: Es el array de retorno, en la posicion 0 guardamos el código de error de $arDescripcionImagenCarrera y en la posicion 1 guardamos $tablaDescripcionImagenCarrera.
		-- Funciones a las que llama --
			mod003_obtenerDescripcionImagen_Carrera
		-- Archivos que la llaman --
			main_asignaturas
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerDescripcionImagen_Carrera( $idcarrera )
	{
		$arDescripcionImagenCarrera = mod003_obtenerDescripcionImagen_Carrera( $idcarrera );
		
		switch ( $arDescripcionImagenCarrera[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaDescripcionImagenCarrera = "<div class = 'CajaDescripcionImagen'>
														<div class = 'Imagen'><img src = '" . $arDescripcionImagenCarrera[ "datos" ][ 0 ][ "nomficherofotocarrera" ] . "'/></div>
														<div class = 'Descripcion'>" . $arDescripcionImagenCarrera[ "datos" ][ 0 ][ "descripcioncarrera" ] . "</div>
													</div>";
			break;
			
			case "001":
				$tablaDescripcionImagenCarrera = "<div class = 'CajaDescripcionImagen'>
														<div class = 'Imagen'><img src = 'IMG/generico.png'/></div>
														<div class = 'Descripcion'>SIN DATOS</div>
													</div>";
			break;
			
			case "002":
				$tablaDescripcionImagenCarrera = "<div>" . $arDescripcionImagenCarrera[ "estado" ][ "consulta" ] . "</div>";
				$tablaDescripcionImagenCarrera .= "<div>" . $arDescripcionImagenCarrera[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaDescripcionImagenCarrera .= "<div>" . $arDescripcionImagenCarrera[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaDescripcionImagenCarrera[ 0 ] = $arDescripcionImagenCarrera[ "estado" ][ "codError" ];
		$arTablaDescripcionImagenCarrera[ 1 ] = $tablaDescripcionImagenCarrera;
		
		return $arTablaDescripcionImagenCarrera;							
	}
	
	/* mod004_obtenerAlumnos
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerAlumnos, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. En el caso 000 asignamos un data-id en la columna nomalumno.
		-- Argumentos --
			Ninguno
		-- Variables principales -- 
			$arAlumnos							: Es el array de respuesta de la función mod003_obtenerAlumnos.
			$tablaAlumnos						: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arAlumnos que nos interesen. 
		-- Retorno --
			$arTablaAlumnos						: Es el array de retorno, en la posicion 0 guardamos el código de error de $arAlumnos y en la posicion 1 guardamos $tablaAlumnos.
		-- Funciones a las que llama --
			mod003_obtenerAlumnos
		-- Archivos que la llaman --
			main_alumnos
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerAlumnos() 
	{
		$arAlumnos = mod003_obtenerAlumnos();	
		
		switch ( $arAlumnos[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaAlumnos = "<table id = 'listaalumnos'>
									<thead>
										<tr>
											<th>
												DNI Alumno
											</th>
											<th>
												Nombre Alumno
											</th>
											<th>
												Apellidos Alumno
											</th>
											<th>
												Direccion Alumno
											</th>
											<th>
												Telefono Alumno
											</th>
											<th>
												Correo Alumno
											</th>
											<th>
												Accion
											</th>
										</tr>
									</thead>
									<tbody>";
				
				for ( $i = 0; $i < count ( $arAlumnos[ "datos" ] ); $i++ ) 
				{
					$tablaAlumnos .= "<tr>";
					foreach ( $arAlumnos[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave === "idalumno" )
						{
							$idalumno = $valor;
						}
						else
						{
							if ( $clave === "nomalumno" )
							{
								$tablaAlumnos .= "<td data-id='$idalumno'>";
								$tablaAlumnos .= $valor;
								$tablaAlumnos .= "</td>";
							}
							else
							{
								$tablaAlumnos .= "<td>";
								$tablaAlumnos .= $valor;
								$tablaAlumnos .= "</td>";
							}
						}
					}
					$tablaAlumnos .= "<td>";
					$tablaAlumnos .= "Editar";
					$tablaAlumnos .= "</td>";
					$tablaAlumnos .= "</tr>";
				}
				$tablaAlumnos .= "</tbody>";
				$tablaAlumnos .= "</table>";
			break;
			
			case "001":
				$tablaAlumnos = "<table>
									<thead>
										<tr>
											<th>
												DNI Alumno
											</th>
											<th>
												Nombre Alumno
											</th>
											<th>
												Apellidos Alumno
											</th>
											<th>
												Direccion Alumno
											</th>
											<th>
												Telefono Alumno
											</th>
											<th>
												Correo Alumno
											</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='6'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaAlumnos = "<div>" . $arAlumnos[ "estado" ][ "consulta" ] . "</div>";
				$tablaAlumnos .= "<div>" . $arAlumnos[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaAlumnos .= "<div>" . $arAlumnos[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaAlumnos[ 0 ] = $arAlumnos[ "estado" ][ "codError" ];
		$arTablaAlumnos[ 1 ] = $tablaAlumnos;
		
		return $arTablaAlumnos;
	}
	
	/* mod004_obtenerProfesores
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerProfesores, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. En el caso 000 asignamos un data-id en la columna nomprofesor.
		-- Argumentos --
			Ninguno
		-- Variables principales -- 
			$arProfesores						: Es el array de respuesta de la función mod003_obtenerProfesores.
			$tablaProfesores					: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arProfesores que nos interesen. 
		-- Retorno --
			$arTablaAlumnos						: Es el array de retorno, en la posicion 0 guardamos el código de error de $arProfesores y en la posicion 1 guardamos $tablaProfesores.
		-- Funciones a las que llama --
			mod003_obtenerProfesores
		-- Archivos que la llaman --
			main_profesores
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerProfesores() 
	{
		$arProfesores = mod003_obtenerProfesores();	
		
		switch ( $arProfesores[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaProfesores = "<table id = 'listaprofesores'>
										<thead>
											<tr>
												<th>
													DNI Profesor
												</th>
												<th>
													Nombre Profesor
												</th>
												<th>
													Apellidos Profesor
												</th>
												<th>
													Direccion Profesor
												</th>
												<th>
													Telefono Profesor
												</th>
												<th>
													Correo Profesor
												</th>
												<th>
													Accion
												</th>
											</tr>
										</thead>
										<tbody>";
				
				for ( $i = 0; $i < count ( $arProfesores[ "datos" ] ); $i++ ) 
				{
					$tablaProfesores .= "<tr>";
					foreach ( $arProfesores[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave === "idprofesor" )
						{
							$idprofesor = $valor;
						}
						else
						{
							if ( $clave === "nomprofesor" )
							{
								$tablaProfesores .= "<td data-id='$idprofesor'>";
								$tablaProfesores .= $valor;
								$tablaProfesores .= "</td>";
							}
							else
							{
								$tablaProfesores .= "<td>";
								$tablaProfesores .= $valor;
								$tablaProfesores .= "</td>";
							}
						}
					}
					$tablaProfesores .= "<td>";
					$tablaProfesores .= "Editar";
					$tablaProfesores .= "</td>";
					$tablaProfesores .= "</tr>";
				}
				$tablaProfesores .= "</tbody>";
				$tablaProfesores .= "</table>";
			break;
			
			case "001":
				$tablaProfesores = "<table>
										<thead>
											<tr>
												<th>
													DNI Profesor
												</th>
												<th>
													Nombre Profesor
												</th>
												<th>
													Apellidos Profesor
												</th>
												<th>
													Direccion Profesor
												</th>
												<th>
													Telefono Profesor
												</th>
												<th>
													Correo Profesor
												</th>
											</tr>
										</thead>
										<tbody><tr><td colspan='6'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaProfesores = "<div>" .$arProfesores[ "estado" ][ "consulta" ] . "</div>";
				$tablaProfesores .= "<div>" . $arProfesores[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaProfesores .= "<div>" . $arProfesores[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaProfesores[ 0 ] = $arProfesores[ "estado" ][ "codError" ];
		$arTablaProfesores[ 1 ] = $tablaProfesores;
		
		return $arTablaProfesores;
	}
	
	// Inicio Funciones Fotos
	
	/* mod004_obtenerFotosDecanos
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerFotosDecanos.
		-- Argumentos --
			$iddecano							: Es la variable que contiene el id del decano del que deseamos obtener la foto.
		-- Variables principales -- 
			Ninguna
		-- Retorno --
			$arNomFicheroFotoDecano				: Es el array de retorno de mod003_obtenerFotosDecanos.
		-- Funciones a las que llama --
			mod003_obtenerFotosDecanos
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerFotosDecanos( $iddecano )
	{
		$arNomFicheroFotoDecano = mod003_obtenerFotosDecanos( $iddecano );
		
		return $arNomFicheroFotoDecano;
	}
	
	/* mod004_obtenerFotosAlumnos
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerFotosAlumnos.
		-- Argumentos --
			$idalumno							: Es la variable que contiene el id del alumno del que deseamos obtener la foto.
		-- Variables principales -- 
			Ninguna
		-- Retorno --
			$arNomFicheroFotoAlumno				: Es el array de retorno de mod003_obtenerFotosAlumnos.
		-- Funciones a las que llama --
			mod003_obtenerFotosAlumnos
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerFotosAlumnos( $idalumno )
	{
		$arNomFicheroFotoAlumno = mod003_obtenerFotosAlumnos( $idalumno );
		
		return $arNomFicheroFotoAlumno;
	}
	
	/* mod004_obtenerFotosProfesores
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerFotosProfesores.
		-- Argumentos --
			$idprofesor							: Es la variable que contiene el id del profesor del que deseamos obtener la foto.
		-- Variables principales -- 
			Ninguna
		-- Retorno --
			$arNomFicheroFotoProfesor			: Es el array de retorno de mod003_obtenerFotosProfesores.
		-- Funciones a las que llama --
			mod003_obtenerFotosProfesores
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerFotosProfesores( $idprofesor )
	{
		$arNomFicheroFotoProfesor = mod003_obtenerFotosProfesores( $idprofesor );
		
		return $arNomFicheroFotoProfesor;
	}
	
	// Fin Funciones Fotos
	
	// Inicio Funciones Paginacion
	
	/* mod004_obtenerDecanosPaginacion
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerDecanos con los argumentos $pag y $numregistros, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. En el caso 000 asignamos un data-id en la columna nomdecano.
			La cantidad de registros que obtendremos y el registro inicial de los mismos vendrán dados por $pag y $numregistros.
			Además llama a la función mod003_obtenerDecanosTotales con el argumento $numregistros para obtener el número total de decanos para así poder crear un estructura HTML con um menú de paginación.
		-- Argumentos --
			$pag								: Es la variable que contiene el número de página en el que nos encontramos.
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales -- 
			$arDecanosPaginacion				: Es el array de respuesta de la función mod003_obtenerDecanosPaginacion.
			$tablaDecanos						: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arDecanosPaginacion que nos interesen. 
			$totalPaginas						: Es la variable en la que guardamos el número total de páginas que necesitamos para mostrar todos los registros.
		-- Retorno --
			$arTablaDecanos						: Es el array de retorno, en la posicion 0 guardamos el código de error de $arDecanosPaginacion, en la posicion 1 guardamos $tablaDecanos y en la posición 2 la estructura HTML del menú de paginación.
		-- Funciones a las que llama --
			mod003_obtenerDecanosPaginacion
			mod003_obtenerDecanosTotales
		-- Archivos que la llaman --
			main_decanos_paginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerDecanosPaginacion( $pag, $numRegistros ) 
	{
		$arDecanosPaginacion = mod003_obtenerDecanosPaginacion( $pag, $numRegistros );
		
		switch ( $arDecanosPaginacion[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaDecanos = "<table id = 'listadecanos'>
									<thead>
										<tr>
											<th>
												DNI Decano
											</th>
											<th>
												Nombre Decano
											</th>
											<th>
												Apellidos Decano
											</th>
											<th>
												Direccion Decano
											</th>
											<th>
												Telefono Decano
											</th>
											<th>
												Correo Decano
											</th>
										</tr>
									</thead>
									<tbody>";
				
				for ( $i = 0; $i < count ( $arDecanosPaginacion[ "datos" ] ); $i++ ) 
				{
					$tablaDecanos .= "<tr>";
					foreach ( $arDecanosPaginacion[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave === "iddecano" )
						{
							$iddecano = $valor;
						}
						else
						{
							if ( $clave === "nomdecano" )
							{
								$tablaDecanos .= "<td data-id='$iddecano'>";
								$tablaDecanos .= $valor;
								$tablaDecanos .= "</td>";
							}
							else
							{
								$tablaDecanos .= "<td>";
								$tablaDecanos .= $valor;
								$tablaDecanos .= "</td>";
							}
						}
					}
					$tablaDecanos .= "</tr>";
				}
				$tablaDecanos .= "</tbody>";
				$tablaDecanos .= "</table>";
			break;
			
			case "001":
				$tablaDecanos = "<table>
									<thead>
										<tr>
											<th>
												DNI Decano
											</th>
											<th>
												Nombre Decano
											</th>
											<th>
												Apellidos Decano
											</th>
											<th>
												Direccion Decano
											</th>
											<th>
												Telefono Decano
											</th>
											<th>
												Correo Decano
											</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='6'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaDecanos = "<div>" . $arDecanosPaginacion[ "estado" ][ "consulta" ] . "</div>";
				$tablaDecanos .= "<div>" . $arDecanosPaginacion[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaDecanos .= "<div>" . $arDecanosPaginacion[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaDecanos[ 0 ] = $arDecanosPaginacion[ "estado" ][ "codError" ];
		$arTablaDecanos[ 1 ] = $tablaDecanos;
		
		$totalPaginas = mod003_obtenerDecanosTotales( $numRegistros );
	
		$bPrimeraVez = false;
		$arTablaDecanos[ 2 ] = "<div class = 'CajaPaginacion'>";
		for ( $i = 1; $i <= $totalPaginas; $i++ ) 
		{
			if ( !$bPrimeraVez ) 
			{
				$bPrimeraVez = true;
				$arTablaDecanos[ 2 ] .= "<div class = 'Paginacion'>
											-
											<a href='main_decanos_paginacion.php'>$i</a>
											-
										</div>";	
			} 
			else 
			{
				$arTablaDecanos[ 2 ] .= "<div class = 'Paginacion'>
											-
											<a href='main_decanos_paginacion.php?pag=$i'>$i</a>
											-
										</div>";	
			}
		}
		$arTablaDecanos[ 2 ] .= "</div>";
		
		return $arTablaDecanos;
	}
	
	/* mod004_obtenerAlumnosPaginacion
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerAlumnosPaginacion con los argumentos $pag y $numregistros, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. En el caso 000 asignamos un data-id en la columna nomalumno.
			La cantidad de registros que obtendremos y el registro inicial de los mismos vendrán dados por $pag y $numregistros.
			Además llama a la función mod003_obtenerAlumnosTotales con el argumento $numregistros para obtener el número total de decanos para así poder crear un estructura HTML con um menú de paginación.
		-- Argumentos --
			$pag								: Es la variable que contiene el número de página en el que nos encontramos.
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales -- 
			$arAlumnosPaginacion				: Es el array de respuesta de la función mod003_obtenerAlumnosPaginacion.
			$tablaAlumnos						: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arAlumnosPaginacion que nos interesen. 
			$totalPaginas						: Es la variable en la que guardamos el número total de páginas que necesitamos para mostrar todos los registros.
		-- Retorno --
			$arTablaAlumnos						: Es el array de retorno, en la posicion 0 guardamos el código de error de $arAlumnosPaginacion, en la posicion 1 guardamos $tablaAlumnos y en la posición 2 la estructura HTML del menú de paginación.
		-- Funciones a las que llama --
			mod003_obtenerAlumnosPaginacion
			mod003_obtenerAlumnosTotales
		-- Archivos que la llaman --
			main_alumnos_paginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerAlumnosPaginacion( $pag, $numRegistros ) 
	{
		$arAlumnosPaginacion = mod003_obtenerAlumnosPaginacion( $pag, $numRegistros );
		
		switch ( $arAlumnosPaginacion[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaAlumnos = "<table id = 'listaalumnos'>
									<thead>
										<tr>
											<th>
												DNI Alumno
											</th>
											<th>
												Nombre Alumno
											</th>
											<th>
												Apellidos Alumno
											</th>
											<th>
												Direccion Alumno
											</th>
											<th>
												Telefono Alumno
											</th>
											<th>
												Correo Alumno
											</th>
										</tr>
									</thead>
									<tbody>";
				
				for ( $i = 0; $i < count ( $arAlumnosPaginacion[ "datos" ] ); $i++ ) 
				{
					$tablaAlumnos .= "<tr>";
					foreach ( $arAlumnosPaginacion[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave === "idalumno" )
						{
							$idalumno = $valor;
						}
						else
						{
							if ( $clave === "nomalumno" )
							{
								$tablaAlumnos .= "<td data-id='$idalumno'>";
								$tablaAlumnos .= $valor;
								$tablaAlumnos .= "</td>";
							}
							else
							{
								$tablaAlumnos .= "<td>";
								$tablaAlumnos .= $valor;
								$tablaAlumnos .= "</td>";
							}
						}
					}
					$tablaAlumnos .= "</tr>";
				}
				$tablaAlumnos .= "</tbody>";
				$tablaAlumnos .= "</table>";
			break;
			
			case "001":
				$tablaAlumnos = "<table>
									<thead>
										<tr>
											<th>
												DNI Alumno
											</th>
											<th>
												Nombre Alumno
											</th>
											<th>
												Apellidos Alumno
											</th>
											<th>
												Direccion Alumno
											</th>
											<th>
												Telefono Alumno
											</th>
											<th>
												Correo Alumno
											</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='6'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaAlumnos = "<div>" . $arAlumnosPaginacion[ "estado" ][ "consulta" ] . "</div>";
				$tablaAlumnos .= "<div>" . $arAlumnosPaginacion[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaAlumnos .= "<div>" . $arAlumnosPaginacion[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaAlumnos[ 0 ] = $arAlumnosPaginacion[ "estado" ][ "codError" ];
		$arTablaAlumnos[ 1 ] = $tablaAlumnos;
		
		$totalPaginas = mod003_obtenerAlumnosTotales( $numRegistros );
	
		$bPrimeraVez = false;
		$arTablaAlumnos[ 2 ] = "<div class = 'CajaPaginacion'>";
		for ( $i = 1; $i <= $totalPaginas; $i++ ) 
		{
			if ( !$bPrimeraVez ) 
			{
				$bPrimeraVez = true;
				$arTablaAlumnos[ 2 ] .= "<div class = 'Paginacion'>
											-
											<a href='main_alumnos_paginacion.php'>$i</a>
											-
										</div>";	
			} 
			else 
			{
				$arTablaAlumnos[ 2 ] .= "<div class = 'Paginacion'>
											-
											<a href='main_alumnos_paginacion.php?pag=$i'>$i</a>
											-
										</div>";	
			}
		}
		$arTablaAlumnos[ 2 ] .= "</div>";
		
		return $arTablaAlumnos;
	}
	
	/* mod004_obtenerDecanosFacultadPaginacion
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerDecanosFacultadPaginacion con los argumentos $pag y $numregistros, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error.
			La cantidad de registros que obtendremos y el registro inicial de los mismos vendrán dados por $pag y $numregistros.
			Además llama a la función mod003_obtenerDecanosFacultadTotales con el argumento $numregistros para obtener el número total de páginas para así poder crear un estructura HTML con um menú de paginación.
		-- Argumentos --
			$pag								: Es la variable que contiene el número de página en el que nos encontramos.
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales -- 
			$arDecanosFacultadPaginacion		: Es el array de respuesta de la función mod003_obtenerDecanosFacultadPaginacion.
			$tablaDecanosFacultad				: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arDecanosFacultadPaginacion que nos interesen. 
			$totalPaginas						: Es la variable en la que guardamos el número total de páginas que necesitamos para mostrar todos los registros.
		-- Retorno --
			$arTablaDecanosFacultad				: Es el array de retorno, en la posicion 0 guardamos el código de error de $arDecanosFacultadPaginacion, en la posicion 1 guardamos $tablaDecanosFacultad y en la posición 2 la estructura HTML del menú de
												  paginación.
		-- Funciones a las que llama --
			mod003_obtenerDecanosFacultadPaginacion
			mod003_obtenerDecanosFacultadTotales
		-- Archivos que la llaman --
			main_decanos_facultad_paginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerDecanosFacultadPaginacion( $pag, $numRegistros ) 
	{
		$arDecanosFacultadPaginacion = mod003_obtenerDecanosFacultadPaginacion( $pag, $numRegistros );
		
		switch ( $arDecanosFacultadPaginacion[ "estado" ][ "codError" ] )
		{
		
			case "000":
				$tablaDecanosFacultad = "<table>
											<thead>
												<tr>
													<th>
														Nombre Decano
													</th>
													<th>
														Apellidos Decano
													</th>
													<th>
														Nombre Facultad
													</th>
													<th>
														Fecha Inicio Decano
													</th>
													<th>
														Salario Decano
													</th>
												</tr>
											</thead>
											<tbody>";
											
				for ( $i = 0; $i < count ( $arDecanosFacultadPaginacion[ "datos" ] ); $i++ ) 
				{
					$tablaDecanosFacultad .= "<tr>";
					foreach ( $arDecanosFacultadPaginacion[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave !== "iddecano" && $clave !== "idfacultad" )
						{
							$tablaDecanosFacultad .= "<td>";
							$tablaDecanosFacultad .= $valor;
							$tablaDecanosFacultad .= "</td>";
						}
					}
					$tablaDecanosFacultad .= "</tr>";
				}
				$tablaDecanosFacultad .= "</tbody>";
				$tablaDecanosFacultad .= "</table>";
			break;
		
			case "001":
				$tablaDecanosFacultad = "<table>
									<thead>
										<tr>
											<th>
												Nombre Decano
											</th>
											<th>
												Apellidos Decano
											</th>
											<th>
												Nombre Facultad
											</th>
											<th>
												Fecha Inicio Decano
											</th>
											<th>
												Salario Decano
											</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='5'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaDecanosFacultad = "<div>" . $arDecanosFacultadPaginacion[ "estado" ][ "consulta" ] . "</div>";
				$tablaDecanosFacultad .= "<div>" . $arDecanosFacultadPaginacion[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaDecanosFacultad .= "<div>" . $arDecanosFacultadPaginacion[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		
		}
		
		$arTablaDecanosFacultad[ 0 ] = $arDecanosFacultadPaginacion[ "estado" ][ "codError" ];
		$arTablaDecanosFacultad[ 1 ] = $tablaDecanosFacultad;
		
		$totalPaginas = mod003_obtenerDecanosFacultadTotales( $numRegistros );
	
		$bPrimeraVez = false;
		$arTablaDecanosFacultad[ 2 ] = "<div class = 'CajaPaginacion'>";
		for ( $i = 1; $i <= $totalPaginas; $i++ ) 
		{
			if ( !$bPrimeraVez ) 
			{
				$bPrimeraVez = true;
				$arTablaDecanosFacultad[ 2 ] .= "<div class = 'Paginacion'>
													-
													<a href='main_decanos_facultad_paginacion.php'>$i</a>
													-
												</div>";	
			} 
			else 
			{
				$arTablaDecanosFacultad[ 2 ] .= "<div class = 'Paginacion'>
													-
													<a href='main_decanos_facultad_paginacion.php?pag=$i'>$i</a>
													-
												</div>";
			}
		}
		$arTablaDecanosFacultad[ 2 ] .= "</div>";
		
		return $arTablaDecanosFacultad;
	}
	
	/* mod004_obtenerProfesoresPaginacion
	
		-- Descripcion larga --
			Llama a la función mod003_obtenerProfesoresPaginacion con los argumentos $pag y $numregistros, en función del código de error de su array de respuesta crea una tabla con los diferentes registros, si hay resultados ( 000 ) crea una tabla con todos los registros, si no hay resultados ( 001 ) crea una tabla vacía, si la consulta está mal realizada ( 002 ) entonces crea una tabla con la consulta, el código de error SQL y la descripción del error. En el caso 000 asignamos un data-id en la columna nomprofesor.
			La cantidad de registros que obtendremos y el registro inicial de los mismos vendrán dados por $pag y $numregistros.
			Además llama a la función mod003_obtenerProfesoresTotales con el argumento $numregistros para obtener el número total de decanos para así poder crear un estructura HTML con um menú de paginación.
		-- Argumentos --
			$pag								: Es la variable que contiene el número de página en el que nos encontramos.
			$numRegistros						: Es la variable que contiene el número de registros que deseamos tener por página.
		-- Variables principales -- 
			$arProfesoresPaginacion				: Es el array de respuesta de la función mod003_obtenerProfesoresPaginacion.
			$tablaProfesores					: Es la variable de tipo texto en la que guardamos el código HTML junto con los registros de $arProfesoresPaginacion que nos interesen. 
			$totalPaginas						: Es la variable en la que guardamos el número total de páginas que necesitamos para mostrar todos los registros.
		-- Retorno --
			$arTablaProfesores					: Es el array de retorno, en la posicion 0 guardamos el código de error de $arProfesoresPaginacion, en la posicion 1 guardamos $tablaProfesores y en la posición 2 la estructura HTML del menú de paginación.
		-- Funciones a las que llama --
			mod003_obtenerProfesoresPaginacion
			mod003_obtenerProfesoresTotales
		-- Archivos que la llaman --
			main_profesores_paginacion
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_obtenerProfesoresPaginacion( $pag, $numRegistros ) 
	{
		$arProfesoresPaginacion = mod003_obtenerProfesoresPaginacion( $pag, $numRegistros );
		
		switch ( $arProfesoresPaginacion[ "estado" ][ "codError" ] )
		{
			case "000":
				$tablaProfesores = "<table id = 'listaprofesores'>
										<thead>
											<tr>
												<th>
													DNI Profesor
												</th>
												<th>
													Nombre Profesor
												</th>
												<th>
													Apellidos Profesor
												</th>
												<th>
													Direccion Profesor
												</th>
												<th>
													Telefono Profesor
												</th>
												<th>
													Correo Profesor
												</th>
											</tr>
										</thead>
										<tbody>";
				
				for ( $i = 0; $i < count ( $arProfesoresPaginacion[ "datos" ] ); $i++ ) 
				{
					$tablaProfesores .= "<tr>";
					foreach ( $arProfesoresPaginacion[ "datos" ][ $i ] as $clave => $valor )
					{	
						if ( $clave === "idprofesor" )
						{
							$idprofesor = $valor;
						}
						else
						{
							if ( $clave === "nomprofesor" )
							{
								$tablaProfesores .= "<td data-id='$idprofesor'>";
								$tablaProfesores .= $valor;
								$tablaProfesores .= "</td>";
							}
							else
							{
								$tablaProfesores .= "<td>";
								$tablaProfesores .= $valor;
								$tablaProfesores .= "</td>";
							}
						}
					}
					$tablaProfesores .= "</tr>";
				}
				$tablaProfesores .= "</tbody>";
				$tablaProfesores .= "</table>";
			break;
			
			case "001":
				$tablaProfesores = "<table>
										<thead>
											<tr>
												<th>
													DNI Profesor
												</th>
												<th>
													Nombre Profesor
												</th>
												<th>
													Apellidos Profesor
												</th>
												<th>
													Direccion Profesor
												</th>
												<th>
													Telefono Profesor
												</th>
												<th>
													Correo Profesor
												</th>
											</tr>
										</thead>
										<tbody><tr><td colspan='6'>Sin datos</td></tr></tbody>
								</table>";
			break;
			
			case "002":
				$tablaProfesores = "<div>" . $arProfesoresPaginacion[ "estado" ][ "consulta" ] . "</div>";
				$tablaProfesores .= "<div>" . $arProfesoresPaginacion[ "estado" ][ "codErrorSQL" ] . "</div>";
				$tablaProfesores .= "<div>" . $arProfesoresPaginacion[ "estado" ][ "desErrorSQL" ] . "</div>";
			break;
		}
		
		$arTablaProfesores[ 0 ] = $arProfesoresPaginacion[ "estado" ][ "codError" ];
		$arTablaProfesores[ 1 ] = $tablaProfesores;
		
		$totalPaginas = mod003_obtenerProfesoresTotales( $numRegistros );
	
		$bPrimeraVez = false;
		$arTablaProfesores[ 2 ] = "<div class = 'CajaPaginacion'>";
		for ( $i = 1; $i <= $totalPaginas; $i++ ) 
		{
			if ( !$bPrimeraVez ) 
			{
				$bPrimeraVez = true;
				$arTablaProfesores[ 2 ] .= "<div class = 'Paginacion'>
											-
											<a href='main_profesores_paginacion.php'>$i</a>
											-
										</div>";	
			} 
			else 
			{
				$arTablaProfesores[ 2 ] .= "<div class = 'Paginacion'>
											-
											<a href='main_profesores_paginacion.php?pag=$i'>$i</a>
											-
										</div>";	
			}
		}
		$arTablaProfesores[ 2 ] .= "</div>";
		
		return $arTablaProfesores;
	}
	
	// Fin Funciones Paginacion
	
	// Inicio Funciones Inserciones
	
	/* mod004_insertarAlumno
	
		-- Descripcion larga --
			Llama a la función mod003_insertarAlumno con los argumentos $dnialumno, $nomalumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno y en base a su array de respuesta crea una estructura HTML llamada $tabla con dichos registros. En la columna nombre alumno crea un data-id con con la variable $idalumno obtenida de arInsertarAlumno.
		-- Argumentos --
			$dnialumno							: Es la variable que contiene el dni del alumno que queremos introducir.
			$nombrealumno						: Es la variable que contiene el nombre del alumno que queremos introducir.
			$apellidosalumno					: Es la variable que contiene los apellidos del alumno que queremos introducir.
			$direccionalumno					: Es la variable que contiene la direccion del alumno que queremos introducir.
			$telefonoalumno						: Es la variable que contiene el telefono del alumno que queremos introducir.
			$correoalumno						: Es la variable que contiene el correo del alumno que queremos introducir.
			$imagenalumno						: Es la variable que contiene la imagen del alumno que queremos introducir.
		-- Variables principales -- 
			$arInsertarAlumno					: Es el array de respuesta de la función mod003_insertarAlumno.
		-- Retorno --
			$tabla								: Es la estructura HTML en la que representamos los registros de $arInsertarAlumno.
		-- Funciones a las que llama --
			mod003_insertarAlumno
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_insertarAlumno( $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno )
	{
		$arInsertarAlumno = mod003_insertarAlumno( $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno );
		
		$idalumno = $arInsertarAlumno[ "datos" ][ 0 ][ "idAlumnoNuevo" ];
		
		$tabla = "";
		
		$tabla .= "<tr>";
		$tabla .=	"<td>";
		$tabla .=		$dnialumno;
		$tabla .=	"</td>";
		$tabla .=	"<td data-id='$idalumno'>";
		$tabla .=		$nombrealumno;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$apellidosalumno;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$direccionalumno;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$telefonoalumno;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$correoalumno;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		"Editar";
		$tabla .=	"</td>";
		$tabla .= "</tr>";
		
		return $tabla;
	}
	
	/* mod004_insertarProfesor
	
		-- Descripcion larga --
			Llama a la función mod003_insertarProfesor con los argumentos $dniprofesor, $nomprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor y en base a su array de respuesta crea una estructura HTML llamada $tabla con dichos registros. En la columna nombre profesor crea un data-id con la variable $idprofesor obtenida de $arInsertarProfesor.
		-- Argumentos --
			$dniprofesor						: Es la variable que contiene el dni del profesor que queremos introducir.
			$nombreprofesor						: Es la variable que contiene el nombre del profesor que queremos introducir.
			$apellidosprofesor					: Es la variable que contiene los apellidos del profesor que queremos introducir.
			$direccionprofesor					: Es la variable que contiene la direccion del profesor que queremos introducir.
			$telefonoprofesor					: Es la variable que contiene el telefono del profesor que queremos introducir.
			$correoprofesor						: Es la variable que contiene el correo del profesor que queremos introducir.
			$imagenprofesor						: Es la variable que contiene la imagen del profesor que queremos introducir.
		-- Variables principales -- 
			$arInsertarProfesor					: Es el array de respuesta de la función mod003_insertarProfesor.
		-- Retorno --
			$tabla								: Es la estructura HTML en la que representamos los registros de $arInsertarProfesor.
		-- Funciones a las que llama --
			mod003_insertarProfesor
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_insertarProfesor( $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor )
	{
		$arInsertarProfesor = mod003_insertarProfesor( $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor );
		
		$idprofesor = $arInsertarProfesor[ "datos" ][ 0 ][ "idProfesorNuevo" ];
		
		$tabla = "";
		
		$tabla .= "<tr>";
		$tabla .=	"<td>";
		$tabla .=		$dniprofesor;
		$tabla .=	"</td>";
		$tabla .=	"<td data-id='$idprofesor'>";
		$tabla .=		$nombreprofesor;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$apellidosprofesor;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$direccionprofesor;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$telefonoprofesor;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$correoprofesor;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		"Editar";
		$tabla .=	"</td>";
		$tabla .= "</tr>";
		
		return $tabla;
	}
	
	/* mod004_insertarDecano
	
		-- Descripcion larga --
			Llama a la función mod003_insertarDecano con los argumentos $dnidecano, $nomdecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano y en base a su array de respuesta crea una estructura HTML llamada $tabla con dichos registros. En la columna nombre decano crea un data-id con la variable $iddecano obtenida de $arInsertarDecano.
		-- Argumentos --
			$dnidecano							: Es la variable que contiene el dni del decano que queremos introducir.
			$nombredecano						: Es la variable que contiene el nombre del decano que queremos introducir.
			$apellidosdecano					: Es la variable que contiene los apellidos del decano que queremos introducir.
			$direcciondecano					: Es la variable que contiene la direccion del decano que queremos introducir.
			$telefonodecano						: Es la variable que contiene el telefono del decano que queremos introducir.
			$correodecano						: Es la variable que contiene el correo del decano que queremos introducir.
			$imagendecano						: Es la variable que contiene la imagen del decano que queremos introducir.
		-- Variables principales -- 
			$arInsertarDecano					: Es el array de respuesta de la función mod003_insertarDecano.
		-- Retorno --
			$tabla								: Es la estructura HTML en la que representamos los registros de $arInsertarDecano.
		-- Funciones a las que llama --
			mod003_insertarDecano
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_insertarDecano( $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano )
	{
		$arInsertarDecano = mod003_insertarDecano( $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano );
		
		$iddecano = $arInsertarDecano[ "datos" ][ 0 ][ "idDecanoNuevo" ];
		
		$tabla = "";
		
		$tabla .= "<tr>";
		$tabla .=	"<td>";
		$tabla .=		$dnidecano;
		$tabla .=	"</td>";
		$tabla .=	"<td data-id='$iddecano'>";
		$tabla .=		$nombredecano;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$apellidosdecano;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$direcciondecano;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$telefonodecano;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		$correodecano;
		$tabla .=	"</td>";
		$tabla .=	"<td>";
		$tabla .=		"Editar";
		$tabla .=	"</td>";
		$tabla .= "</tr>";
		
		return $tabla;
	}
	
	// Fin Funciones Inserciones
	
	// Inicio Funciones Ediciones
	
	/* mod004_editarAlumno
	
		-- Descripcion larga --
			Llama a la función mod003_editarAlumno para pasarla los argumentos que queremos actualizar en la tabla correspondiente.
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
			$arEdicionAlumno					: Es el array resultado de llamar a la función mod003_editarAlumno, contiene información de los posibles errores al actualizar los registros.
		-- Funciones a las que llama --
			mod003_editarAlumno
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_editarAlumno( $idalumno, $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno )
	{
		$arEdicionAlumno = mod003_editarAlumno( $idalumno, $dnialumno, $nombrealumno, $apellidosalumno, $direccionalumno, $telefonoalumno, $correoalumno, $imagenalumno );
		
		return $arEdicionAlumno;
	}
	
	/* mod004_editarProfesor
	
		-- Descripcion larga --
			Llama a la función mod003_editarProfesor para pasarla los argumentos que queremos actualizar en la tabla correspondiente.
		-- Argumentos --
			$idalumno							: Es la variable que contiene el id del profesor que queremos actualizar.
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
			$arEdicionProfesor					: Es el array resultado de llamar a la función mod003_editarProfesor, contiene información de los posibles errores al actualizar los registros.
		-- Funciones a las que llama --
			mod003_editarProfesor
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_editarProfesor( $idprofesor, $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor )
	{
		$arEdicionProfesor = mod003_editarProfesor( $idprofesor, $dniprofesor, $nombreprofesor, $apellidosprofesor, $direccionprofesor, $telefonoprofesor, $correoprofesor, $imagenprofesor );
		
		return $arEdicionProfesor;
	}
	
	/* mod004_editarDecano
	
		-- Descripcion larga --
			Llama a la función mod003_editarDecano para pasarla los argumentos que queremos actualizar en la tabla correspondiente.
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
			$arEdicionDecano					: Es el array resultado de llamar a la función mod003_editarDecano, contiene información de los posibles errores al actualizar los registros.
		-- Funciones a las que llama --
			mod003_editarDecano
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_editarDecano( $iddecano, $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano )
	{
		$arEdicionDecano = mod003_editarDecano( $iddecano, $dnidecano, $nombredecano, $apellidosdecano, $direcciondecano, $telefonodecano, $correodecano, $imagendecano );
		
		return $arEdicionDecano;
	}
	
	// Fin Funciones Ediciones
	
	// Inicio Funciones Búsqueda
	
	/* mod004_buscarAlumno
	
		-- Descripcion larga --
			Llama a la función mod003_buscarAlumno con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarAlumno						: Es el array resultado de llamar a la función mod003_buscarAlumno, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod003_buscarAlumno
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_buscarAlumno( $busqueda )
	{
		$arBuscarAlumno = mod003_buscarAlumno( $busqueda );
		
		return $arBuscarAlumno;
	}
	
	/* mod004_buscarProfesor
	
		-- Descripcion larga --
			Llama a la función mod003_buscarProfesor con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarProfesor					: Es el array resultado de llamar a la función mod003_buscarProfesor, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod003_buscarProfesor
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_buscarProfesor( $busqueda )
	{
		$arBuscarProfesor = mod003_buscarProfesor( $busqueda );
		
		return $arBuscarProfesor;
	}
	
	/* mod004_buscarDecano
	
		-- Descripcion larga --
			Llama a la función mod003_buscarDecano con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarDecano						: Es el array resultado de llamar a la función mod003_buscarDecano, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod003_buscarDecano
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_buscarDecano( $busqueda )
	{
		$arBuscarDecano = mod003_buscarDecano( $busqueda );
		
		return $arBuscarDecano;
	}
	
	/* mod004_buscarFacultad
	
		-- Descripcion larga --
			Llama a la función mod003_buscarFacultad con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarFacultad					: Es el array resultado de llamar a la función mod003_buscarFacultad, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod003_buscarFacultad
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_buscarFacultad( $busqueda )
	{
		$arBuscarFacultad = mod003_buscarFacultad( $busqueda );
		
		return $arBuscarFacultad;
	}
	
	/* mod004_buscarCarrera
	
		-- Descripcion larga --
			Llama a la función mod003_buscarCarrera con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarCarrera					: Es el array resultado de llamar a la función mod003_buscarCarrera, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod003_buscarCarrera
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_buscarCarrera( $busqueda )
	{
		$arBuscarCarrera = mod003_buscarCarrera( $busqueda );
		
		return $arBuscarCarrera;
	}
	
	/* mod004_buscarAsignatura
	
		-- Descripcion larga --
			Llama a la función mod003_buscarAsignatura con el argumento $busqueda.
		-- Argumentos --
			$busqueda							: Es la variable que contiene el texto sobre el que queremos encontrar coincidencias.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arBuscarAsignatura					: Es el array resultado de llamar a la función mod003_buscarAsignatura, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod003_buscarAsignatura
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_buscarAsignatura( $busqueda )
	{
		$arBuscarAsignatura = mod003_buscarAsignatura( $busqueda );
		
		return $arBuscarAsignatura;
	}
	
	// Fin Funciones Búsqueda
	
	// Inicio Funciones Registro e Iniciar Sesion
	
	/* mod004_registrarUsuario
	
		-- Descripcion larga --
			Llama a la función mod003_registrarUsuario con los argumentos $nomusuario, $correousuario, $contrasennausuario.
		-- Argumentos --
			$nomusuario							: Es la variable que contiene el nombre del usuario que queremos introducir.
			$correousuario						: Es la variable que contiene el correo del usuario que queremos introducir.
			$contrasennausuario					: Es la variable que contiene la contraseña del usuario que queremos introducir.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arRegistroUsuario					: Es el array resultado de llamar a la función mod003_registrarUsuario, contiene aquellos resultados del registro ó información de los errores.
		-- Funciones a las que llama --
			mod003_registrarUsuario
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_registrarUsuario( $nomusuario, $correousuario, $contrasennausuario )
	{
		$arRegistroUsuario = mod003_registrarUsuario( $nomusuario, $correousuario, $contrasennausuario );
		
		return $arRegistroUsuario;
	}
	
	/* mod004_iniciarSesionUsuario
	
		-- Descripcion larga --
			Llama a la función mod003_iniciarSesionUsuario con los argumentos $correousuario y $contrasennausuario.
		-- Argumentos --
			$correousuario						: Es la variable que contiene el correo del usuario que queremos comprobar si existe.
			$contrasennausuario					: Es la variable que contiene la contraseña del usuario que queremos comprobar si existe.
		-- Variables principales --            
			Ninguna
		-- Retorno --
			$arIniciarSesionUsuario				: Es el array resultado de llamar a la función mod003_iniciarSesionUsuario, contiene aquellos resultados de la búsqueda ó información de los errores.
		-- Funciones a las que llama --
			mod003_iniciarSesionUsuario
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_iniciarSesionUsuario( $correousuario, $contrasennausuario)
	{
		$arIniciarSesionUsuario = mod003_iniciarSesionUsuario( $correousuario, $contrasennausuario );
		
		return $arIniciarSesionUsuario;
	}
	
	/* mod004_iniciarSesionUsuario
	
		-- Descripcion larga --
			Llama a la función mod003_cerrarSesionUsuario.
		-- Argumentos --
			Ninguno
		-- Variables principales --            
			Ninguna
		-- Retorno --
			Ninguno
		-- Funciones a las que llama --
			mod003_cerrarSesionUsuario
		-- Archivos que la llaman --
			main_ajax
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod004_cerrarSesionUsuario()
	{
		mod003_cerrarSesionUsuario();
	}
	
	// Fin Funciones Registro e Iniciar Sesion
	
?>
