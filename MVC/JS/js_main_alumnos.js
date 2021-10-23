
function obtenerFotoAlumno( idalumno )
{
	datos =	{ "accion" : "obtenerImagAlumno", "idalumno" : idalumno };
						
	$.ajax 
	( {
		type: "POST",
		url: "AJAX/main_ajax.php",
		data: datos,
		error: function() 
		{
			alert ( "Se ha producido un error." );
		},
		success: function ( data, textStatus ) 
		{
			var arNomFicheroFotoAlumno;
			arNomFicheroFotoAlumno = JSON.parse( data );
			
			switch ( arNomFicheroFotoAlumno[ "estado" ][ "codError" ] ) 
			{
				case "000":
				case "001":
					layer = "<div class='overlay'>";
					layer += 	"<div class='subwrapper'>";
					layer += 		"<img src='" + arNomFicheroFotoAlumno[ "datos" ][ 0 ][ "nomficherofotoalumno" ] + "' class='anchura100' />";
					layer += 	"</div>";
					layer += "</div>";
					
					$( "body" ).append( layer );
			
					$( ".overlay" ).on
					( { 
						"click": function() 
						{
							$( this ).remove();
						}	
					});
				break;
				case "002":
				break;
			}
		}
	});
}

function formularioAlumnos()
{
	$( "a[ href='#altaalumno' ]" ).on
	({ 
		"click": function( event ) 
		{
			event.preventDefault(); 
			$( ".wrapper" ).removeClass( "ocultoDI" );
		}
		
	});
	
	$( ".wrapper" ).on
	({ 
		"click": function( event ) 
		{
			event.stopPropagation();
			$( this ).addClass( "ocultoDI" );
			
			$( "input[ name='dnialumno' ]" ).val( "" );
			$( "input[ name='nombrealumno' ]" ).val( "" );
			$( "input[ name='apellidosalumno' ]" ).val( "" );
			$( "input[ name='direccionalumno' ]" ).val( "" );
			$( "input[ name='telefonoalumno' ]" ).val( "" );
			$( "input[ name='correoalumno' ]" ).val( "" );
			$( "input[ name='imagenalumno' ]" ).val( "" );
			let mensaje1 = "";
			let mensaje2 = "";
			let mensaje3 = "";	
			let mensaje4 = "";	
			let mensaje5 = "";	
			let mensaje6 = "";	
			let mensaje7 = "";	
			layermsg1.innerHTML = mensaje1;
			layermsg2.innerHTML = mensaje2;
			layermsg3.innerHTML = mensaje3;
			layermsg4.innerHTML = mensaje4;
			layermsg5.innerHTML = mensaje5;
			layermsg6.innerHTML = mensaje6;
			layermsg7.innerHTML = mensaje7;
		}
		
	});
	
	$( ".wrapper .formulario" ).on
	({ 
		"click": function( event ) 
		{
			event.stopPropagation();
		}
		
	});
	
	$( ".wrapper .formulario input[ type='button' ] " ).on
	({ 
		"click": function( event ) 
		{
			
			let retorno = true;
			let mensaje1 = "";
			let mensaje2 = "";
			let mensaje3 = "";	
			let mensaje4 = "";	
			let mensaje5 = "";	
			let mensaje6 = "";	
			let mensaje7 = "";	
			let dnialumno = $( ".wrapper .formulario input[ name='dnialumno' ]" ).val();
			let nombrealumno = $( ".wrapper .formulario input[ name='nombrealumno' ]" ).val();
			let apellidosalumno = $( ".wrapper .formulario input[ name='apellidosalumno' ]" ).val();
			let direccionalumno = $( ".wrapper .formulario input[ name='direccionalumno' ]" ).val();
			let telefonoalumno = $( ".wrapper .formulario input[ name='telefonoalumno' ]" ).val();
			let correoalumno = $( ".wrapper .formulario input[ name='correoalumno' ]" ).val();
			let imagenalumno = $( ".wrapper .formulario input[ name='imagenalumno' ]" ).val();
								
			if ( dnialumno.length === 0 ) 
			{
				mensaje1 += "<p>El DNI del alumno está vacío</p>";
				retorno = false;
			}
			if ( dnialumno.trim().length === 0 ) 
			{
				mensaje1 += "<p>No puedes teclear solo espacios en blanco en el DNI del alumno</p>";
				retorno = false;
			}
			if ( nombrealumno.length === 0 ) 
			{
				mensaje2 += "<p>El nombre del alumno está vacío</p>";
				retorno2 = false;
			}
			if ( nombrealumno.trim().length === 0 ) 
			{
				mensaje2 += "<p>No puedes teclear solo espacios en blanco en el nombre del alumno</p>";
				retorno = false;
			}
			if ( apellidosalumno.length === 0 ) 
			{
				mensaje3 += "<p>Los apellidos del alumno están vacíos</p>";
				retorno = false;
			}
			if ( apellidosalumno.trim().length === 0 ) 
			{
				mensaje3 += "<p>No puedes teclear sólo espacios en blanco en los apellidos del alumno</p>";
				retorno = false;
			}
			if ( direccionalumno.length === 0 ) 
			{
				mensaje4 += "<p>La dirección del alumno está vacía</p>";
				retorno = false;
			}
			if ( direccionalumno.trim().length === 0 ) 
			{
				mensaje4 += "<p>No puedes teclear solo espacios en blanco en la dirección del alumno</p>";
				retorno = false;
			}
			if ( telefonoalumno.length === 0 ) 
			{
				mensaje5 += "<p>El teléfono del alumno está vacío</p>";
				retorno = false;
			}
			if ( telefonoalumno.trim().length === 0 ) 
			{
				mensaje5 += "<p>No puedes teclear solo espacios en blanco en el teléfono del alumno</p>";
				retorno = false;
			}
			if ( correoalumno.length === 0 ) 
			{
				mensaje6 += "<p>El correo del alumno está vacío</p>";
				retorno = false;
			}
			if ( correoalumno.trim().length === 0 ) 
			{
				mensaje6 += "<p>No puedes teclear solo espacios en blanco en el correo del alumno</p>";
				retorno = false;
			}
			if ( imagenalumno.length === 0 ) 
			{
				mensaje7 += "<p>La imagen del alumno está vacía</p>";
				retorno = false;
			}
			if ( imagenalumno.trim().length === 0 ) 
			{
				mensaje7 += "<p>No puedes teclear solo espacios en blanco en la imagen del alumno</p>";
				retorno = false;
			}
			if ( !retorno ) 
			{
				layermsg1.innerHTML = mensaje1;
				layermsg2.innerHTML = mensaje2;
				layermsg3.innerHTML = mensaje3;
				layermsg4.innerHTML = mensaje4;
				layermsg5.innerHTML = mensaje5;
				layermsg6.innerHTML = mensaje6;
				layermsg7.innerHTML = mensaje7;
			}
			
			if ( retorno ) 
			{
				datos =	{	
							"accion" : "insertarAlumno", 
							"dnialumno" : dnialumno, 
							"nombrealumno" : nombrealumno,  
							"apellidosalumno" : apellidosalumno,
							"direccionalumno" : direccionalumno,
							"telefonoalumno" : telefonoalumno,
							"correoalumno" : correoalumno,
							"imagenalumno" : imagenalumno 
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
						let bInsertado = false;
						
						if ( !bInsertado )
						{ 
							$( data.trim() ).insertAfter( "table#listaalumnos tbody tr:last-child" );
							
							$( "#listaalumnos tbody tr:last-child td:nth-child( 2 )" ).on
							( { 
								"click": function() 
								{
									obtenerFotoAlumno( $( this ).attr( 'data-id' ) );
								}
							});
							
							$( "#listaalumnos tbody tr:last-child td:last-child" ).on
							( { 
								"click": function() 
								{
									edicionAlumnos("#listaalumnos tbody tr:last-child td:last-child");
								}
							});
						}

						$( "input[ name='dnialumno' ]" ).val( "" );
						$( "input[ name='nombrealumno' ]" ).val( "" );
						$( "input[ name='apellidosalumno' ]" ).val( "" );
						$( "input[ name='direccionalumno' ]" ).val( "" );
						$( "input[ name='telefonoalumno' ]" ).val( "" );
						$( "input[ name='correoalumno' ]" ).val( "" );
						$( "input[ name='imagenalumno' ]" ).val( "" );
						
						
						$( ".wrapper" ).trigger( "click" );
						
					}   
				});
			} 
		}
	});
}

function edicionAlumnos(posicion)
{
	$( ".wrapper2" ).on
	({ 
		"click": function( event ) 
		{
			event.stopPropagation();
			$( this ).addClass( "ocultoDI2" );
			
			let mensaje1 = "";
			let mensaje2 = "";
			let mensaje3 = "";	
			let mensaje4 = "";	
			let mensaje5 = "";	
			let mensaje6 = "";	
			let mensaje7 = "";	
			layermsg1_2.innerHTML = mensaje1;
			layermsg2_2.innerHTML = mensaje2;
			layermsg3_2.innerHTML = mensaje3;
			layermsg4_2.innerHTML = mensaje4;
			layermsg5_2.innerHTML = mensaje5;
			layermsg6_2.innerHTML = mensaje6;
			layermsg7_2.innerHTML = mensaje7;
		}
	});
	
	$( ".wrapper2 .formulario2" ).on
	({ 
		"click": function( event ) 
		{
			event.stopPropagation();
		}
	});
	
	$( posicion ).on
	({ 
		"click": function( event ) 
		{
			event.preventDefault(); 
			$( ".wrapper2" ).removeClass( "ocultoDI2" );
			
			let idalumno, dnialumno, nombrealumno, apellidosalumno, direccionalumno, telefonoalumno, correoalumno;
			
			nodo = $( this ).parent();
			
			$( nodo ).children( "td" ).each( function( index ) 
			{
				switch ( index ) 
				{
					case 0:
						dnialumno = $( this ).html();
					break;
					case 1:
						idalumno = $( this ).attr( "data-id" );	
						nombrealumno = $( this ).html();
					break;
					case 2:
						apellidosalumno = $( this ).html();
					break;
					case 3:
						direccionalumno = $( this ).html();
					break;
					case 4:
						telefonoalumno = $( this ).html();
					break;
					case 5:
						correoalumno = $( this ).html();
					break;
				}
			});
			
			$( "input[ name='dnialumno2' ]" ).val( dnialumno );
			$( "input[ name='dnialumno2' ]" ).attr( "data-id", idalumno );
			$( "input[ name='nombrealumno2' ]" ).val( nombrealumno );
			$( "input[ name='apellidosalumno2' ]" ).val( apellidosalumno );
			$( "input[ name='direccionalumno2' ]" ).val( direccionalumno );
			$( "input[ name='telefonoalumno2' ]" ).val( telefonoalumno );
			$( "input[ name='correoalumno2' ]" ).val( correoalumno );
			
			datos =	{ "accion" : "obtenerImagAlumno", "idalumno" : idalumno };
						
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
					var arNomFicheroFotoAlumno;
					arNomFicheroFotoAlumno = JSON.parse( data );
					
					switch ( arNomFicheroFotoAlumno[ "estado" ][ "codError" ] ) 
					{
						case "000":
						case "001":
							$( "input[ name='imagenalumno2' ]" ).val( arNomFicheroFotoAlumno[ "datos" ][ 0 ][ "nomficherofotoalumno" ] );
						break;
						case "002":
						break;
					}
				}
			});
			
			$( ".wrapper2 .formulario2 input[ type='button' ] " ).on
			({ 
				"click": function( event )
				{
					let retorno = true;
					let mensaje1 = "";
					let mensaje2 = "";
					let mensaje3 = "";	
					let mensaje4 = "";	
					let mensaje5 = "";	
					let mensaje6 = "";	
					let mensaje7 = "";	
					let dnialumno = $( ".wrapper2 .formulario2 input[ name='dnialumno2' ]" ).val();
					let nombrealumno = $( ".wrapper2 .formulario2 input[ name='nombrealumno2' ]" ).val();
					let apellidosalumno = $( ".wrapper2 .formulario2 input[ name='apellidosalumno2' ]" ).val();
					let direccionalumno = $( ".wrapper2 .formulario2 input[ name='direccionalumno2' ]" ).val();
					let telefonoalumno = $( ".wrapper2 .formulario2 input[ name='telefonoalumno2' ]" ).val();
					let correoalumno = $( ".wrapper2 .formulario2 input[ name='correoalumno2' ]" ).val();
					let imagenalumno = $( ".wrapper2 .formulario2 input[ name='imagenalumno2' ]" ).val();
										
					if ( dnialumno.length === 0 ) 
					{
						mensaje1 += "<p>El DNI del alumno está vacío</p>";
						retorno = false;
					}
					if ( dnialumno.trim().length === 0 ) 
					{
						mensaje1 += "<p>No puedes teclear solo espacios en blanco en el DNI del alumno</p>";
						retorno = false;
					}
					if ( nombrealumno.length === 0 ) 
					{
						mensaje2 += "<p>El nombre del alumno está vacío</p>";
						retorno2 = false;
					}
					if ( nombrealumno.trim().length === 0 ) 
					{
						mensaje2 += "<p>No puedes teclear solo espacios en blanco en el nombre del alumno</p>";
						retorno = false;
					}
					if ( apellidosalumno.length === 0 ) 
					{
						mensaje3 += "<p>Los apellidos del alumno están vacíos</p>";
						retorno = false;
					}
					if ( apellidosalumno.trim().length === 0 ) 
					{
						mensaje3 += "<p>No puedes teclear sólo espacios en blanco en los apellidos del alumno</p>";
						retorno = false;
					}
					if ( direccionalumno.length === 0 ) 
					{
						mensaje4 += "<p>La dirección del alumno está vacía</p>";
						retorno = false;
					}
					if ( direccionalumno.trim().length === 0 ) 
					{
						mensaje4 += "<p>No puedes teclear solo espacios en blanco en la dirección del alumno</p>";
						retorno = false;
					}
					if ( telefonoalumno.length === 0 ) 
					{
						mensaje5 += "<p>El teléfono del alumno está vacío</p>";
						retorno = false;
					}
					if ( telefonoalumno.trim().length === 0 ) 
					{
						mensaje5 += "<p>No puedes teclear solo espacios en blanco en el teléfono del alumno</p>";
						retorno = false;
					}
					if ( correoalumno.length === 0 ) 
					{
						mensaje6 += "<p>El correo del alumno está vacío</p>";
						retorno = false;
					}
					if ( correoalumno.trim().length === 0 ) 
					{
						mensaje6 += "<p>No puedes teclear solo espacios en blanco en el correo del alumno</p>";
						retorno = false;
					}
					if ( imagenalumno.length === 0 ) 
					{
						mensaje7 += "<p>La imagen del alumno está vacía</p>";
						retorno = false;
					}
					if ( imagenalumno.trim().length === 0 ) 
					{
						mensaje7 += "<p>No puedes teclear solo espacios en blanco en la imagen del alumno</p>";
						retorno = false;
					}
					if ( !retorno ) 
					{
						layermsg1_2.innerHTML = mensaje1;
						layermsg2_2.innerHTML = mensaje2;
						layermsg3_2.innerHTML = mensaje3;
						layermsg4_2.innerHTML = mensaje4;
						layermsg5_2.innerHTML = mensaje5;
						layermsg6_2.innerHTML = mensaje6;
						layermsg7_2.innerHTML = mensaje7;
					}
					
					if ( retorno ) 
					{
						datos =	{
									"accion" : "editarAlumno", 
									"idalumno" : idalumno,
									"dnialumno" : dnialumno, 
									"nombrealumno" : nombrealumno,  
									"apellidosalumno" : apellidosalumno,
									"direccionalumno" : direccionalumno,
									"telefonoalumno" : telefonoalumno,
									"correoalumno" : correoalumno,
									"imagenalumno" : imagenalumno 
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
								let arData;
								let nodoSig;
								let nodoAnt;
								let dataId;
								
								arData = JSON.parse( data );

								switch ( arData[ "estado" ][ "codError" ] ) 
								{ 
									case "000": 
									case "001": 
										$( "table#listaalumnos tbody tr td:nth-child( 2 )" ).each( function( index ) 
										{
											dataId = $( this ).attr( "data-id" );
											if ( dataId === $( "input[ name='dnialumno2' ]" ).attr( "data-id" ) ) 
											{
												nodoAnt = $( this ).prev();
												$( nodoAnt ).html( $( "input[ name='dnialumno2' ]" ).val() );
												
												$( this ).html( $( "input[ name='nombrealumno2' ]" ).val() );
												
												nodoSig = $( this ).next();
												$( nodoSig ).html( $( "input[ name='apellidosalumno2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='direccionalumno2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='telefonoalumno2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='correoalumno2' ]" ).val() );
											}
										});
										
										$( ".wrapper2" ).trigger( "click" );
										
									break;
									case "002":
										
									break;
								}
							}   
						});
					}
				}
			});
		}	
	});	
}
