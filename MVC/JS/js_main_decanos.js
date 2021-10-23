
function obtenerFotoDecano( iddecano )
{
	datos =	{ "accion" : "obtenerImagDecano", "iddecano" : iddecano };
					
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
			var arNomFicheroFotoDecano;
			arNomFicheroFotoDecano = JSON.parse( data );
			
			switch ( arNomFicheroFotoDecano[ "estado" ][ "codError" ] ) 
			{
				case "000":
				case "001":
					layer = "<div class='overlay'>";
					layer += 	"<div class='subwrapper'>";
					layer += 		"<img src='" + arNomFicheroFotoDecano[ "datos" ][ 0 ][ "nomficherofotodecano" ] + "' class='anchura100' />";
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

function formularioDecanos()
{
	$( "a[ href='#altadecano' ]" ).on
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
			
			$( "input[ name='dnidecano' ]" ).val( "" );
			$( "input[ name='nombredecano' ]" ).val( "" );
			$( "input[ name='apellidosdecano' ]" ).val( "" );
			$( "input[ name='direcciondecano' ]" ).val( "" );
			$( "input[ name='telefonodecano' ]" ).val( "" );
			$( "input[ name='correodecano' ]" ).val( "" );
			$( "input[ name='imagendecano' ]" ).val( "" );
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
			let dnidecano = $( ".wrapper .formulario input[ name='dnidecano' ]" ).val();
			let nombredecano = $( ".wrapper .formulario input[ name='nombredecano' ]" ).val();
			let apellidosdecano = $( ".wrapper .formulario input[ name='apellidosdecano' ]" ).val();
			let direcciondecano = $( ".wrapper .formulario input[ name='direcciondecano' ]" ).val();
			let telefonodecano = $( ".wrapper .formulario input[ name='telefonodecano' ]" ).val();
			let correodecano = $( ".wrapper .formulario input[ name='correodecano' ]" ).val();
			let imagendecano = $( ".wrapper .formulario input[ name='imagendecano' ]" ).val();
								
			if ( dnidecano.length === 0 ) 
			{
				mensaje1 += "<p>El DNI del decano está vacío</p>";
				retorno = false;
			}
			if ( dnidecano.trim().length === 0 ) 
			{
				mensaje1 += "<p>No puedes teclear solo espacios en blanco en el DNI del decano</p>";
				retorno = false;
			}
			if ( nombredecano.length === 0 ) 
			{
				mensaje2 += "<p>El nombre del decano está vacío</p>";
				retorno2 = false;
			}
			if ( nombredecano.trim().length === 0 ) 
			{
				mensaje2 += "<p>No puedes teclear solo espacios en blanco en el nombre del decano</p>";
				retorno = false;
			}
			if ( apellidosdecano.length === 0 ) 
			{
				mensaje3 += "<p>Los apellidos del decano están vacíos</p>";
				retorno = false;
			}
			if ( apellidosdecano.trim().length === 0 ) 
			{
				mensaje3 += "<p>No puedes teclear sólo espacios en blanco en los apellidos del decano</p>";
				retorno = false;
			}
			if ( direcciondecano.length === 0 ) 
			{
				mensaje4 += "<p>La dirección del decano está vacía</p>";
				retorno = false;
			}
			if ( direcciondecano.trim().length === 0 ) 
			{
				mensaje4 += "<p>No puedes teclear solo espacios en blanco en la dirección del decano</p>";
				retorno = false;
			}
			if ( telefonodecano.length === 0 ) 
			{
				mensaje5 += "<p>El teléfono del decano está vacío</p>";
				retorno = false;
			}
			if ( telefonodecano.trim().length === 0 ) 
			{
				mensaje5 += "<p>No puedes teclear solo espacios en blanco en el teléfono del decano</p>";
				retorno = false;
			}
			if ( correodecano.length === 0 ) 
			{
				mensaje6 += "<p>El correo del decano está vacío</p>";
				retorno = false;
			}
			if ( correodecano.trim().length === 0 ) 
			{
				mensaje6 += "<p>No puedes teclear solo espacios en blanco en el correo del decano</p>";
				retorno = false;
			}
			if ( imagendecano.length === 0 ) 
			{
				mensaje7 += "<p>La imagen del decano está vacía</p>";
				retorno = false;
			}
			if ( imagendecano.trim().length === 0 ) 
			{
				mensaje7 += "<p>No puedes teclear solo espacios en blanco en la imagen del decano</p>";
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
							"accion" : "insertarDecano", 
							"dnidecano" : dnidecano, 
							"nombredecano" : nombredecano,  
							"apellidosdecano" : apellidosdecano,
							"direcciondecano" : direcciondecano,
							"telefonodecano" : telefonodecano,
							"correodecano" : correodecano,
							"imagendecano" : imagendecano 
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
							$( data.trim() ).insertAfter( "table#listadecanos tbody tr:last-child" );
							
							$( "#listadecanos tbody tr:last-child td:nth-child( 2 )" ).on
							( { 
								"click": function() 
								{
									obtenerFotoDecano( $( this ).attr( 'data-id' ) );
								}
							});
							
							$( "#listadecanos tbody tr:last-child td:last-child" ).on
							( { 
								"click": function() 
								{
									edicionDecanos("#listadecanos tbody tr:last-child td:last-child");
								}
							});
						}

						$( "input[ name='dnidecano' ]" ).val( "" );
						$( "input[ name='nombredecano' ]" ).val( "" );
						$( "input[ name='apellidosdecano' ]" ).val( "" );
						$( "input[ name='direcciondecano' ]" ).val( "" );
						$( "input[ name='telefonodecano' ]" ).val( "" );
						$( "input[ name='correodecano' ]" ).val( "" );
						$( "input[ name='imagendecano' ]" ).val( "" );
						
						
						$( ".wrapper" ).trigger( "click" );
						
					}   
				});
			} 
		}
	});
}

function edicionDecanos(posicion)
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
			
			let iddecano, dnidecano, nombredecano, apellidosdecano, direcciondecano, telefonodecano, correodecano;
			
			nodo = $( this ).parent();
			
			$( nodo ).children( "td" ).each( function( index ) 
			{
				switch ( index ) 
				{
					case 0:
						dnidecano = $( this ).html();
					break;
					case 1:
						iddecano = $( this ).attr( "data-id" );	
						nombredecano = $( this ).html();
					break;
					case 2:
						apellidosdecano = $( this ).html();
					break;
					case 3:
						direcciondecano = $( this ).html();
					break;
					case 4:
						telefonodecano = $( this ).html();
					break;
					case 5:
						correodecano = $( this ).html();
					break;
				}
			});
			
			$( "input[ name='dnidecano2' ]" ).val( dnidecano );
			$( "input[ name='dnidecano2' ]" ).attr( "data-id", iddecano );
			$( "input[ name='nombredecano2' ]" ).val( nombredecano );
			$( "input[ name='apellidosdecano2' ]" ).val( apellidosdecano );
			$( "input[ name='direcciondecano2' ]" ).val( direcciondecano );
			$( "input[ name='telefonodecano2' ]" ).val( telefonodecano );
			$( "input[ name='correodecano2' ]" ).val( correodecano );
			
			datos =	{ "accion" : "obtenerImagDecano", "iddecano" : iddecano };
						
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
					var arNomFicheroFotodecano;
					arNomFicheroFotoDecano = JSON.parse( data );
					
					switch ( arNomFicheroFotoDecano[ "estado" ][ "codError" ] ) 
					{
						case "000":
						case "001":
							$( "input[ name='imagendecano2' ]" ).val( arNomFicheroFotoDecano[ "datos" ][ 0 ][ "nomficherofotodecano" ] );
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
					let dnidecano = $( ".wrapper2 .formulario2 input[ name='dnidecano2' ]" ).val();
					let nombredecano = $( ".wrapper2 .formulario2 input[ name='nombredecano2' ]" ).val();
					let apellidosdecano = $( ".wrapper2 .formulario2 input[ name='apellidosdecano2' ]" ).val();
					let direcciondecano = $( ".wrapper2 .formulario2 input[ name='direcciondecano2' ]" ).val();
					let telefonodecano = $( ".wrapper2 .formulario2 input[ name='telefonodecano2' ]" ).val();
					let correodecano = $( ".wrapper2 .formulario2 input[ name='correodecano2' ]" ).val();
					let imagendecano = $( ".wrapper2 .formulario2 input[ name='imagendecano2' ]" ).val();
										
					if ( dnidecano.length === 0 ) 
					{
						mensaje1 += "<p>El DNI del decano está vacío</p>";
						retorno = false;
					}
					if ( dnidecano.trim().length === 0 ) 
					{
						mensaje1 += "<p>No puedes teclear solo espacios en blanco en el DNI del decano</p>";
						retorno = false;
					}
					if ( nombredecano.length === 0 ) 
					{
						mensaje2 += "<p>El nombre del decano está vacío</p>";
						retorno2 = false;
					}
					if ( nombredecano.trim().length === 0 ) 
					{
						mensaje2 += "<p>No puedes teclear solo espacios en blanco en el nombre del decano</p>";
						retorno = false;
					}
					if ( apellidosdecano.length === 0 ) 
					{
						mensaje3 += "<p>Los apellidos del decano están vacíos</p>";
						retorno = false;
					}
					if ( apellidosdecano.trim().length === 0 ) 
					{
						mensaje3 += "<p>No puedes teclear sólo espacios en blanco en los apellidos del decano</p>";
						retorno = false;
					}
					if ( direcciondecano.length === 0 ) 
					{
						mensaje4 += "<p>La dirección del decano está vacía</p>";
						retorno = false;
					}
					if ( direcciondecano.trim().length === 0 ) 
					{
						mensaje4 += "<p>No puedes teclear solo espacios en blanco en la dirección del decano</p>";
						retorno = false;
					}
					if ( telefonodecano.length === 0 ) 
					{
						mensaje5 += "<p>El teléfono del decano está vacío</p>";
						retorno = false;
					}
					if ( telefonodecano.trim().length === 0 ) 
					{
						mensaje5 += "<p>No puedes teclear solo espacios en blanco en el teléfono del decano</p>";
						retorno = false;
					}
					if ( correodecano.length === 0 ) 
					{
						mensaje6 += "<p>El correo del decano está vacío</p>";
						retorno = false;
					}
					if ( correodecano.trim().length === 0 ) 
					{
						mensaje6 += "<p>No puedes teclear solo espacios en blanco en el correo del decano</p>";
						retorno = false;
					}
					if ( imagendecano.length === 0 ) 
					{
						mensaje7 += "<p>La imagen del decano está vacía</p>";
						retorno = false;
					}
					if ( imagendecano.trim().length === 0 ) 
					{
						mensaje7 += "<p>No puedes teclear solo espacios en blanco en la imagen del decano</p>";
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
									"accion" : "editarDecano", 
									"iddecano" : iddecano,
									"dnidecano" : dnidecano, 
									"nombredecano" : nombredecano,  
									"apellidosdecano" : apellidosdecano,
									"direcciondecano" : direcciondecano,
									"telefonodecano" : telefonodecano,
									"correodecano" : correodecano,
									"imagendecano" : imagendecano 
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
										$( "table#listadecanos tbody tr td:nth-child( 2 )" ).each( function( index ) 
										{
											dataId = $( this ).attr( "data-id" );
											if ( dataId === $( "input[ name='dnidecano2' ]" ).attr( "data-id" ) ) 
											{
												nodoAnt = $( this ).prev();
												$( nodoAnt ).html( $( "input[ name='dnidecano2' ]" ).val() );
												
												$( this ).html( $( "input[ name='nombredecano2' ]" ).val() );
												
												nodoSig = $( this ).next();
												$( nodoSig ).html( $( "input[ name='apellidosdecano2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='direcciondecano2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='telefonodecano2' ]" ).val() );
												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( "input[ name='correodecano2' ]" ).val() );
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
