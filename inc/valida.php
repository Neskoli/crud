<?php
	// Esse é o validade.php
	include ("../config.php");
	require_once(DBAPI);
	include(HEADER_TEMPLATE);
	
	if (!empty($_POST) AND (empty($_POST['login']) || empty($_POST['senha']))){
		header("Location:" . BASEURL . "index.php");
		exit;
	}
	
	try {
		$bd = open_database();
		$usuario = $_POST['login'];
		$senha = $_POST['senha'];

		if (!empty($usuario) && !empty($senha)) {
			$senha = criptografia($_POST['senha']);

			$sql = "SELECT id, nome, user, password FROM usuarios WHERE (user = '". $usuario ."') AND (password = '". $senha ."') LIMIT 1";
			$query = $bd->query($sql);
			if (true) {
				$dados = $query->fetch();
				//echo "<b>";
				//var_dump($dados);
				//echo "</b>";
				$id = $dados['id'];
				$nome = $dados['nome'];
				$user = $dados['user'];
				$password = $dados['password'];
				//var_dump($user);
				if (!empty($user)) {
					if (!isset($_SESSION)) session_start();
					$_SESSION['message'] = "Bem Vindo " . $nome . "!";
					$_SESSION['type'] = "info";
					$_SESSION['id'] = $id;
					$_SESSION['nome'] = $nome;
					$_SESSION['user'] = $user;
					//echo "<b>";
					//var_dump($user);
					//echo "</b>";
					
				} else {
					throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
				}
				//header("Location: " . BASEURL . "index.php");
			} else {
				throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
			}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
		$_SESSION['type'] = "danger";
	}
?>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class=" mt-4 alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>
<header>
    <a href="<?php echo BASEURL ?>index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
</header>

<?php include(FOOTER_TEMPLATE); ?>
