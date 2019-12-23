<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Metas de la página -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Punto de Inventario">
	<meta name="keywords" content="Inventario, Ventas, etc">
	<meta name="author" content="Darwin Alfonso Flores Colindres">
	<title>Punto de Inventario</title>

	<!--Icono de la página-->
	<link rel="icon" href="./imagenes/cart.png">
	<!-- Bootstrap -->
	<link href="./librerias/bootstrap.min.css" rel="stylesheet">
		<!-- icnoos font-awesome -->
	<link href="./iconos_fa/css/font-awesome.min.css" rel="stylesheet">
	<link href="./datatables/jquery.dataTables.min.css" rel="stylesheet">

</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="?">
					Punto de Inventario <span class="fa fa-shopping-basket"></span>
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="" id="li_producto"><a href="?"><i class="fa fa-th"></i> Productos</a></li>
					<li class="" id="li_venta"><a href="?view=lstventa"><i class="fa fa-money"></i> Ventas</a></li>
				</ul>

			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<br><br>	<br>
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-4">
				<div id="sidebar" role="navigation">
					<div class="panel panel-default">
						<div class="panel-heading text-center" ><strong><span class="fa fa-money"></span> DETALLE FACTURACIÓN</strong> </div>
						<div class="panel-body">
							<a href="#" id="resultados_cart"  data-toggle="modal" data-target=".myModalProducto_cart" class="btn btn-primary">
								<i class="fa fa-shopping-cart"></i> Facturar <span class="badge cartvalue">0</span></a>
						</div>
					</div>

						<!-- Datos del desarrollador -->
					<div class="panel panel-default">
						<div class="panel-heading text-center"><strong><span class="fa fa-user"></span> PERFIL DEL DESARROLLADOR</strong> </div>
						<div class="panel-body">
							<table width="100%" class="table">
								<tr>
									<td rowspan="4">


										<img src="./imagenes/foto.png" style="max-width:120px;" class="img-responsive" alt="">



									</td>
									<td><strong>Nombres:</strong> </td>
									<td> Darwin Alfonso</td>

								</tr>
								<tr>
									<td><strong>Apellidos:</strong> </td>
									<td> Flores Colindres</td>

								</tr>
								<tr>
									<td><strong>Profesión:</strong> </td>
									<td> Técnico en Ingeniería de Sistemas Informáticos</td>

								</tr>
								<tr>
									<td><strong>Edad:</strong> </td>
									<td> 23 Años</td>

								</tr>
							</table>

						</div>
					</div>


				</div>
			</div>
		
			<div class="col-md-8">
            <div class="col-md-12">
