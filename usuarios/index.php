<?php
	//esse é o index.php
	require("functions.php");
	index();
?>

<?php include(HEADER_TEMPLATE); ?>

	<header style="margin-top:10px;">
		<div class="row">
			<div class="col-sm-6">
				<h2>Usuários</h2>
			</div>
			<div class="col-sm-6 text-right h2">
				<a class="btn btn-secondary" href="add.php"><i class="fa fa-plus"></i> Novo Usuários</a>
				<?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
				<a class="btn btn-danger" href="index.php?pdf=<?php echo $_POST['user']; ?>" download><i class="fa-solid fa-file-pdf"></i> Listagem</a>
				<?php else : ?>
				<a class="btn btn-danger" href="index.php?pdf="ok" download><i class="fa-solid fa-file-pdf"></i> Listagem</a>
				<?php endif; ?>
				<a class="btn btn-light" href="index.php"><i class="fa fa-sync-alt"></i> Atualizar</a>
			</div>
		</div>
	</header>
		<form name="filtro" action="index.php" method="post">
			<div class="row">
				<div class="form-group col-md-4">
					<div class="input-group mb-3">
						<input type="text" class="form-control" maxlength="80" name="users" required>
						<button type="submit" class="btn btn-secondary"><i class='fas fa-search'></i> Consultar</button>
					</div>
				</div>
			</div>
		</form>
		<?php if (!empty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
				<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
				<?php echo $_SESSION['message']; ?>
			</div>
		<?php clear_messages(); ?>
		<?php endif; ?>		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>usuário</th>
					<th>foto</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
	<?php if ($usuario) : ?>
		<?php foreach ($usuario as $usuario) : ?>
			<tr>
				<td align='center'><?php echo $usuario['id']; ?></td>
				<td><?php echo $usuario['nome']; ?></td>
				<td><?php echo $usuario['user']; ?></td>
				<td>
				<?php
					$foto=$usuario['foto']; 
					if(!empty($usuario['foto'])){
						echo "<img src=\"foto/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
					} else{
						echo "<img src=\"foto/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rouded\" width=\"100px\">";
					}
				
				?>
				</td>
				<td class="actions text-start">
					<a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
					<a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
					<a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal" data-usuario="<?php echo $usuario['id']; ?>">
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
<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>