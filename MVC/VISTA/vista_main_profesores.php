
<!DOCTYPE html>

<html lang = "es">

	<head>
	
		<meta charset = "utf-8" />
		<title>Lista Profesores</title>
		<link rel = 'stylesheet' href='CSS/EstilosMainProfesores.css'>
		<link rel = 'stylesheet' href='CSS/EstilosTablasAlumnosProfesoresDecanos.css'>
		<link rel = 'stylesheet' href='CSS/EstilosOverlayProfesores.css'>
		<link rel = 'stylesheet' href='CSS/EstilosFormularioProfesores.css'>
		<link rel = 'stylesheet' href='CSS/EstilosEdicionProfesores.css'>
		<link rel = 'stylesheet' href='CSS/EstilosOverlayBusqueda.css'>
		<link rel = 'stylesheet' href='CSS/EstilosRegistroUsuario.css'>
		<link rel = 'stylesheet' href='CSS/EstilosIniciarSesionUsuario.css'>
		<script src = "JQUERY/jquery-3.6.0.js"></script>
		<script src="JS/js_main_profesores.js"></script>
		<script src="JS/js_buscador.js"></script>
		<script src="JS/js_registro_iniciarsesion.js"></script>
		
		<script>
		
			$( function() 
			{
				$( "#listaprofesores tbody td:nth-child( 2 )" ).on
				( { 
					"click": function() 
					{
						obtenerFotoProfesor( $( this ).attr( 'data-id' ) );
					}
				});
			});
			
			$( function() 
			{				
				formularioProfesores();
			});
			
			$( function() 
			{				
				edicionProfesores("#listaprofesores tbody td:last-child");
			});
			
			$( function() 
			{				
				buscador();
			});
			
			$( function() 
			{				
				registroUsuario();
			});
			
			$( function() 
			{				
				inicioSesionUsuario();
			});
			
			$( function() 
			{				
				finSesionUsuario();
			});
		
		</script>
		
	</head>
	
	<body>
	
		<div class = 'main'>
		
			<?php
			
				echo $estructura;
				
			?>
		
			<div class = 'CajaTitulo'>
				<div class = 'LogoTitulo'>
					<img src = "IMG/mirror.jpg"/>
				</div>
				<div class = 'Titulo'>Universidad Metropolitana</div>
				<div class = 'LogoTitulo'>
					<img src = "IMG/mirror2.jpg"/>
				</div>
			</div>
			
			<?php
			
				echo $mensaje;
				
			?>
			
			<div class = 'Menu'>
				<div class = 'Submenu'>
					<a href='main.php'>Pagina Principal</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_profesores_paginacion.php'>Profesores con paginacion</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_alumnos.php'>Alumnos</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_decanos.php'>Decanos</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_decanos_facultad.php'>Facultades y Decanos</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_facultades.php'>Facultades</a>
				</div>
				<div class = 'Submenu'>
					<form name = 'buscador'>
						<input type='text' name='texto_busqueda'/>
						<input type='button' name= 'boton_busqueda' value='Buscar'/>
					</form>
				</div>
			</div>
			
			<div class = 'Inserciones'>
				<a href='#altaprofesor'>Insertar nuevo profesor</a>
			</div>
				
			<div class = 'anchura80' >
			
			<?php
			
				echo $arTablaProfesores[ 1 ];
			
			?>
			
			</div>
			
			<div class = 'PieDePagina'>
				<div class = 'PieDePaginaInformacion'>
					<div class = 'Informacion'>
						Tel??fono de Contacto: 91 111 11 11
					</div>
					<div class = 'Informacion'>
						Direcci??n de Correo Electr??nico: infometropol@umtp.com
					</div>
					<div class = 'Informacion'>
						?? Universidad Metropolitana
					</div>
				</div>
				<div class = 'PieDePaginaLogos'>
					<div class = 'Logo'>
						<img src = "IMG/Logo_Twitter.png"/>
					</div>
					<div class = 'Logo'>
						<img src = "IMG/Logo_Facebook.png"/>
					</div>
					<div class = 'Logo'>
						<img src = "IMG/Logo_Instagram.png"/>
					</div>
					<div class = 'Logo'>
						<img src = "IMG/Logo_Youtube.png"/>
					</div>
					<div class = 'Logo'>
						<img src = "IMG/Logo_Linkedin.png"/>
					</div>
				</div>
			</div>
		</div>
			
		<div class='wrapper ocultoDI'>
			<div class='formulario'>
				<h3>Inserci??n Profesor</h3>	
				<div class='form'>
					<div> 
						<input type='text' name='dniprofesor' placeholder='DNI' maxlength='9' />
					</div>
					<div id='layermsg1'></div>
					<div> 
						<input type='text' name='nombreprofesor' placeholder='Nombre' maxlength='20' />
					</div>
					<div id='layermsg2'></div>
					<div> 
						<input type='text' name='apellidosprofesor' placeholder='Apellidos' maxlength='50' />
					</div>
					<div id='layermsg3'></div>
					<div> 
						<input type='text' name='direccionprofesor' placeholder='Direccion' maxlength='80' />
					</div>
					<div id='layermsg4'></div>
					<div> 
						<input type='text' name='telefonoprofesor' placeholder='Tel??fono' maxlength='9' />
					</div>
					<div id='layermsg5'></div>
					<div> 
						<input type='text' name='correoprofesor' placeholder='Correo' maxlength='50' />
					</div>
					<div id='layermsg6'></div>
					<div> 
						<input type='text' name='imagenprofesor' placeholder='Imagen' maxlength='50' />
					</div>
					<div id='layermsg7'></div>
					<div>
						<input type="button" value="Insertar" />
					</div>
				</div>
			</div>
		</div>
		
		<div class='wrapper2 ocultoDI2'>
			<div class='formulario2'>
				<h3>Edicion Profesor</h3>	
				<div class='form2'>
					<div> 
						<input type='text' name='dniprofesor2' placeholder='DNI' maxlength='9' />
					</div>
					<div id='layermsg1_2'></div>
					<div> 
						<input type='text' name='nombreprofesor2' placeholder='Nombre' maxlength='20' />
					</div>
					<div id='layermsg2_2'></div>
					<div> 
						<input type='text' name='apellidosprofesor2' placeholder='Apellidos' maxlength='50' />
					</div>
					<div id='layermsg3_2'></div>
					<div> 
						<input type='text' name='direccionprofesor2' placeholder='Direccion' maxlength='80' />
					</div>
					<div id='layermsg4_2'></div>
					<div> 
						<input type='text' name='telefonoprofesor2' placeholder='Tel??fono' maxlength='9' />
					</div>
					<div id='layermsg5_2'></div>
					<div> 
						<input type='text' name='correoprofesor2' placeholder='Correo' maxlength='50' />
					</div>
					<div id='layermsg6_2'></div>
					<div> 
						<input type='text' name='imagenprofesor2' placeholder='Imagen' maxlength='50' />
					</div>
					<div id='layermsg7_2'></div>
					<div>
						<input type="button" value="Cambiar" />
					</div>
				</div>
			</div>
		</div>
		
		<div class='wrapper3 ocultoDI3'>
			<div class='formulario3'>
				<h3>Registrarse</h3>	
				<div class='form3'>
					<div> 
						<input type='text' name='nomusuario' placeholder='Nombre' maxlength='20' />
					</div>
					<div id='layermsg1_3'></div>
					<div> 
						<input type='text' name='correousuario' placeholder='Correo' maxlength='50' />
					</div>
					<div id='layermsg2_3'></div>
					<div> 
						<input type='text' name='contrasennausuario' placeholder='Contrase??a' maxlength='20' />
					</div>
					<div id='layermsg3_3'></div>
					<div id='layermsg4_3'></div>
					<div>
						<input type="button" value="Registrarse"/>
					</div>
				</div>
			</div>
		</div>
		
		<div class='wrapper4 ocultoDI4'>
			<div class='formulario4'>
				<h3>Iniciar Sesion</h3>	
				<div class='form4'>
					<div> 
						<input type='text' name='correousuario2' placeholder='Correo' maxlength='50' />
					</div>
					<div id='layermsg1_4'></div>
					<div> 
						<input type='text' name='contrasennausuario2' placeholder='Contrase??a' maxlength='20' />
					</div>
					<div id='layermsg2_4'></div>
					<div id='layermsg3_4'></div>
					<div>
						<input type="button" value="Iniciar Sesion"/>
					</div>
				</div>
			</div>
		</div>
		
	</body>

</html>