
<?php
// localhost/EasyCard/autorizacion?tarjeta=5151515&nombre=v&fecha_venc=456&num_seguridad=546&monto=25&tienda=loasasd&formato=xml
$link=pg_connect("host=localhost port=5432 dbname=easycarddb user=PostgreSQL password=CC6") or die('Could not connect: ' . pg_last_error());

$query = "SELECT * FROM tarjeta";

/*$queryInsert = "INSERT INTO Cliente (Nombre, Correo, DPI_Cliente, NIT, Telefono) 
VALUES ('Victor', 'hola@gmail.com', '1234567859101', '1234567', '+50240471193');

INSERT INTO Tarjeta (Numero_de_tarjeta, Tipo_de_tarjeta, Nombre_del_propietario, 
	Numero_de_seguridad, Monto_Autorizado, Fecha_de_vencimiento, Monto_gastado, DPI_Cliente) 
VALUES ('1234123412341234', '0', 'Victor', '123', 5000, '2008-11-11', 0, '1234567859101');
";
$resultInsert = pg_query($link, $queryInsert) or die('Query failed: ' . pg_last_error());*/
$result = pg_query($link, $query) or die('Query failed: ' . pg_last_error());

if(isset($_POST['tarjeta']) && isset($_POST['nombre']) && isset($_POST['fecha_venc']) && isset($_POST['num_seguridad'])&& isset($_POST['monto']) && isset($_POST['tienda']) && isset($_POST['formato'])) {
}else {
	return;
}

$tarjeta = $_POST["tarjeta"];
$nombre = $_POST["nombre"];
$fecha_venc = $_POST["fecha_venc"];
$num_seguridad = $_POST["num_seguridad"];
$monto = (int)$_POST["monto"];
$tienda = $_POST["tienda"];
$formato = $_POST["formato"];

$status = 'DENEGADO';
$NumeroAutorizacion = 0;

while ($line = pg_fetch_row($result)) {

	$Numero_de_tarjeta = $line[0];
	$Tipo_de_tarjeta = $line[1];
	$Nombre_del_propietario = $line[2];
	$Numero_de_seguridad = $line[3];
	$Monto_Autorizado = $line[4];
	$Fecha_de_vencimiento = $line[5];
	$Monto_gastado = (int)$line[6];
	$DPI_Cliente = $line[7];
		
	if ($Numero_de_tarjeta === $tarjeta && $num_seguridad === $Numero_de_seguridad){
		$Monto_Disponible = $Monto_Autorizado-$Monto_gastado;
		if ($Monto_Disponible >= $monto){
			//verificamos que la tarjeta no este vencida
			$fechaActual = date("Y-m-d");
			if((int)substr($fecha_venc,0,4) < (int)substr($fechaActual,0,4) ){
				$status = 'DENEGADO';
			}else if((int)substr($fecha_venc,5,2) < (int)substr($fechaActual,5,2)){
				$status = 'DENEGADO'; 
			}
			//si nos mandan el codigo de la tienda
			$verificarTienda = "SELECT * FROM Tienda WHERE Codigo = $tienda"; 
			//si nos mandan el nombre de la tienda
			if (!is_int($tienda)){ 
				$verificarTienda = "SELECT Codigo FROM Tienda WHERE Nombre = '$tienda'";
				$verTien = pg_query($link, $verificarTienda);
				if(pg_num_rows($verTien) != 0){
					$line = pg_fetch_row($verTien);
					$tienda = $line[0]; //Agarramos el codigo.
				}
			}

			if ((pg_num_rows(pg_query($link, $verificarTienda)) == 0) || ($status === 'DENEGADO'))  {
				$status = 'DENEGADO'; //No existe esa tienda.
			}else{
				$status = 'APROBADO';
				$actualizarTarjeta = "UPDATE Tarjeta SET Monto_gastado = Monto_gastado + '$monto' WHERE Numero_de_tarjeta = '$tarjeta'";
				$queryInsertRegistro = "INSERT INTO Registro_de_uso (monto_utilizado, fecha_de_uso, tipo_de_Transaccion, Numero_de_tarjeta) VALUES('$monto', '$fechaActual',0, '$tarjeta')";
				$lugarDeUso = "INSERT INTO donde_se_uso(codigo) VALUES('$tienda')";
				pg_query($link, $actualizarTarjeta) or die('Query failed: ' . pg_last_error());
				pg_query($link, $queryInsertRegistro) or die('Query failed: ' . pg_last_error());
				pg_query($link, $lugarDeUso) or die('Query failed: ' . pg_last_error());
				$NumeroAutorizacion = rand(1000,9999); //Numero de 4 digitos.
			}
		}
		break;
	}
   
}



if($formato === "XML" || $formato === "xml" || $formato === 0){
	echo "\t<autorizacion>\n";  
	echo "\t\t<emisor>EasyCard</emisor>\n"; 
	echo "\t\t<tarjeta>$tarjeta</tarjeta>\n";
	echo "\t\t<status>$status</status>\n";
	echo "\t\t<numero>$NumeroAutorizacion</numero>\n";
	echo "\t</autorizacion>\n";
}else{
	echo "\t{\"autorizacion\":\n";  
	echo "\t\t{\"emisor\": \"EasyCard\",\n"; 
	echo "\t\t\"tarjeta\": \"$tarjeta\",\n"; 
	echo "\t\t\"status\": \"$status\",\n"; 
	echo "\t\t\"numero\": \"$NumeroAutorizacion\"\n"; 
	echo "\t\t}\n";
	echo "\t}\n";
}


pg_close($link);

?>

