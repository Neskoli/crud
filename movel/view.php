<?php
	//esse é o view.php
	include('functions.php'); 
	view($_GET['id']);
	include(HEADER_TEMPLATE); 
?>

		<h2>Cliente <?php echo $customer['id']; ?></h2>
		<hr>

			<dl class="dl-horizontal">
				<dt>Nome / Razão Social:</dt>
				<dd><?php echo $customer['name']; ?></dd>

				<dt>CPF / CNPJ:</dt>
				<dd><?php echo $customer['cpf_cnpj'] ?></dd>

				<dt>Data de Nascimento:</dt>
				<dd><?php echo formatadata($customer['birthdate'],"d/m/Y"); ?></dd>

				<dt>Data de Cadastro:</dt>
				<dd><?php echo  formatadata($customer['created'],"d/m/Y H:i:s"); ?></dd>
				
				<dt>Data de Alteração:</dt>
				<dd><?php echo  formatadata($customer['modified'],"d/m/Y H:i:s"); ?></dd>
			</dl>

			<div id="actions" class="row">
				<div class="col-md-12">
				<?php if (isset($_SESSION['user'])) : ?>
				  <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
				  <?php endif; ?>
				  <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-circle-arrow-left"></i> Voltar</a>
				</div>
			</div>

		
<?php include(FOOTER_TEMPLATE); ?>