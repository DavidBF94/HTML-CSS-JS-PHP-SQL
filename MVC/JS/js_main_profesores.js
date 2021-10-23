
function obtenerFotoProfesor( idprofesor )
{
	datos =	{ "accion" : "obtenerImagProfesor", "idprofesor" : idprofesor };
						
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
			var arNomFicheroFotoProfesor;
			arNomFicheroFotoProfesor = JSON.parse( data );
			
			switch ( arNomFicheroFotoProfesor[ "estado" ][ "codError" ] ) 
			{
				case "000":
				case "001":
					layer = "<div class='overlay'>";
					layer += 	"<div class='subwrapper'>";
					layer += 		"<img src='" + arNomFicheroFotoProfesor[ "datos" ][ 0 ][ "nomficherofotoprofesor" ] + "' class='anchura100' />";
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
	} );
}

function formularioProfesores()
{
	$( "a[ href='#altaprofesor' ]" ).on
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
			
			$( "input[ name='dniprofesor' ]" ).val( "" );
			$( "input[ name='nombreprofesor' ]" ).val( "" );
			$( "input[ name='apellidosprofesor' ]" ).val( "" );
			$( "input[ name='direccionprofesor' ]" ).val( "" );
			$( "input[ name='telefonoprofesor' ]" ).val( "" );
			$( "input[ name='correoprofesor' ]" ).val( "" );
			$( "input[ name='imagenprofesor' ]" ).val( "" );
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
			let dniprofesor = $( ".wrapper .formulario input[ name='dniprofesor' ]" ).val();
			let nombreprofesor = $( ".wrapper .formulario input[ name='nombreprofesor' ]" ).val();
			let apellidosprofesor = $( ".wrapper .formulario input[ name='apellidosprofesor' ]" ).val();
			let direccionprofesor = $( ".wrapper .formulario input[ name='direccionprofesor' ]" ).val();
			let telefonoprofesor = $( ".wrapper .formulario input[ name='telefonoprofesor' ]" ).val();
			let correoprofesor = $( ".wrapper .formulario input[ name='correoprofesor' ]" ).val();
			let imagenprofesor = $( ".wrapper .formulario input[ name='imagenprofesor' ]" ).val();
								
			if ( dniprofesor.length === 0 ) 
			{
				mensaje1 += "<p>El DNI del profesor está vacío</p>";
				retorno = false;
			}
			if ( dniprofesor.trim().length === 0 ) 
			{
				mensaje1 += "<p>No puedes teclear solo espacios en blanco en el DNI del profesor</p>";
				retorno = false;
			}
			if ( nombreprofesor.length === 0 ) 
			{
				mensaje2 += "<p>El nombre del profesor está vacío</p>";
				retorno2 = false;
			}
			if ( nombreprofesor.trim().length === 0 ) 
			{
				mensaje2 += "<p>No puedes teclear solo espacios en blanco en el nombre del profesor</p>";
				retorno = false;
			}
			if ( apellidosprofesor.length === 0 ) 
			{
				mensaje3 += "<p>Los apellidos del profesor están vacíos</p>";
				retorno = false;
			}
			if ( apellidosprofesor.trim().length === 0 ) 
			{
				mensaje3 += "<p>No puedes teclear sólo espacios en blanco en los apellidos del profesor</p>";
				retorno = false;
			}
			if ( direccionprofesor.length === 0 ) 
			{
				mensaje4 += "<p>La dirección del profesor está vacía</p>";
				retorno = false;
			}
			if ( direccionprofesor.trim().length === 0 ) 
			{
				mensaje4 += "<p>No puedes teclear solo espacios en blanco en la dirección del profesor</p>";
				retorno = false;
			}
			if ( telefonoprofesor.length === 0 ) 
			{
				mensaje5 += "<p>El teléfono del profesor está vacío</p>";
				retorno = false;
			}
			if ( telefonoprofesor.trim().length === 0 ) 
			{
				mensaje5 += "<p>No puedes teclear solo espacios en blanco en el teléfono del profesor</p>";
				retorno = false;
			}
			if ( correoprofesor.length === 0 ) 
			{
				mensaje6 += "<p>El correo del profesor está vacío</p>";
				retorno = false;
			}
			if ( correoprofesor.trim().length === 0 ) 
			{
				mensaje6 += "<p>No puedes teclear solo espacios en blanco en el correo del profesor</p>";
				retorno = false;
			}
			if ( imagenprofesor.length === 0 ) 
			{
				mensaje7 += "<p>La imagen del profesor está vacía</p>";
				retorno = false;
			}
			if ( imagenprofesor.trim().length === 0 ) 
			{
				mensaje7 += "<p>No puedes teclear solo espacios en blanco en la imagen del profesor</p>";
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
							"accion" : "insertarProfesor", 
							"dniprofesor" : dniprofesor, 
							"nombreprofesor" : nombreprofesor,  
							"apellidosprofesor" : apellidosprofesor,
							"direccionprofesor" : direccionprofesor,
							"telefonoprofesor" : telefonoprofesor,
							"correoprofesor" : correoprofesor,
							"imagenprofesor" : imagenprofesor 
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
							$( data.trim() ).insertAfter( "table#listaprofesores tbody tr:last-child" );
							
							$( "#listaprofesores tbody tr:last-child td:nth-child( 2 )" ).on
							( { 
								"click": function() 
								{
									obtenerFotoProfesor( $( this ).attr( 'data-id' ) );
								}
							});
							
							$( "#listaprofesores tbody tr:last-child td:last-child" ).on
							( { 
								"click": function() 
								{
									edicionProfesores("#listaprofesores tbody tr:last-child td:last-child");
								}
							});
						}

						$( "input[ name='dniprofesor' ]" ).val( "" );
						$( "input[ name='nombreprofesor' ]" ).val( "" );
						$( "input[ name='apellidosprofesor' ]" ).val( "" );
						$( "input[ name='direccionprofesor' ]" ).val( "" );
						$( "input[ name='telefonoprofesor' ]" ).val( "" );
						$( "input[ name='correoprofesor' ]" ).val( "" );
						$( "input[ name='imagenprofesor' ]" ).val( "" );
						
						
						$( ".wrapper" ).trigger( "click" );
						
					}   
				});
			} 
		}
	});
}

function edicionProfesores(posicion)
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
			
			let idprofesor, dniprofesor, nombreprofesor, apellidosprofesor, direccionprofesor, telefonoprofesor, correoprofesor;
			
			nodo = $( this ).parent();
			
			$( nodo ).children( "td" ).each( function( index ) 
			{
				switch ( index ) 
				{
					case 0:
						dniprofesor = $( this ).html();
					break;
					case 1:
						idprofesor = $( this ).attr( "data-id" );	
						nombreprofesor = $( this ).html();
					break;
					case 2:
						apellidosprofesor = $( this ).html();
					break;
					case 3:
						direccionprofesor = $( this ).html();
					break;
					case 4:
						telefonoprofesor = $( this ).html();
					break;
					case 5:
						correoprofesor = $( this ).html();
					break;
				}
			});
			
			$( "input[ name='dniprofesor2' ]" ).val( dniprofesor );
			$( "input[ name='dniprofesor2' ]" ).attr( "data-id", idprofesor );
			$( "input[ name='nombreprofesor2' ]" ).val( nombreprofesor );
			$( "input[ name='apellidosprofesor2' ]" ).val( apellidosprofesor );
			$( "input[ name='direccionprofesor2' ]" ).val( direccionprofesor );
			$( "input[ name='telefonoprofesor2' ]" ).val( telefonoprofesor );
			$( "input[ name='correoprofesor2' ]" ).val( correoprofesor );
			
			datos =	{ "accion" : "obtenerImagProfesor", "idprofesor" : idprofesor };
						
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
					var arNomFicheroFotoProfesor;
					arNomFicheroFotoProfesor = JSON.parse( data );
					
					switch ( arNomFicheroFotoProfesor[ "estado" ][ "codError" ] ) 
					{
						case "000":
						case "001":
							$( "input[ name='imagenprofesor2' ]" ).val( arNomFicheroFotoProfesor[ "datos" ][ 0 ][ "nomficherofotoprofesor" ] );
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
					let dniprofesor = $( ".wrapper2 .formulario2 input[ name='dniprofesor2' ]" ).val();
					let nombreprofesor = $( ".wrapper2 .formulario2 input[ name='nombreprofesor2' ]" ).val();
					let apellidosprofesor = $( ".wrapper2 .formulario2 input[ name='apellidosprofesor2' ]" ).val();
					let direccionprofesor = $( ".wrapper2 .formulario2 input[ name='direccionprofesor2' ]" ).val();
					let telefonoprofesor = $( ".wrapper2 .formulario2 input[ name='telefonoprofesor2' ]" ).val();
					let correoprofesor = $( ".wrapper2 .formulario2 input[ name='correoprofesor2' ]" ).val();
					let imagenprofesor = $( ".wrapper2 .formulario2 input[ name='imagenprofesor2' ]" ).val();
										
					if ( dniprofesor.length === 0 ) 
					{
						mensaje1 += "<p>El DNI del profesor está vacío</p>";
						retorno = false;
					}
					if ( dniprofesor.trim().length === 0 ) 
					{
						mensaje1 += "<p>No puedes teclear solo espacios en blanco en el DNI del profesor</p>";
						retorno = false;
					}
					if ( nombreprofesor.length === 0 ) 
					{
						mensaje2 += "<p>El nombre del profesor está vacío</p>";
						retorno2 = false;
					}
					if ( nombreprofesor.trim().length === 0 ) 
					{
						mensaje2 += "<p>No puedes teclear solo espacios en blanco en el nombre del profesor</p>";
						retorno = false;
					}
					if ( apellidosprofesor.length === 0 ) 
					{
						mensaje3 += "<p>Los apellidos del profesor están vacíos</p>";
						retorno = false;
					}
					if ( apellidosprofesor.trim().length === 0 ) 
					{
						mensaje3 += "<p>No puedes teclear sólo espacios en blanco en los apellidos del profesor</p>";
						retorno = false;
					}
					if ( direccionprofesor.length === 0 ) 
					{
						mensaje4 += "<p>La dirección del profesor está vacía</p>";
						retorno = false;
					}
					if ( direccionprofesor.trim().length === 0 ) 
					{
						mensaje4 += "<p>No puedes teclear solo espacios en blanco en la dirección del profesor</p>";
						retorno = false;
					}
					if ( telefonoprofesor.length === 0 ) 
					{
						mensaje5 += "<p>El teléfono del profesor está vacío</p>";
						retorno = false;
					}
					if ( telefonoprofesor.trim().length === 0 ) 
					{
						mensaje5 += "<p>No puedes teclear solo espacios en blanco en el teléfono del profesor</p>";
						retorno = false;
					}
					if ( correoprofesor.length === 0 ) 
					{
						mensaje6 += "<p>El correo del profesor está vacío</p>";
						retorno = false;
					}
					if ( correoprofesor.trim().length === 0 ) 
					{
						mensaje6 += "<p>No puedes teclear solo espacios en blanco en el correo del profesor</p>";
						retorno = false;
					}
					if ( imagenprofesor.length === 0 ) 
					{
						mensaje7 += "<p>La imagen del profesor está vacía</p>";
						retorno = false;
					}
					if ( imagenprofesor.trim().length === 0 ) 
					{
						mensaje7 += "<p>No puedes teclear solo espacios en blanco en la imagen del profesor</p>";
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
									"accion" : "editarProfesor", 
									"idprofesor" : idprofesor,
									"dniprofesor" : dniprofesor, 
									"nombreprofesor" : nombreprofesor,  
									"apellidosprofesor" : apellidosprofesor,
									"direccionprofesor" : direccionprofesor,
									"telefonoprofesor" : telefonoprofesor,
									"correoprofesor" : correoprofesor,
									"imagenprofesor" : imagenprofesor 
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
										$( "table#listaprofesores tbody tr td:nth-child( 2 )" ).each( function( index ) 
										{
											dataId = $( this ).attr( "data-id" );
											if ( dataId === $( "input[ name='dniprofesor2' ]" ).attr( "data-id" ) ) 
											{
												nodoAnt = $( this ).prev();
												$( nodoAnt ).html( $( "input[ name='dniprofesor2' ]" ).val() );
												
												$( this ).html( $( "input[ name='nombreprofesor2' ]" ).val() );
												
												nodoSig = $( this ).next();
												$( nodoSig ).html( $( "input[ name='apellidosprofesor2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='direccionprofesor2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='telefonoprofesor2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='correoprofesor2' ]" ).val() );
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
