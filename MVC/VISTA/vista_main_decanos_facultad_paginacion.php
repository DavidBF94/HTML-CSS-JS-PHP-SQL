
<!DOCTYPE html>

<html lang = "es">

	<head>
	
		<meta charset = "utf-8" />
		<title>Lista Decanos y Facultades</title>
		<link rel = 'stylesheet' href='CSS/EstilosMainDecanoFacultad.css'>
		<link rel = 'stylesheet' href='CSS/EstilosTablasDecanosFacultades.css'>
		<link rel = 'stylesheet' href='CSS/EstilosOverlayBusqueda.css'>
		<link rel = 'stylesheet' href='CSS/EstilosRegistroUsuario.css'>
		<link rel = 'stylesheet' href='CSS/EstilosIniciarSesionUsuario.css'>
		<script src = "JQUERY/jquery-3.6.0.js"></script>
		<script src="JS/js_buscador.js"></script>
		<script src="JS/js_registro_iniciarsesion.js"></script>
		
		<script>
		
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
					<a href='main_decanos_facultad.php'>Facultades y Decanos</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_alumnos.php'>Alumnos</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_profesores.php'>Profesores</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_decanos.php'>Decanos</a>
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
			
			<div class = 'anchura80' >
			
			<?php
			
				echo $arTablaDecanosFacultad[ 1 ];
				
				echo $arTablaDecanosFacultad[ 2 ];
			
			?>
			
			</div>
			
			<div class = 'PieDePagina'>
				<div class = 'PieDePaginaInformacion'>
					<div class = 'Informacion'>
						Teléfono de Contacto: 91 111 11 11
					</div>
					<div class = 'Informacion'>
						Dirección de Correo Electrónico: infometropol@umtp.com
					</div>
					<div class = 'Informacion'>
						© Universidad Metropolitana
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
						<input type='text' name='contrasennausuario' placeholder='Contraseña' maxlength='20' />
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
						<input type='text' name='contrasennausuario2' placeholder='Contraseña' maxlength='20' />
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