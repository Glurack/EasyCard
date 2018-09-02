<html>
  <head>
     <title>
        Principal
     </title>
  </head>
  <body>
    <form action="autorizacion.php" method="post">
      <b>Numero de la tarjeta</b>&nbsp;
       <input type="text" placeholder="Ingrese el numero en su tarjeta" name="tarjeta">
       <br><br>
      <b>Nombre de la tarjeta</b>&nbsp;
        <input type="text" placeholder="Ingrese el nombre en su tarjeta" name="nombre" >
        <br><br>
      <b>Fecha de vencimiento</b>
        <input type="date"  name="fecha_venc" >
       <br><br>
      <b>Numero de seguridad</b>
        <input type="password" placeholder="Ingrese numero que esta detras de su tarjeta" name="num_seguridad" >
       <br><br>
      <b>Monto utilizado</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="text" placeholder="Ingrese el monto utilizado en su compra" name="monto" >
       <br><br>
      <b>Nombre de la tienda</b>&nbsp;
       <input type="text" placeholder="Ingrese el nombre de la tienda donde se uso la tarjeta" name="tienda" >
       <br><br>
      <b>Formato</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="text" placeholder="Ingrese el formato en el que se usara el web service" name="formato" >
       <br><br>
      <input type="submit" name="submit" value="Enviar" style="height:50px; width:150px;font-size:16pt;"/>
    </form>
	<?php

	$link=pg_connect("host=localhost port=5432 dbname=easycarddb user=PostgreSQL password=CC6") or die('Could not connect: ' . pg_last_error());

  pg_close($link);

	?>

  </body>
</html>
