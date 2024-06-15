<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>CRUD com Bootstrap</title>
		<meta name="description" content="Marterial da aula de PW">
		<meta name="Keywords" content="HTML, CSS, PHP, bootstrap, aula de pw">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="<?php echo BASEURL; ?>lf_icon,icon" type="image/x-icon">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
		<style>
			bordy{
				padding-top: 50px;
				padding-bottom: 20px;
			}
			.btm-light {
					bor-color: #FFFFFF;
					background-color #99999;
					border-color: #999999;
				}
				.btm-light:hover {
					bor-color: #FFFFFF;
					background-color #666666;
					border-color: #666666
				}
				.header, #actions {
					margi-top: 10px;
				}
		</style>
		<link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
	</head>
	<body>

		<nav class="navbar navbar-expand-md bg-dark" data-bs-theme="dark"> <!-- Começo do menu -->
		  <div class="container-fluid">
			<a class="navbar-brand" href="<?php echo BASEURL; ?>"><i class="fa-solid fa-house"></i> CRUD</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="fa-solid fa-users"></i> Clientes
				  </a>
				  <ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Adicionar Cliente</a></li>
					<li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/"><i class="fa-solid fa-user"></i> Gerenciar Clientes</a></li>
				  </ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa-solid fa-boxes-stacked"></i> Movel
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="<?php echo BASEURL; ?>moveis/add.php"><i class="fa-solid fa-couch"></i> Adicionar Movel</a></li>
						<li><a class="dropdown-item" href="<?php echo BASEURL; ?>moveis/"><i class="fa-solid fa-boxes-stacked"></i> Gerenciar Movel</a></li>
					</ul>
				</li>	
				<?php if (isset($_SESSION['user'])) : //Verifica se está logado ?>
					<?php if($_SESSION['user'] == "admin") : //Verifica se está logado como adimin ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fa-solid fa-user-tie"></i> Usuário
							</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios"><i class="fa-solid fa-user-tie"></i> Adicionar Usuário</a></li>
								<li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-solid fa-user-lock"></i> Gerenciar Usuário</a></li>
							</ul>
						</li>
				<?php endif; ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
							Bem vido(a) <?php echo $_SESSION['user'] ?>!<i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar
						</a>
					</li>
				<?php else : ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
							<i class="fa-solid fa-user"></i> Login
						</a>
					</li>
				<?php endif; ?>
			  </ul>
			</div>
		  </div>
		</nav> <!-- Fim do menu -->
		
		<main class="container">