
<?php

	/* mod001_conectaBaseDatos
	
		-- Descripcion larga --
			Se conecta a la base de datos indicada mediante las variables de la función, si no se conecta saca un mensaje indicándolo.
		-- Argumentos --
			Sin argumentos.
		-- Variables principales --
			$direccion							: Es la variable que indica el nombre del host o la dirección ip.
			$usuario							: Es la variable que indica el nombre de usuario MySQL.
			$contrasenna						: Es la variable que indica la contraseña MySQL.
			$BaseDatos							: Es la variable que indica el nombre de la base de datos.
		-- Retorno --
			$conexion							: Objeto que representa la conexión establecida al servidor de MySQL.
		-- Funciones a las que llama --
			Ninguna
		-- Funciones que la llaman --
			Todas las del mod002
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/

	function mod001_conectaBaseDatos()
	{
		$direccion = "localhost";
		$usuario = "root";
		$contrasenna = "";
		$BaseDatos = "bdfacultades";
		
		$conexion = mysqli_connect ( $direccion, $usuario, $contrasenna, $BaseDatos );
		
		if ( !$conexion ) 
		{
			echo "Conexion Fallida";
		} 
		
		return $conexion;
	}
	
	/* mod001_desconectaBaseDatos
	
		-- Descripcion larga --
			Se desconecta de la base de datos indicada por la conexión enviada ( si dicha conexión se ha establecido correctamente ).
		-- Argumentos --
			$conexion							: Es un objeto que representa la conexión establecida al servidor de MySQL.
		-- Variables principales --
			Ninguna
		-- Retorno --
			Ninguno
		-- Funciones a las que llama --
			Ninguna
		-- Funciones que la llaman --
			Todas las del mod002
		-- Autor --
			Autor								: David Brunete Fernández.
		-- Fechas --
			Creacion							: 2021 - Mayo
			Revisión							: 2021 - Junio
		
	*/
	
	function mod001_desconectaBaseDatos( $conexion )
	{
		if ( $conexion ) 
		{
			mysqli_close( $conexion );
		}
	}

?>
