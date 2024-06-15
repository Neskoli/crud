<?php
	include ("config.php");
	require_once (DBAPI);
	if (!isset($_SESSION)) session_start();
	include(HEADER_TEMPLATE);
	$db = open_database();
?>

	<h1>Dashboar</h1>
	<hr>

	<?php if ($db) : ?>

		<div class="row">
			<div class="col-xs-6 col-sm-3 col-md-2"><!-- Customers/Clientes -->
				<a href="<?php echo BASEURL; ?>customers/add.php" class="btn btn-secondary">
					<div class="row">
						<div class="col-xs-12 text-center">
							<!-- <i class="fa fa-plus fa-5x"></i>-->
							<i class="fa-solid fa-user-plus fa-5x"></i>
						</div>
						<div class="col-xl-12 text-center">
							<p>Novo Clientes</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-l19-6 col-sm-3 col-md-2">
				<a href="<?php echo BASEURL; ?>customers" class="btn btn-light">
					<div class="row">
						<div class="col-xl-12 text-center">
							<!--<i class="fa fa-user fa-5x"></i>-->
							<i class="fa-solid fa-user fa-5x"></i>
						</div>
						<div class="col-xl-12 text-center">
							<p>Clientes</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		<br>
		<div class="row" id="actions"><!-- Linha dos produtos -->
			<div class="col-lg-2 col-sm-3 col-md-2">
				<a href="<?php echo BASEURL; ?>movel/add.php" class="btn btn-secondary">
					<div class="row">
						<div class="col-xl-12 text-center">
							<!--<i class="fa fa-plus fa-5x"><a/i>-->
							<i class="fa-solid fa-boxes-stacked fa-4x"></i> <i class="fa-solid fa-plus fa-4x"></i>
						</div>
						<div class="col-xl-12 text-center">
							<p>Novo Movel</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-l19-2 col-sm-3 col-md-2">
				<a href="<?php echo BASEURL; ?>mevel" class="btn btn-light">
					<div class="row">
						<div class="col-xl-12 text-center">
							<!--<i class="fa fa-user fa-5x"></i>-->
							<i class="fa-solid fa-couch fa-4x"></i>
						</div>
						<div class="col-xl-12 text-center">
							<p>Movel</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		<br>
		<?php if (isset($_SESSION['user'])) : //Verifica se está existe usuário ?>
			<?php if ($_SESSION['user'] == "admin") : //Verifica se está logado como adimin ?>

				<div class="row" id="actions"><!-- Usuários -->
					<div class="col-lg-2 col-sm-3 col-md-2">
						<a href="<?php echo BASEURL; ?>usuarios/add.php" class="btn btn-secondary">
							<div class="row">
								<div class="col-xl-12 text-center">
									<!--<i class="fa fa-plus fa-5x"></i>-->
									<i class="fa-solid fa-user-tie fa-5x"></i>
								</div>
								<div class="col-xl-12 text-center">
									<p>Novo Usuário</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-2 col-sm-3 col-md-2">
						<a href="<?php echo BASEURL; ?>usuarios" class="btn btn-light">
							<div class="row">
								<div class="col-xl-12 text-center">
									<!--<i class="fa fauser fa-5x"></i>-->
									<i class="fa-solid fa-user-lock fa-5x"></i>
								</div>
								<div class="col-xs-12 text-center">
									<p>Usuários</p>
								</div>
							</div>
						</a>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php else : ?>
	<!-- Comentei a DIV abaixo -->
	<!--
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dadoa!</p>
	</div> -->
		<?php if (lempty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
				<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dadoa!<br>
				<?php echo $_SESSION['message']; ?></p>
				<button type="button" class="btn-close" data-bs-dissmiss="alert" aria-label="Close"></button>
			</div>
			<?php clear_messages(); ?>
		<?php endif; ?>
	<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>