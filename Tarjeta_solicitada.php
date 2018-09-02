<html>
	<head>
		<title>
			Solicitar Tarjeta
		</title>
	</head>
	<body>
		<?php
		$Nombre_de_cuenta=$_POST["Nombre"];
		$Correo=$_POST["correo"];
		$DPI=$_POST["DPI"];
		$NIT=$_POST["nit"];
		$Telefono=$_POST["tel"];
		$Tipo=$_POST["tipo"];

		$numero_de_tarjeta = rand(1000,9999).rand(1000,9999).rand(1000,9999).rand(1000,9999);
		$numero_de_seguridad = rand(100,999);
		$fechaActual = date("-m-d");
		$FechaVencimiento = (4+(int)date("Y")).$fechaActual;

		$link=pg_connect("host=localhost port=5432 dbname=easycarddb user=PostgreSQL password=CC6") or die('Could not connect: ' . pg_last_error());

		$AgregarCliente = "INSERT INTO cliente VALUES ('$Nombre_de_cuenta','$Correo','$DPI','$NIT','$Telefono')";
		$CrearTarjeta = "INSERT INTO tarjeta VALUES ('$numero_de_tarjeta','$Tipo','$Nombre_de_cuenta','$numero_de_seguridad',1000,'$FechaVencimiento',0,'$DPI')";
		$Cliente_Agregado = pg_query($link, $AgregarCliente) or die('Query failed: ' . pg_last_error());
		$Tarjeta_agregada = pg_query($link, $CrearTarjeta) or die('Query failed: ' . pg_last_error());
		
		echo '<br><br><center><strong><font size="5">Su soluicitud fue aceptada<font></strong></center><br>';
	?>
	</body>
</html>