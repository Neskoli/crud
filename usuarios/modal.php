<!-- Modal de Delete-->
	
<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
				<h1 class="modal-title fs-5" id="modalLabel">Excluir Item</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Deseja realmente excluir este cliente?
			</div>
			<div class="modal-footer">
				<?php if (isset($_SESSION['user'])) : ?>
				<a id="confirm" class="btn btn-secondary" href="#"><i class="fa-solid fa-circle-check"></i> Sim</a>
				<button type="button" class="btn btn-light" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Close</button>
					
				<?php else : ?>
				<div class="alert alert-danger" role="alert">
					Você precisa estar logado como admin para acessar este recurso! <i class="fa-regular fa-face-sad-tear fa-xl"></i>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal de Delete-->