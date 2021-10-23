
<!DOCTYPE html>

<html lang = "es">

	<head>
	
		<meta charset = "utf-8" />
		<title>Portada</title>
		<link rel = 'stylesheet' href='CSS/EstilosMain.css'>
		<link rel = 'stylesheet' href='CSS/EstilosOverlayBusqueda.css'>
		<link rel = 'stylesheet' href='CSS/EstilosRegistroUsuario.css'>
		<link rel = 'stylesheet' href='CSS/EstilosIniciarSesionUsuario.css'>
		<script src = "JQUERY/jquery-3.6.0.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.css" rel="stylesheet" />
		<script src="JS/js_buscador.js"></script>
		<script src="JS/js_registro_iniciarsesion.js"></script>
		
		<script>
		
			$(function(){
			  $('.bxslider').bxSlider({
				mode: 'fade',
				captions: true,
				slideWidth: 1500
			  });
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
					<a href='main_alumnos.php'>Alumnos</a>
				</div>
				<div class = 'Submenu'>
					<a href='main_profesores.php'>Profesores</a>
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
			
			<div class = 'CajaDeslizamiento'>
				<div class="bxslider">
				  <div><img src = "IMG/Portada1.jpg"></div>
				  <div><img src = "IMG/Portada2.jpg"></div>
				  <div><img src = "IMG/Portada3.jpg"></div>
				  <div><img src = "IMG/Portada4.jpg"></div>
				  <div><img src = "IMG/Portada5.jpg"></div>
				</div>
			</div>
			
			<div class = 'Descripcion'>
				<div class = 'DescripcionImag'>
					<img src = "IMG/Fondo1.jpg"/>
				</div>
				<div class = 'DescripcionTexto'>
					<h4>Ciudad de Glass</h4>
					<p>
						Glass se alza como un reluciente símbolo de la grandeza del Conglomerado, la pura antítesis de la arquitectura sin personalidad de OmniStat. Silvine tiene una fuerte presencia en esta ciudad, en la que la casta alta casi supera en número a la casta media. Sky City, el logro definitivo del ingenio arquitectónico del Conglomerado, se alza hacia el cielo como recordatorio constante de las recompensas que aguardan a quienes están dispuestos a hacer los sacrificios necesarios.
					</p>
					<p>
						Aunque se encuentra ubicada al extremo sur de Cascadia Prime, la tranquila ciudad costera de Glass es justo lo contrario de lo que muchos cascadianos piensan que es. Como uno de los dos centros de desarrollo de Silvine Systems, Glass está a la vanguardia de la revolución digital que se extiende por nuestra nación. Y, como la tercera ciudad más grande de Cascadia, Glass tiene su propio estilo de entretenimiento y compras. La regata anual Ocean View atrae a cientos de miles de visitantes y muchos acaban enviado solicitudes de traslado a sus departamentos de RR. HH. tras haber disfrutado de las amplias playas y el refrescante clima costero. Para los pocos afortunados que pueden visitar Sky City, no hay vuelta atrás.
					</p>
					<p>
						Pero la regata no es la única razón para venir a Glass. Con su peculiar mezcla de influencias SSSC, actitud relajada y ciudadanos altamente educados y perspicaces, Glass es una ubicación atractiva durante todo el año. Ofrece mucha vida nocturna, los restaurantes se especializan en mariscos exóticos y las tiendas no tienen nada que envidiar a las de Cascadia Prime.
					</p>
					<p>
						Por último, aunque no por ello menos importante, Glass es una ciudad modelo para la constante transformación. CC Corp ha sido clave para la renovación de toda la ciudad hasta conseguir el pináculo de belleza reflectante con que despiertan los ciudadanos cada mañana. Después de contemplar el amanecer dentro de una cascada de luz en el Distrito de los Jardines de Cristal o haber visto la miríada de innovadores edificios en “El Anchor” brillar como gemas pulidas, no volverás a ser el mismo.
					</p>
				</div>
			</div>
			<div class = 'Descripcion'>
				<div class = 'DescripcionTexto'>
					<h4>Distrito Anchor</h4>
					<p>
						El distrito Anchor es una de las zonas más prósperas de Glass, con prominentes edificios que destacan como heraldos orgullosos de las poderosas corporaciones que tienen aquí su base. Plagado de las discotecas más populares de la ciudad, Anchor recibe visitas frecuentes de los jóvenes que buscan disfrutar de la vida nocturna y de las compras.
					</p>
					<p>
						Un proyecto espectacular de edificación en Anchor es el gigantesco centro comercial Bauble. Cuando esté acabado, el Bauble será el centro comercial más opulento de Cascadia: Un verdadero monumento al éxito de la forma de vida del Conglomerado.
					</p>
					<p>
						El distrito Anchor es una de las principales zonas comerciales y de ocio de Glass. Aunque los residentes de Sky City suelen ser reservados y no se mezclan con los trabajadores normales, algunos, especialmente los jóvenes, realizan frecuentes visitas a Anchor. Acuden para comprar y bailar en las discotecas más populares de la ciudad, como la famosa «Sloth», donde solo se admite la entrada a lo más granado y selecto.
					</p>
					<p>
						Empleados de todas las castas pueden satisfacer cualquier necesidad material imaginable en el Anansi Emporium o el Pirandello. Aquí tienes desde las importaciones más raras hasta los bienes de consumo más comunes. Si buscas ruedas nuevas, el Bryson Showroom ofrece lo último en diseño automovilístico. Es posible que todos estos sitios queden empequeñecidos tras la apertura del centro comercial Bauble, pero te sugerimos que lo juzgues tú mismo.
					</p>
				</div>
				<div class = 'DescripcionImag'>
					<img src = "IMG/Fondo2.jpg"/>
				</div>
			</div>
			<div class = 'Descripcion'>
				<div class = 'DescripcionImag'>
					<img src = "IMG/Fondo3.png"/>
				</div>
				<div class = 'DescripcionTexto'>
					<h4>Distrito Ocean Glass View</h4>
					<p>
						Ocean Glass View, o "El View", es una zona residencial próspera dedicada a los ciudadanos con vistas al ascenso social y considerada por muchos como el último paso antes de recibir una invitación a Sky City. 
					</p>
					<p>
						Si buscas escapar de la intensidad del centro o de Anchor, El View es el sitio ideal para visitar. Puedes caminar por el paseo marítimo, irte de picnic y, por qué no, hacer una visita a La Marina. En los días de descanso no es raro ver familias disfrutando de la playa mientras sus hijos practican surf.
					</p>
					<p>
						Gran parte del View está patrocinada por Silvine Systems (la mayoría de la plantilla de esta corporación reside en el distrito) y toda la zona está diseñada para empleados ambiciosos que destacan.
					</p>
					<p>
						City Eye es el principal servicio de noticias en La Ciudad. Debido a la naturaleza del gobierno, lo más probable es que sea de su propiedad o esté muy regulado por la Ciudad.
					</p>
					<p>
						Poseen helicópteros de noticias que operan en toda la ciudad. La compañía tiene su propio canal de noticias, City Eye Channel o City Eye Channel News, y al menos un gran edificio. 
					</p>
					<p>
						City Eye tiene muchos anuncios en toda la ciudad.
					</p>
				</div>
			</div>
			<div class = 'Descripcion'>
				<div class = 'DescripcionTexto'>
					<h4>Distrito Centro</h4>
					<p>
						El Centro, situado justo en medio de Glass, destaca como el orgulloso y moderno punto de referencia de la ciudad. Entre las concurridas y rebosantes calles, encontrarás un montón de tiendas de moda y vistas imponentes, como el edificio de la Corporación Elysium, donde residen los mayores profesionales del mundo en investigación médica.
					</p>
					<p>
						Existen informes de actividades ilegales en esta zona, con los llamados "Runners" recorriendo las azoteas. Sin embargo, los ciudadanos no deberían alarmarse, esta molestia está siendo atendida de forma efectiva por el personal de KrugerSec.
					</p>
					<p>
						Muy pronto se decidió que la remodelación del centro debía respetar en lo posible la atmósfera del antiguo centro de la ciudad. Por ello, el distrito tiene más edificios y calles más estrechas que le han permitido mantener casi por completo su disposición original. El resultado es un humilde homenaje a los viejos tiempos y un distrito orgulloso de ser el centro modernizado de Glass.
					</p>
					<p>
						Aquí destacan las boutiques de moda y no es raro ver a algún privilegiado de Sky City visitar el centro en busca de ese toque extra que no puede encontrarse en su distrito. Y con el cambio constante en las tendencias culinarias, también es posible que acabes cenando junto a una pareja de las Casas Corporativas.
					</p>
				</div>
				<div class = 'DescripcionImag'>
					<img src = "IMG/Fondo4.jpg"/>
				</div>
			</div>
			<div class = 'Descripcion'>
				<div class = 'DescripcionImag'>
					<img src = "IMG/Fondo5.jpg"/>
				</div>
				<div class = 'DescripcionTexto'>
					<h4>Las Greylands</h4>
					<p>
						Pocos ahora pueden decir con certeza qué calamidades dieron origen a las Greylands antes de la Regresión. La mayoría cree que fue una combinación de contaminación, cambio climático y guerras devastadoras que acabaron con la mayor parte de la vegetación y mutaron todo a su alrededor en restos lamentables de árboles y arbustos junto con una especie anémica de hierba. Estos viven al azar en el vasto desierto gris donde las cosas solo crecen cuando se cultivan e irrigan intensamente. Una capa de ozono rota hace que el sol se convierta en una amenaza a evitar y entre los Greylanders el melanoma es diez veces más común que en las ciudades. Además, la constante escasez de agua dulce limpia causa muchas más enfermedades y deformidades en los habitantes de Greyland que en los que son provenientes de areas urbanas.
					</p>
					<p>
						Los millones de empleados urbanos en las ciudades requieren enormes cantidades de alimentos. Casi toda la comida en Cascadia es producida por la Casta Baja que trabaja en las gigantescas cúpulas de comida que salpican las tierras grises entre las ciudades. Estas son las sobras de la era OmniStat, y aunque se han mejorado de alguna manera a través de los avances científicos y tecnológicos, todavía requieren muchos recursos en términos de mano de obra, agua y energía. Protegidos de los rayos UV excesivos por el vidrio especialmente tratado de las gigantescas cúpulas, los cultivos debajo prosperan y crecen, fertilizados por los desechos de las ciudades y las empresas emplean el trabajo en los campos. Aquí se puede encontrar todo lo verde que se esperaría de un paisaje saludable, y algunos Casta Baja son más felices aquí que en las ciudades áridas, a pesar de que la vida en las cúpulas es infinitamente más difícil.
					</p>
				</div>
			</div>
			<div class = 'Descripcion'>
				<div class = 'DescripcionTexto'>
					<h4>Arquitectura y Vida</h4>
					<p>
						La Ciudad es una inmensa Metrópolis utópica. 
					</p>
					<p>
						La mayoría de los colores en la parte exterior de la ciudad son blancos, azules y anaranjados (con el rojo ausente), mientras que muchos interiores de edificios son blancos, rojos y verdes. Está en constante construcción, ya que los materiales y equipos de construcción aparecen en casi todas las áreas.
					</p>
					<p>
						Con el paso del tiempo, la ciudad fue reestructurada para garantizar una mejor seguridad para el publico, a la innovadora y moderna arquitectura se la denomino Nueva Ciudad, las restantes y declinantes construcciones de la ciudad original se las conoció como Antigua Ciudad, convirtiéndose en guetos autogestionados y calles destartaladas lejos de los beneficios que se encuentran en los alrededores de la Nueva Ciudad.
					</p>
					<p>
						Aquellos que se rehusaron y no quisieron vivir bajo las leyes autoritarias del programa, fueron criminalizados, se fueron de la ciudad o iniciaron grupos de resistencia clandestinos para sustentar su manera de vida. Uno de esos grupos fue el servicio clandestino de mensajería, bajo el nombre de los Runners, que transportaba y repartía paquetes junto con diversas comunicaciones en toda la ciudad superando la severa vigilancia y censura de la ciudad. Sin embargo, los funcionarios de la ciudad fueron tomando nota sobre los Runners y han hecho progresos para neutralizar estas "alternativas ilegales".
					</p>
				</div>
				<div class = 'DescripcionImag'>
					<img src = "IMG/Fondo6.jpg"/>
				</div>
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