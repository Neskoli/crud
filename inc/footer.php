			<hr>
		</main> <!-- /container -->

		<footer class="container">
			<?php $hoje = new DateTime ("now", new DateTimeZone("America/Sao_Paulo")) ?>
			<p>&copy;2024 - <?php echo $hoje->format("Y");?> - Alice Pereira</p>
		</footer>
		<script src="<?php echo BASEURL; ?>js/jquery-3.7.0.min.js"></script>
		<script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
		<script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
		<script src="<?php echo BASEURL; ?>js/main.js"></script>
	</body>
</html>