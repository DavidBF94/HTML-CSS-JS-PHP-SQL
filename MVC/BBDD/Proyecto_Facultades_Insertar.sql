
USE BDFACULTADES;

-- Tabla DECANOS --

INSERT INTO `1000DECANOS`
	( 1000iddecano, 1000dnidecano, 1000nomdecano, 1000apellidosdecano, 1000direcciondecano, 1000telefonodecano, 1000correodecano, 1000nomficherofotodecano )
VALUES
	(	null,		"34784690L",		"Juan Luis",		"Saavedra Anton",		"Calle Felipe Castro, 30, 28026 Madrid",								"674198741",		"saavjl@ucm.es",		"IMG/Dec_001.png" ),
	(	null,		"85730758S",		"Alfredo",			"Aramburu Pla",			"Calle del Corregidor Diego Cabeza de Vaca, 4-10, 28030 Madrid",		"657195017",		"aramburua@ucm.es",		"IMG/Dec_002.png" ),
	(	null,		"99275017T",		"Luis Miguel",		"Granado Paton",		"Calle de Santoña, 51, 28026 Madrid",									"601987654",		"granadolm@ucm.es",		"IMG/Dec_003.png" ),
	(	null,		"10836199E",		"Sandra",			"Suero Freire",			"Calle de Melilla, 1, 28005 Madrid",									"607789114",		"suerosan@ucm.es",		"IMG/Dec_004.png" ),
	(	null,		"57800175J",		"Amparo",			"Roncoso Rial",			"Calle de Dolores Barranco, 44-48, 28026 Madrid",						"606583201",		"roncosoa@ucm.es",		"IMG/Dec_005.png" );

-- Tabla FACULTADES --

INSERT INTO `2000FACULTADES`
	( 2000idfacultad, 2000nomfacultad, 2000direccionfacultad, 2000descripcionfacultad, 2000nomficherofotofacultad )
VALUES
	(	null,		"Filosofía",				"Ciudad Universitaria, Plaza Menéndez Pelayo, s/n, 28040 Madrid", "La Filosofía es una disciplina académica y un conjunto de reflexiones y conocimientos de carácter trascendental que, en un sentido general, estudia la esencia, las causas primeras y los fines últimos de las cosas.", "IMG/Fac_01.png" ),
	(	null,		"Ciencias Biológicas",		"C. de José Antonio Novais, 12, 28040 Madrid", "La Biología es la ciencia que estudia los procesos naturales de los organismos vivos, en diversos campos especializados. La biología se ocupa tanto de la descripción de las características y los comportamientos de los organismos individuales, como de las especies en su conjunto, así como de la reproducción de los seres vivos y de las interacciones entre ellos y el entorno.", "IMG/Fac_02.png" ),
	(	null,		"Ciencias Matemáticas",		"Plaza Ciencias, 3, 28040 Madrid", "La Matemática es una ciencia formal que, partiendo de axiomas y siguiendo el razonamiento lógico, estudian las propiedades, estructuras abstractas y relaciones entre entidades abstractas como números, figuras geométricas, iconos, glifos o símbolos en general.", "IMG/Fac_03.png" ),
	(	null,		"Ciencias Físicas",			"Plaza Ciencias, 1, 28040 Madrid", "La Física es la ciencia natural que estudia los componentes fundamentales del Universo, la energía, la materia, el espacio-tiempo y las interacciones fundamentales.​ La física es una ciencia básica estrechamente vinculada con las matemáticas y la lógica en la formulación y cuantificación de sus principios.", "IMG/Fac_04.png"),
	(	null,		"Geografía e Historia",		"Edif. B, Calle del Prof. Aranguren, s/n, 28040 Madrid", "La Historia es la ciencia que estudia los sucesos del pasado; generalmente son de la humanidad, aunque, también puede no estar centrada en el humano. Asimismo, es una disciplina académica que narra dichos acontecimientos. Es una ciencia social debido a su clasificación y método, pero, si no se centra en el humano, puede ser considerada como una ciencia natural, especialmente en un marco de la interdisciplinariedad, de cualquier forma, forma parte del la clasificación de la ciencia que engloba las anteriores dos, es decir, una ciencia fáctica (también llamada factual).", "IMG/Fac_05.png" );

-- Tabla DECANOFACULTAD --

INSERT INTO `1100DECANOFACULTAD`
	( 1000iddecano, 2000idfacultad, 1100fecdecano, 1100salariodecano )
VALUES
	( 	1,			1,			"2002/05/28",			24000.00),
	( 	2,			1,			"2011/10/14",			27000.00),	
	( 	1,			5,			"2011/10/14",			25000.00),
	( 	3,			4,			"2008/09/03",			28000.00),
	( 	3,			3,			"2012/09/05",			26000.00),
	( 	4,			2,			"2015/07/11",			30000.00),	
	( 	5,			3,			"2020/07/11",			29000.00);

-- Tabla CARRERAS --
	
INSERT INTO `2100CARRERAS`
	( 2100idcarrera, 2000idfacultad, 2100nomcarrera, 2100descripcioncarrera, 2100nomficherofotocarrera )
VALUES
	(	null,		1,			"Filosofía", "La Filosofía es una titulación universitaria que ofrecen todos los grandes centros universitarios del mundo, y se la considera fundamental en las culturas occidentales porque sus egresados contribuyen en la sociedad con una reflexión crítica permanente sobre todo lo que constituye el ámbito de lo humano, desde lo que es el conocimiento mismo y las condiciones y maneras en las que éste se desarrolla, hasta todo lo que confiere el ser y la acción humana, ligado, por ejemplo a lo que es una reflexión antropológica, política, ética, lingüística, etc. del hombre. Todo ello lo combina la Filosofía con un profundo conocimiento de la historia de las ideas, es decir, del proceso en el que la Humanidad ha ido gestando las ideas y principios que la configuran en la actualidad, lo cual le permite, a su vez, contribuir al logro de formas sociales crecientemente humanizadas.", "IMG/Carr_001.png" ),
	(	null,		1,			"Derecho y Filosofía", "Si la Filosofía podemos entenderla como la aspiración por estudiar y encontrar categorías universales y abstractas, la Filosofía del Derecho la podemos entender como el estudio completo del fenómeno jurídico en la sociedad de forma abstracta y sin referencia al hecho concreto. Es decir, la Filosofía del Derecho estudia cosmovisiones de lo jurídico, con lo que intenta ofrecer una visión global del fenómeno jurídico, incluyendo sus diversas dimensiones (institucional, normativa, social, moral, etc.). En este sentido, la Filosofía del Derecho responde a tres grandes preguntas: ¿Qué es el Derecho? ¿Cómo debería ser? ¿Cómo lo conocemos?", "IMG/Carr_002.png" ),
	(	null,		2,			"Biología", "Se ha dicho que la Biología es la ciencia estrella del siglo XXI. En la Facultad de Biología tenemos la responsabilidad de generar y transferir a la sociedad los conceptos de esa Biología, pero sobre todo tenemos y queremos asumir la responsabilidad ineludible de convertir a nuestros estudiantes en los profesionales que harán de la Biología la base de la conservación de nuestro medio ambiente, de la producción sostenible de nuestros alimentos, del cuidado de nuestra salud o de la producción de nuestra energía, en condiciones de accesibilidad a toda la sociedad.", "IMG/Carr_003.png" ),
	(	null,		2,			"Bioquímica", "La Bioquímica es una rama de la ciencia que estudia la composición química de los seres vivos, especialmente las proteínas, carbohidratos, lípidos y ácidos nucleicos, además de otras pequeñas moléculas presentes en las células y las reacciones químicas que sufren estos compuestos (metabolismo) que les permiten obtener energía (catabolismo) y generar biomoléculas propias (anabolismo). La Bioquímica se basa en el concepto de que todo ser vivo contiene carbono y en general las moléculas biológicas están compuestas principalmente de carbono, hidrógeno, oxígeno, nitrógeno, fósforo y azufre.", "IMG/Carr_004.png" ),
	(	null,		3,			"Matemáticas", "La Matemática es la ciencia deductiva que se dedica al estudio de las propiedades de los entes abstractos y de sus relaciones. Esto quiere decir que las matemáticas operan con números, símbolos, figuras geométricas, etc. A partir de axiomas y siguiendo razonamientos lógicos, las matemáticas analizan estructuras, magnitudes y vínculos de los entes abstractos. Esto permite, una vez detectados ciertos patrones, formular conjeturas y establecer definiciones a las que se llegan por deducción.Las matemáticas trabajan con cantidades (números) pero también con construcciones abstractas no cuantitativas. Su finalidad es práctica, ya que las abstracciones y los razonamientos lógicos pueden aplicarse en modelos que permiten desarrollar cálculos, cuentas y mediciones con correlato físico.", "IMG/Carr_005.png" ),
	(	null,		4,			"Física", "La Física se ocupa de la observación y comprensión de los fenómenos del mundo que nos rodea, así como de la predicción de nuevos fenómenos. No sólo es una apasionante aventura intelectual que nos ha permitido descubrir la Teoría de la Relatividad o el origen y la evolución del Universo, sino que también desempeña un papel básico en el desarrollo de la sociedad, generando el conocimiento fundamental necesario para los avances tecnológicos que son el motor de la economía mundial. La Física se ocupa de los temas más importantes de carácter práctico, ambiental y tecnológico de nuestro tiempo, contribuyendo a la mejora de nuestra calidad de vida. La Física cubre un campo muy amplio que incluye matemáticas y teoría, experimentos y observaciones, computación, ingeniería, ciencia de materiales y teoría de la información. De manera que la Física está siempre presente en nuestra vida cotidiana.", "IMG/Carr_006.png" ),
	(	null,		4,			"Matemáticas y Física", "La Matemática es la ciencia deductiva que se dedica al estudio de las propiedades de los entes abstractos y de sus relaciones. Esto quiere decir que las matemáticas operan con números, símbolos, figuras geométricas, etc. A partir de axiomas y siguiendo razonamientos lógicos, las matemáticas analizan estructuras, magnitudes y vínculos de los entes abstractos. Esto permite, una vez detectados ciertos patrones, formular conjeturas y establecer definiciones a las que se llegan por deducción.Las matemáticas trabajan con cantidades (números) pero también con construcciones abstractas no cuantitativas. Su finalidad es práctica, ya que las abstracciones y los razonamientos lógicos pueden aplicarse en modelos que permiten desarrollar cálculos, cuentas y mediciones con correlato físico. La Física se ocupa de la observación y comprensión de los fenómenos del mundo que nos rodea, así como de la predicción de nuevos fenómenos. No sólo es una apasionante aventura intelectual que nos ha permitido descubrir la Teoría de la Relatividad o el origen y la evolución del Universo, sino que también desempeña un papel básico en el desarrollo de la sociedad, generando el conocimiento fundamental necesario para los avances tecnológicos que son el motor de la economía mundial. La Física se ocupa de los temas más importantes de carácter práctico, ambiental y tecnológico de nuestro tiempo, contribuyendo a la mejora de nuestra calidad de vida. La Física cubre un campo muy amplio que incluye matemáticas y teoría, experimentos y observaciones, computación, ingeniería, ciencia de materiales y teoría de la información. De manera que la Física está siempre presente en nuestra vida cotidiana.", "IMG/Carr_007.png" ),
	(	null,		5,			"Arqueología", "La Arqueología se ha convertido en una disciplina científica compleja e interdisciplinar para cuyo ejercicio resulta necesaria una preparación específica; porque al estudio de las sociedades del pasado mediante el uso de métodos y técnicas adecuadas, añade las labores de conservación y puesta en valor de los yacimientos arqueológicos, muy numerosos en España, cuya investigación y protección requieren esta formación. Dentro de las ciencias humanas, la Arqueología ocupa un lugar muy especial, por sus particulares métodos de trabajo: primero la necesidad de buscar los yacimientos arqueológicos y luego, dentro de ellos, la información deseada. Para obtener la mayor información posible, esta ciencia necesita la colaboración de otras especialidades, convirtiéndose así en una de las materias más interdisciplinares del campo de las Humanidades.", "IMG/Carr_008.png" ),
	(	null,		5,			"Historia", "La Historia es la ciencia que estudia y sistematiza los hechos más importantes y trascendentales del pasado humano. Dichos sucesos son analizados y examinados en función de sus antecedentes, causas y consecuencias, y en la acción mutua de unos sobre otros, con el propósito de comprender correctamente el presente y de preparar el futuro. Su estudio no es un simple ejercicio memorístico, cargado de hechos, nombres, lugares y fechas sin conexión alguna. Esta es, ante todo, la posibilidad que el ser humano tiene para conocerse a sí mismo. Es indagar en el pasado para comprender el porqué de nuestro presente, y sobretodo, ver al hombre en su dimensión; sus aciertos, sus errores y la capacidad que la humanidad tiene para ser una especie más perfecta, mejor organizada y más justa.", "IMG/Carr_009.png" );
	
-- Tabla ALUMNOS --

INSERT INTO `3000ALUMNOS`
	( 3000idalumno, 3000dnialumno, 3000nomalumno, 3000apellidosalumno, 3000direccionalumno, 3000telefonoalumno, 3000correoalumno, 3000nomficherofotoalumno )
VALUES
	(	null,		"87013805K",		"Martin",		"Cerezo Boluda",		"Calle Sierra Bermeja, 15-9, 28053 Madrid",						"650264421",		"cerezbolm@ucm.es",		"IMG/Alum_00001.png" ),
	(	null,		"28817659Q",		"Maria",		"Aguilar Casals",		"Cmo de Valderribas, 34-42, 28038 Madrid",						"605947028",		"aguilarcm@ucm.es",		"IMG/Alum_00002.png" ),
	(	null,		"30967649N",		"Aitor",		"Prieto Meseguer",		"Calle Escosura, 21, 28015 Madrid",								"663979082",		"prietoma@ucm.es",		"IMG/Alum_00003.png" ),
	(	null,		"01706331F",		"Raquel",		"Angel Gandara",		"Calle Triunfo, 11-5, 28011 Madrid",							"694535936",		"angelgr@ucm.es",		"IMG/Alum_00004.png" ),
	(	null,		"70310930E",		"Josep",		"Collazo Mayoral",		"Calle Algorta, 21, 28019 Madrid",								"692273860",		"collazomj@ucm.es",		"IMG/Alum_00005.png" ),
	(	null,		"57455061A",		"Nuria",		"Cubas Sobrino",		"Calle del Radio, 9-5, 28019 Madrid",							"661341042",		"cubassn@ucm.es",		"IMG/Alum_00006.png" ),
	(	null,		"50584224W",		"Mario",		"Camino Berbel",		"Calle Azucenas, 10-12, 28039 Madrid",							"695216958",		"caminobm@ucm.es",		"IMG/Alum_00007.png" ),
	(	null,		"13399100J",		"Irene",		"Yañez Velasquez",		"Calle del Arroyo del Quinto, 12-14, 28043 Madrid",				"698265439",		"yannezvi@ucm.es",		"IMG/Alum_00008.png" );	
	
-- Tabla CARRERASALUMNOS --

INSERT INTO `2110CARRERASALUMNOS`
	( 2110feccarrera, 3000idalumno, 2100idcarrera )
VALUES
	( 	"2020/09/1",		2,		3 ),
	( 	"2020/09/1",		2,		4 ),
	( 	"2020/09/1",		1,		2 ),
	( 	"2020/09/20",		1,		1 ),
	( 	"2019/09/1",		3,		5 ),
	( 	"2019/09/20",		3,		6 ),
	( 	"2019/10/5",		3,		1 ),
	( 	"2018/09/1",		4,		8 ),
	( 	"2021/09/1",		5,		3 ),
	( 	"2021/09/3",		6,		3 ),
	( 	"2021/11/5",		6,		4 ),
	( 	"2020/10/1",		7,		8 ),
	( 	"2021/09/1",		7,		9 );

-- Tabla CURSOS --

INSERT INTO `4000CURSOS`
	( 4000idcurso, 4000nomcurso )
VALUES
	( 	null,		"Primero" ),
	( 	null,		"Segundo" ),
	( 	null,		"Tercero" ),
	( 	null,		"Cuarto" );
	
-- Tabla CREDITOS --

INSERT INTO `5000CREDITOS`
	( 5000idcreditos, 5000numcreditos )
VALUES
	( 	null,		6.0 ),
	( 	null,		7.5 ),
	( 	null,		9.0 ),
	( 	null,		12.0 );
	
-- Tabla ASIGNATURAS --

INSERT INTO `2120ASIGNATURAS`
	( 2120idasignatura, 2100idcarrera, 4000idcurso, 5000idcreditos, 2120nomasignatura, 2120bvigencia )
VALUES
	(	 1,		6,		1,		2,		"Álgebra",				1 ),
	(	 2,		5,		1,		2,		"Álgebra",				1 ),
	(	 3,		5,		2,		1,		"Topología",			1 ),
	(	 4,		6,		2,		4,		"Laboratorio II",		1 ),
	(	 5,		3,		4,		1,		"Neurobiología",		1 ),
	(	 6,		1,		2,		1,		"Lógica II",			1 ),
	(	 7,		9,		3,		1,		"Etnología",			1 );
	
-- Tabla DEPARTAMENTOS --

INSERT INTO `6000DEPARTAMENTOS`
	( 6000iddepartamento, 6000nomdepartamento )
VALUES
	( 	null,		"Física Teórica" ),
	( 	null,		"Análisis Matemático y Matemática Aplicada" ),
	( 	null,		"Biología Celular" ),
	( 	null,		"Geografía" ),
	( 	null,		"Historia Moderna y Contemporánea" ),
	( 	null,		"Lógica y Filosofía Teórica" );
	
-- Tabla ASIGNATDEPART --

INSERT INTO `2122ASIGNATDEPART`
	( 2120idasignatura, 6000iddepartamento )
VALUES
	(	1,		1 ),
	(	3,		1 ),
	(	5,		3 ),
	(	6,		6 ),
	(	7,		5 ),
	(	7,		4 );
	
-- Tabla PROFESORES --
	
INSERT INTO `7000PROFESORES`
	( 7000idprofesor, 7000dniprofesor, 7000nomprofesor, 7000apellidosprofesor, 7000direccionprofesor, 7000telefonoprofesor, 7000correoprofesor, 7000nomficherofotoprofesor )
VALUES
	(	null,		"32604590C",		"Pablo",		"Pajares Pastor",		"Calle Sanchidrián, 9, 28024 Madrid",						"754660262",		"pajarespp@ucm.es",		"IMG/Prof_0001.png" ),
	(	null,		"98922954T",		"Natalia",		"Arana Urbano",			"Calle Vicenta Villegas, 8-32, 28047 Madrid",				"658410746",		"aranaun@ucm.es",		"IMG/Prof_0002.png" ),
	(	null,		"62683591N",		"Sebastián",	"Reyes Sevilla",		"Calle de Gallur, 57, 28047 Madrid",						"622099002",		"reyesss@ucm.es",		"IMG/Prof_0003.png" ),
	(	null,		"36154411K",		"Sonia",		"Samper Poyatos",		"Calle Athos, 37, 28011 Madrid",							"608860301",		"samperps@ucm.es",		"IMG/Prof_0004.png" ),
	(	null,		"14290481Y",		"Salvador",		"Benavent Bertran",		"Calle Algete, 2-10, 28045 Madrid",							"651241662",		"benaventbs@ucm.es",	"IMG/Prof_0005.png" ),
	(	null,		"26336854Z",		"Catalina",		"Vivancos Zambrana",	"Calle José Paulete, 6-22, 28038 Madrid",					"749052499",		"vivancoszc@ucm.es",	"IMG/Prof_0006.png" ),
	(	null,		"02123605S",		"Gabriel",		"Dorta Borrego",		"Calle Malgrat de Mar, 38-20, 28038 Madrid",				"679899133",		"dortabg@ucm.es",		"IMG/Prof_0007.png" );
	
-- Tabla PROFESDEPART --

INSERT INTO `6100PROFESDEPART`
	( 6000iddepartamento, 7000idprofesor, 6100fecdepartamento, 6100salarioprofesor )
VALUES
	( 	1,		1,		"2012/07/10",		21000.00 ),
	( 	1,		2,		"2011/06/01",		22000.00 ),	
	( 	3,		3,		"2008/03/03",		26000.00 ),	
	( 	3,		4,		"2010/01/25",		24000.00 ),
	( 	2,		5,		"2013/07/20",		25000.00 ),
	( 	4,		6,		"2016/09/01",		24000.00 ),
	( 	5,		6,		"2017/10/02",		26000.00 ),
	( 	4,		7,		"2013/08/14",		22000.00 ),
	( 	6,		7,		"2015/09/10",		23000.00 );
	
-- Tabla GRUPOS --

INSERT INTO `8000GRUPOS`
	( 8000idgrupo, 8000nomgrupo )
VALUES
	(	null,		"A" ),
	(	null,		"B" ),
	(	null,		"C" ),
	(	null,		"D" ),
	(	null,		"E" );

-- Tabla ASIGNATGRUPO --

INSERT INTO `2121ASIGNATGRUPO`
	( 8000idgrupo, 2120idasignatura, 2121fecgrupo )
VALUES
	(	1,		5,		"2012/08/01" ),
	(	2,		5,		"2012/08/01" ),
	(	3,		5,		"2012/08/01" ),
	(	4,		5,		"2012/08/01" );
	
-- Tabla ASIGNATCARRALUMNGRUPO --

INSERT INTO `2121AASIGNATCARRALUMNGRUPO`
	( 2110feccarrera, 3000idalumno, 2100idcarrera, 2120idasignatura, 8000idgrupo, 2121fecgrupo, 2121Afecinicioalum )
VALUES
	( "2020/09/1",		2,		3,		5,		1,		"2012/08/01",		"2020/09/11" ),
	( "2020/09/1",		2,		3,		5,		1,		"2012/08/01",		"2021/09/11" ),
	( "2021/09/1",		5,		3,		5,		3,		"2012/08/01",		"2021/09/11" ),
	( "2021/09/3",		6,		3,		5,		4,		"2012/08/01",		"2021/09/11" );

-- Tabla PRECIOCREDITOS --

INSERT INTO `9000PRECIOCREDITOS`
	( 9000anno, 9000preciocredito, 9000incremento )
VALUES
	( "2020",		22.50,		10.50 ),
	( "2021",		23.00,		11.00 );
	
