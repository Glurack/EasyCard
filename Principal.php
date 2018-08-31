<html>
  <head>
     <title>
        Principal
     </title>
  </head>
  <body>

	<?php

	$link = mysqli_connect('localhost', 'root', '','EasyCardDB') or die('Could not connect: ' . mysqli_error());

	mysqli_close($link);


	?>

  </body>
</html>
