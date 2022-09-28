<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<meta name="viewport" content="initial-scale=1, maximum-scale=1">-->

	<title>Convertir Archivo Liquidaci&oacute;n</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.js"></script>
	<link rel="icon" type="image/ico" href="images/favicon.ico" />
</head>
<body>
	<div class="container" style="margin-top: 30px;margin-bottom: 30px">
		<div class="row">
			<div class="span12">
				<h2 style="text-align: center;">Conversor Archivos Liquidaci&oacute;n  Banca Nueva Empresa</h2>
				<br>
				<div class="well">
					<form role="form" action="index.php" enctype="multipart/form-data" method="post">
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<input type="file" name="archivo" id="input01" class="filestyle" data-buttonText="Buscar Archivo">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-ok"></span> Convertir
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>