<?php 
  include('functions.php'); 
  add();
  include(HEADER_TEMPLATE);
?>

			<h2>Novo Cliente</h2>

			<form action="add.php" method="post" enctype="multipart/form-data">
					<!-- area de campos do form -->
					<hr>
					<div class="row">
						<div class="form-group col-md-7">
						  <label for="name">Nome:</label>
						  <input type="text" class="form-control" name="usuario['nome']">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
						  <label for="campo2">Login:</label>
						  <input type="text" class="form-control" name="usuario['user']">
						</div>
					</div>
					<div class="row mb-2">
						<div class="form-group col-md-3">
						  <label for="campo3">Senha:</label>
						  <input type="password" class="form-control" name="usuario['password']">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
						  <label for="foto">Foto:</label>
						  <input type="file" class="form-control" name="foto" id="foto" onchange="loadFile(event)">
						</div>
						<div class="form-group col-md-4">
						  <label for="campo1">Foto:</label>
							<?php
								if(!empty($usuario['foto'])){
									echo "<img src=\"foto/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"200px\" id=\"imgPreview\">";
								} else{
									echo "<img src=\"foto/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rouded\" width=\"200px\" id=\"imgPreview\">";
								}
								
							?>
						</div>
						
					</div>
				  
				  <div id="actions" class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
							<a href="index.php" class="btn btn-default"><i class="fa-solid fa-circle-arrow-left"></i> Cancelar</a>
						</div>
				  </div>
			</form>

<?php include(FOOTER_TEMPLATE); ?>

<script>
	$(document).ready(() => {
		$("#foto").change(function () {
			const file = this.files[0];
			if (file) {
				let reader = new FileReader();
				reader.onload = function (event) {
					$("#imgPreview").attr("src", event.target.result);
				};
				reader.readAsDataURL(file);
			}
		});
	});
</script>
