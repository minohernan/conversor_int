<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Legajos Faltantes</title>
</head>
<body>
	<h1>Recomendacion Hay legajos con datos incompletos.</h1>
	<ul>
		<!-- Mostrar en Html -->
		<?php			
			$legajos = $_GET['legajos'];
			if(isset($legajos))
			{
				foreach($legajos as $legajo)
				{
				   echo '<li>"Legajo incompleto": '.$legajo['valor'].'</li>';
				}
			} else
			  {
				 echo '<li>"No hay inconvenientes"</li>';
			  }
		?>		
	</ul>
</body>
</html>