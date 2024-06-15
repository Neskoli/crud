<?php
	//esse é o index.php
	require("functions.php");
/*
	if (!isset($_SESSION)) session_start();
	if (isset($_SESSION['user'])){ //Verifica se tme um usuário logado
		if ($_SESSION['user'] != "admin"){ // Verifica se o usuário e adimin
			$_SESSION['message'] = "Você precisa ser administrador para acessar esse recourso!";
			$_SESSION['type'] = "danger";
			//header("Location:" . BASEURL . "index.php");
		}
	} else{
		$_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
		$_SESSION['type'] = "danger";
			//header("Location:" . BASEURL . "index.php");
	}
*/
	if (isset($_GET['pdf'])){ // Você precisa estar logado e ser adiministrador para acessar esse recurso!";
			if($_GET['pdf']=="ok"){
				pdf();
			} else{
				pdf($_GET['pdf']);
			}
		}
	index();
?>

<?php include(HEADER_TEMPLATE); ?>
	<?php if (!empty($_SESSION['message'])) : ?>
		<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
			<?php echo $_SESSION['message']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<a href="<?php echo BASEURL; ?>" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
	<?php else : ?>
		<header>
			<div class="row">
				<div class="col-sm-6">
					<h2>Clientes</h2>
				</div>
				<div class="col-sm-6 text-right h2">
					<a class="btn btn-secondary" href="add.php"><i class="fa fa-plus"></i> Novo Clientes</a>
					<?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
					<a class="btn btn-danger" href="index.php?pdf=<?php echo $_POST['user']; ?>" download><i class="fa-solid fa-file-pdf"></i> Listagem</a>
					<?php else : ?>
					<a class="btn btn-danger" href="index.php?pdf="ok" download><i class="fa-solid fa-file-pdf"></i> Listagem</a>
					<?php endif; ?>
					<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
				</div>
			</div>
		</header>
		
		<?php if (!empty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
				<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
				<?php echo $_SESSION['message']; ?>
			</div>
			<?php clear_messages(); ?>
		<?php endif; ?>
		
		<hr>
		
		<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
					<th width="30%">Nome</th>
					<th>CPF/CNPJ</th>
					<th>Telefone</th>
					<th>Atualizado em</th>
					<th>Opções</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($customers) : ?>
		<?php foreach ($customers as $customer) : ?>
			<tr>
				<td align='center'><?php echo $customer['id']; ?></td>
				<td><?php echo $customer['name']; ?></td>
				<td><?php echo $customer['cpf_cnpj']; ?></td>
					<td><?php echo formatacel($customer['mobile']); ?></td>
					<td><?php echo formatadata($customer['modified'], "d/m/Y H:i:s"); ?></td>
					<td class="actions text-start">
						<a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
						<?php if (isset($_SESSION['user'])) : ?> <?php endif; ?>
						<a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
						
						<a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $customer['id']; ?>">
							<i class="fa fa-trash"></i> Excluir
						</a>
						</td>
					</tr>
			<?php endforeach; ?>
		<?php else : ?>
					<tr>
						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
		<?php endif; ?>
				</tbody>
			</table>
	<?php endif; ?>

<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>