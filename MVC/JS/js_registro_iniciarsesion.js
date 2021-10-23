
function registroUsuario()
{
	$( "input[name='Registro']" ).on
	({ 
		"click": function( event ) 
		{
			event.preventDefault(); 
			$(".main").addClass( "oculto" );
			$( ".wrapper3" ).removeClass( "ocultoDI3" );
		}
		
	});
	
	$( ".wrapper3" ).on
	({ 
		"click": function( event ) 
		{
			event.stopPropagation();
			$( this ).addClass( "ocultoDI3" );
			$(".main").removeClass( "oculto" );
			
			$( "input[ name='nomusuario' ]" ).val( "" );
			$( "input[ name='correousuario' ]" ).val( "" );
			$( "input[ name='contrasennausuario' ]" ).val( "" );
			let mensaje1 = "";
			let mensaje2 = "";
			let mensaje3 = "";	
			let mensaje4 = "";
			layermsg1_3.innerHTML = mensaje1;
			layermsg2_3.innerHTML = mensaje2;
			layermsg3_3.innerHTML = mensaje3;
			layermsg4_3.innerHTML = mensaje4;
		}
	});
	
	$( ".wrapper3 .formulario3" ).on
	({ 
		"click": function( event ) 
		{
			event.stopPropagation();
		}
		
	});
	
	$( ".wrapper3 .formulario3 input[ type='button' ] " ).on
	({ 
		"click": function( event ) 
		{
			
			let retorno = true;
			let mensaje1 = "";
			let mensaje2 = "";
			let mensaje3 = "";	
			let mensaje4 = "";	
			let nomusuario = $( ".wrapper3 .formulario3 input[ name='nomusuario' ]" ).val();
			let correousuario = $( ".wrapper3 .formulario3 input[ name='correousuario' ]" ).val();
			let contrasennausuario = $( ".wrapper3 .formulario3 input[ name='contrasennausuario' ]" ).val();
								
			if ( nomusuario.length === 0 ) 
			{
				mensaje1 += "<p>El nombre de usuario está vacío</p>";
				retorno = false;
			}
			if ( nomusuario.trim().length === 0 ) 
			{
				mensaje1 += "<p>No puedes teclear solo espacios en blanco en el nombre de usuario</p>";
				retorno = false;
			}
			if ( correousuario.length === 0 ) 
			{
				mensaje2 += "<p>El correo del usuario está vacío</p>";
				retorno2 = false;
			}
			if ( correousuario.trim().length === 0 ) 
			{
				mensaje2 += "<p>No puedes teclear solo espacios en blanco en el correo del usuario</p>";
				retorno = false;
			}
			if ( contrasennausuario.length === 0 ) 
			{
				mensaje3 += "<p>La contraseña del usuario está vacía</p>";
				retorno = false;
			}
			if ( contrasennausuario.trim().length === 0 ) 
			{
				mensaje3 += "<p>No puedes teclear sólo espacios en blanco en la contraseña del usuario</p>";
				retorno = false;
			}
			if ( !retorno ) 
			{
				layermsg1_3.innerHTML = mensaje1;
				layermsg2_3.innerHTML = mensaje2;
				layermsg3_3.innerHTML = mensaje3;
			}

			if ( retorno ) 
			{
				datos =	{	
							"accion" : "registrarUsuario", 
							"nomusuario" : nomusuario, 
							"correousuario" : correousuario,  
							"contrasennausuario" : contrasennausuario,
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
						console.log(data);
						data = JSON.parse( data );
						console.log(data);
						
						if ( data.estado.codError === "000" )
						{
							$( "input[ name='nomusuario' ]" ).val( "" );
							$( "input[ name='correousuario' ]" ).val( "" );
							$( "input[ name='contrasennausuario' ]" ).val( "" );
							$( ".wrapper3" ).trigger( "click" );
						}
						else if ( data.estado.codError === "002" )
						{
							$( "input[ name='nomusuario' ]" ).val( "" );
							$( "input[ name='correousuario' ]" ).val( "" );
							$( "input[ name='contrasennausuario' ]" ).val( "" );
							let mensaje4 = "<p>El nombre, correo ó contraseña ya existen y no pueden repetirse</p>";
							layermsg4_3.innerHTML = mensaje4;
						}
					}   
				});
			} 
		}
	});
}

function inicioSesionUsuario()
{
	$( "input[name='Sesion']" ).on
	({ 
		"click": function( event ) 
		{
			event.preventDefault(); 
			$(".main").addClass( "oculto" );
			$( ".wrapper4" ).removeClass( "ocultoDI4" );
		}
		
	});
	
	$( ".wrapper4" ).on
	({ 
		"click": function( event ) 
		{
			event.stopPropagation();
			$( this ).addClass( "ocultoDI4" );
			$(".main").removeClass( "oculto" );
			
			$( "input[ name='correousuario2' ]" ).val( "" );
			$( "input[ name='contrasennausuario2' ]" ).val( "" );
			
			let mensaje1 = "";
			let mensaje2 = "";	
			let mensaje3 = "";	
			layermsg1_4.innerHTML = mensaje1;
			layermsg2_4.innerHTML = mensaje2;
			layermsg3_4.innerHTML = mensaje3;
		}
	});
	
	$( ".wrapper4 .formulario4" ).on
	({ 
		"click": function( event ) 
		{
			event.stopPropagation();
		}
		
	});
	
	$( ".wrapper4 .formulario4 input[ type='button' ] " ).on
	({ 
		"click": function( event ) 
		{
			
			let retorno = true;
			let mensaje1 = "";
			let mensaje2 = "";
			let mensaje3 = "";			
			let correousuario = $( ".wrapper4 .formulario4 input[ name='correousuario2' ]" ).val();
			let contrasennausuario = $( ".wrapper4 .formulario4 input[ name='contrasennausuario2' ]" ).val();
								
			if ( correousuario.length === 0 ) 
			{
				mensaje1 += "<p>El correo del usuario está vacío</p>";
				retorno2 = false;
			}
			if ( correousuario.trim().length === 0 ) 
			{
				mensaje1 += "<p>No puedes teclear solo espacios en blanco en el correo del usuario</p>";
				retorno = false;
			}
			if ( contrasennausuario.length === 0 ) 
			{
				mensaje2 += "<p>La contraseña del usuario está vacía</p>";
				retorno = false;
			}
			if ( contrasennausuario.trim().length === 0 ) 
			{
				mensaje2 += "<p>No puedes teclear sólo espacios en blanco en la contraseña del usuario</p>";
				retorno = false;
			}
			if ( !retorno ) 
			{
				layermsg1_4.innerHTML = mensaje1;
				layermsg2_4.innerHTML = mensaje2;
			}
			
			if ( retorno ) 
			{
				datos =	{	
							"accion" : "iniciarSesionUsuario", 
							"correousuario" : correousuario,  
							"contrasennausuario" : contrasennausuario,
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
						console.log(data);
						data = JSON.parse( data );
						console.log(data);
						
						if ( data.estado.codError === "000" )
						{
							$( "input[ name='correousuario2' ]" ).val( "" );
							$( "input[ name='contrasennausuario2' ]" ).val( "" );
													
							$( ".wrapper4" ).trigger( "click" );
							location.reload();
						}
						else if ( data.estado.codError === "001" )
						{
							$( "input[ name='correousuario2' ]" ).val( "" );
							$( "input[ name='contrasennausuario2' ]" ).val( "" );
							
							let mensaje1 = "";
							let mensaje2 = "";	
							let mensaje3 = "<p>El nombre, correo ó contraseña introducidos no han sido registrados</p>";
							layermsg1_4.innerHTML = mensaje1;
							layermsg2_4.innerHTML = mensaje2;
							layermsg3_4.innerHTML = mensaje3;
						}
					}   
				});
			} 
		}
	});
}

function finSesionUsuario()
{
	$( "input[name='CerrarSesion']" ).on
	({ 
		"click": function( event ) 
		{
			datos =	{	
						"accion" : "cerrarSesionUsuario", 
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
					location.reload();
				}   
			});
		}
	});
}
