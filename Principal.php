<html>
  <head>
     <title>
        Principal
     </title>
  </head>
  <body>
      <b>Solicitar una tarjeta<b><br><br>
     <form action="Tarjeta_solicitada.php" method="post">
      <b>Nombre</b>&nbsp;
       <input type="text" placeholder="Ingrese su nombre completo" name="Nombre">
       <br><br>
      <b>Correo</b>&nbsp;&nbsp;
        <input type="text" placeholder="Ingrese su correo electronico" name="correo" >
        <br><br>
      <b>DPI</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text"  placeholder="Ingrese el codigo de su DPI" name="DPI" >
       <br><br>
      <b>Nit</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" placeholder="Ingrese su numero de nit" name="nit" >
       <br><br>
      <b>Telefono</b>
       <input type="text" placeholder="Ingrese su numero de telefono" name="tel" >
       <br><br>
      <b>tipo de tarjeta</b>
      <select style="height:20px;width:134px;font-size:10pt;" name="tipo">
        <option value="C">Credito</option>
        <option value="D">Debito</option>
      </select>
      <br><br>
      <input type="submit" name="solicitar" value="Solicitar" style="height:50px; width:150px;font-size:16pt;"/>
    </form>
    <hr>


    <b>Hacer una compra<br><br>
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
      <input type="submit" name="Enviar" value="Enviar" style="height:50px; width:150px;font-size:16pt;"/>
    </form>
	<?php

	$link=pg_connect("host=localhost port=5432 dbname=easycarddb user=PostgreSQL password=CC6") or die('Could not connect: ' . pg_last_error());

  pg_close($link);

	?>

  </body>
</html>
