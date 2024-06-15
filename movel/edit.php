<?php 
	//esse é o edit.php
	include('functions.php'); 
	edit(); //mudei aqui
	include(HEADER_TEMPLATE);
?>

			<h2 class="md-2">Atualizar Cliente</h2>

		<form action="edit.php?id=<?php echo $movel['id']; ?>" method="post">
			<!-- area de campos do form -->
			<hr>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="name">Nome / Razão Social</label>
						<input type="text" class="form-control" name="movel[name]" value="<?php echo $movel['name']; ?>">
					</div>
					
					<div class="form-group col-md-3">
						<label for="campo2">Quantidade</label>
						<input type="text" class="form-control" name="movel[quantidade]" value="<?php echo $movel['quantidade']; ?>">
					</div>
				
					<div class="form-group col-md-3">
						<label for="campo3">Data de Nasimento</label>
						<input type="date" class="form-control" name="movel['birthdate']" value="<?php echo formatadata($movel['birthdate'],"Y-m-d"); ?>">
					</div>
				</div>
				
					<div class="form-group col-md-2">
						<label for="campo3">Date de Cadastro</label>
						<input type="text" class="form-control" name="movel['created']" disabled value="<?php echo $movel['created']; ?>">
					</div>
				</div>
					
			<div id="actions" class="row mt-2">
				<div class="col-md-12">
					<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
					<a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-circle-arrow-left"></i> Cancelar</a>
				</div>
			</div>
		</form>

<?php include(FOOTER_TEMPLATE); ?>