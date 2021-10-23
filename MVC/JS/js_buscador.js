
function buscador()
{	
	$( "input[name='boton_busqueda']" ).on
	({ 
		"click": function( event ) 
		{
			busqueda = $( "input[name='texto_busqueda']" ).val();
			
			datos =	{	
						"accion" : "buscar", 
						"busqueda" : busqueda
					};
			$.ajax 
			({
				type: "POST",
				url: "AJAX/main_ajax.php",
				data: datos,
				error: function() 
				{
					alert ( "Se ha producido un error." );
				},
				success: function ( data, textStatus ) 
				{
					
					var arBusqueda = JSON.parse( data );
				
					layer2 = "<div class='overlay2'>";
					layer2 += 	"<div class = 'caja_busqueda'>";
					
					
					layer2 += 		"<div class = 'titulo_busqueda'><h2>Alumnos</h2></div>";
					if ( arBusqueda[ 0 ][ "estado" ][ "codError" ] === "000" )
					{
						for ( i = 0; i < arBusqueda[ 0 ][ "datos" ].length; i++ )
						{
							layer2 += 		"<div class = 'caja_busqueda2'>";
							layer2 +=			"<div class = 'imagen_busqueda'><img src = '" + arBusqueda[ 0 ][ "datos" ][ i ][ "nomficherofotoalumno" ] + "'/></div>";
							layer2 +=			"<div class = 'datos_busqueda'>";
							layer2 +=				"<div><li>DNI Alumno: " + arBusqueda[ 0 ][ "datos" ][ i ][ "dnialumno" ] + "</li></div>";
							layer2 +=				"<div><li>Nombre Alumno: " + arBusqueda[ 0 ][ "datos" ][ i ][ "nomalumno" ] + "</li></div>";
							layer2 +=				"<div><li>Apellidos Alumno: " + arBusqueda[ 0 ][ "datos" ][ i ][ "apellidosalumno" ] + "</li></div>";
							layer2 +=				"<div><li>Dirección Alumno: " + arBusqueda[ 0 ][ "datos" ][ i ][ "direccionalumno" ] + "</li></div>";
							layer2 +=				"<div><li>Teléfono Alumno: " + arBusqueda[ 0 ][ "datos" ][ i ][ "telefonoalumno" ] + "</li></div>";
							layer2 +=				"<div><li>Correo Alumno: " + arBusqueda[ 0 ][ "datos" ][ i ][ "correoalumno" ] + "</li></div>";
							layer2 +=			"</div>";
							layer2 += 		"</div>";
						}
					}
					else
					{
						layer2 += 		"<div class = 'caja_busqueda2'>";
						layer2 += 			"Sin Datos";
						layer2 +=		"</div>";
					}
					
					layer2 += 		"<div class = 'titulo_busqueda'><h2>Profesores</h2></div>";
					if ( arBusqueda[ 1 ][ "estado" ][ "codError" ] === "000" )
					{
						for ( i = 0; i < arBusqueda[ 1 ][ "datos" ].length; i++ )
						{
							layer2 += 		"<div class = 'caja_busqueda2'>";
							layer2 +=			"<div class = 'imagen_busqueda'><img src = '" + arBusqueda[ 1 ][ "datos" ][ i ][ "nomficherofotoprofesor" ] + "'/></div>";
							layer2 +=			"<div class = 'datos_busqueda'>";
							layer2 +=				"<div><li>DNI Profesor: " + arBusqueda[ 1 ][ "datos" ][ i ][ "dniprofesor" ] + "</li></div>";
							layer2 +=				"<div><li>Nombre Profesor: " + arBusqueda[ 1 ][ "datos" ][ i ][ "nomprofesor" ] + "</li></div>";
							layer2 +=				"<div><li>Apellidos Profesor: " + arBusqueda[ 1 ][ "datos" ][ i ][ "apellidosprofesor" ] + "</li></div>";
							layer2 +=				"<div><li>Dirección Profesor: " + arBusqueda[ 1 ][ "datos" ][ i ][ "direccionprofesor" ] + "</li></div>";
							layer2 +=				"<div><li>Teléfono Profesor: " + arBusqueda[ 1 ][ "datos" ][ i ][ "telefonoprofesor" ] + "</li></div>";
							layer2 +=				"<div><li>Correo Profesor: " + arBusqueda[ 1 ][ "datos" ][ i ][ "correoprofesor" ] + "</li></div>";
							layer2 +=			"</div>";
							layer2 += 		"</div>";
						}
					}
					else
					{
						layer2 += 		"<div class = 'caja_busqueda2'>";
						layer2 += 			"Sin Datos";
						layer2 +=		"</div>";
					}
					
					layer2 += 		"<div class = 'titulo_busqueda'><h2>Decanos</h2></div>";
					if ( arBusqueda[ 2 ][ "estado" ][ "codError" ] === "000" )
					{
						for ( i = 0; i < arBusqueda[ 2 ][ "datos" ].length; i++ )
						{
							layer2 += 		"<div class = 'caja_busqueda2'>";
							layer2 +=			"<div class = 'imagen_busqueda'><img src = '" + arBusqueda[ 2 ][ "datos" ][ i ][ "nomficherofotodecano" ] + "'/></div>";
							layer2 +=			"<div class = 'datos_busqueda'>";
							layer2 +=				"<div><li>DNI Decano: " + arBusqueda[ 2 ][ "datos" ][ i ][ "dnidecano" ] + "</li></div>";
							layer2 +=				"<div><li>Nombre Decano: " + arBusqueda[ 2 ][ "datos" ][ i ][ "nomdecano" ] + "</li></div>";
							layer2 +=				"<div><li>Apellidos Decano: " + arBusqueda[ 2 ][ "datos" ][ i ][ "apellidosdecano" ] + "</li></div>";
							layer2 +=				"<div><li>Dirección Decano: " + arBusqueda[ 2 ][ "datos" ][ i ][ "direcciondecano" ] + "</li></div>";
							layer2 +=				"<div><li>Teléfono Decano: " + arBusqueda[ 2 ][ "datos" ][ i ][ "telefonodecano" ] + "</li></div>";
							layer2 +=				"<div><li>Correo Decano: " + arBusqueda[ 2 ][ "datos" ][ i ][ "correodecano" ] + "</li></div>";
							layer2 +=			"</div>";
							layer2 += 		"</div>";
						}
					}
					else
					{
						layer2 += 		"<div class = 'caja_busqueda2'>";
						layer2 += 			"Sin Datos";
						layer2 +=		"</div>";
					}
					
					layer2 += 		"<div class = 'titulo_busqueda'><h2>Facultades</h2></div>";
					if ( arBusqueda[ 3 ][ "estado" ][ "codError" ] === "000" )
					{
						for ( i = 0; i < arBusqueda[ 3 ][ "datos" ].length; i++ )
						{
							layer2 += 		"<div class = 'caja_busqueda2'>";
							layer2 +=			"<div class = 'imagen_busqueda'><img src = '" + arBusqueda[ 3 ][ "datos" ][ i ][ "nomficherofotofacultad" ] + "'/></div>";
							layer2 +=			"<div class = 'datos_busqueda'>";
							layer2 +=				"<div><li>Nombre Facultad: <a href='main_carreras.php?idfacultad=" + arBusqueda[ 3 ][ "datos" ][ i ][ "idfacultad" ] + "'>" + arBusqueda[ 3 ][ "datos" ][ i ][ "nomfacultad" ] + "</a></li></div>";
							layer2 +=				"<div><li>Dirección Facultad: " + arBusqueda[ 3 ][ "datos" ][ i ][ "direccionfacultad" ] + "</li></div>";
							layer2 +=			"</div>";
							layer2 += 		"</div>";
						}
					}
					else
					{
						layer2 += 		"<div class = 'caja_busqueda2'>";
						layer2 += 			"Sin Datos";
						layer2 +=		"</div>";
					}
					
					layer2 += 		"<div class = 'titulo_busqueda'><h2>Carreras</h2></div>";
					if ( arBusqueda[ 4 ][ "estado" ][ "codError" ] === "000" )
					{
						for ( i = 0; i < arBusqueda[ 4 ][ "datos" ].length; i++ )
						{
							layer2 += 		"<div class = 'caja_busqueda2'>";
							layer2 +=			"<div class = 'imagen_busqueda'><img src = '" + arBusqueda[ 4 ][ "datos" ][ i ][ "nomficherofotocarrera" ] + "'/></div>";
							layer2 +=			"<div class = 'datos_busqueda'>";
							layer2 +=				"<div><li>Nombre Carrera: <a href='main_asignaturas.php?idcarrera=" + arBusqueda[ 4 ][ "datos" ][ i ][ "idcarrera" ] + "&idfacultad=" + arBusqueda[ 4 ][ "datos" ][ i ][ "idfacultad" ] + "'>" + arBusqueda[ 4 ][ "datos" ][ i ][ "nomcarrera" ] + "</a></li></div>";
							layer2 +=			"</div>";
							layer2 += 		"</div>";
						}
					}
					else
					{
						layer2 += 		"<div class = 'caja_busqueda2'>";
						layer2 += 			"Sin Datos";
						layer2 +=		"</div>";
					}
					
					layer2 += 		"<div class = 'titulo_busqueda'><h2>Asignaturas</h2></div>";
					if ( arBusqueda[ 5 ][ "estado" ][ "codError" ] === "000" )
					{
						for ( i = 0; i < arBusqueda[ 5 ][ "datos" ].length; i++ )
						{
							layer2 += 		"<div class = 'caja_busqueda2'>";
							layer2 +=			"<div class = 'datos_busqueda'>";
							layer2 +=				"<div><li>Nombre Asignatura: " + arBusqueda[ 5 ][ "datos" ][ i ][ "nomasignatura" ] + "</div>";
							layer2 +=				"<div><li>Curso Asignatura: " + arBusqueda[ 5 ][ "datos" ][ i ][ "nomcurso" ] + "</li></div>";
							layer2 +=				"<div><li>Créditos Asignatura: " + arBusqueda[ 5 ][ "datos" ][ i ][ "numcreditos" ] + "</li></div>";
							layer2 +=				"<div><li>Vigencia Asignatura: " + arBusqueda[ 5 ][ "datos" ][ i ][ "vigencia" ] + "</li></div>";
							layer2 +=				"<div><li>Nombre Carrera: " + arBusqueda[ 5 ][ "datos" ][ i ][ "nomcarrera" ] + "</li></div>";
							layer2 +=			"</div>";
							layer2 += 		"</div>";
						}
					}
					else
					{
						layer2 += 		"<div class = 'caja_busqueda2'>";
						layer2 += 			"Sin Datos";
						layer2 +=		"</div>";
					}
					
					layer2 += 	"</div>";
					layer2 += "</div>";
					
					$(".main").addClass( "oculto" );
					
					$( "body" ).append( layer2 );
			
					$( ".overlay2" ).on
					({ 
						"click": function() 
						{
							$( this ).remove();
							$(".main").removeClass( "oculto" );
							$( "input[name='texto_busqueda']" ).val("");
						}	
					});
					
					$( ".caja_busqueda" ).on
					({ 
						"click": function( event ) 
						{
							event.stopPropagation();
						}
						
					});
				} 
			});
		}
	});
}
