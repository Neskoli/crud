<?php INCLUDE "config.php"; ?>
<?php require_once DBAPI; ?>

<?php
	$db = open_database();
	try{
		$db = open_database();
		echo "<h1>Banco de \"Dados\" Conectado!</h1>";
	}catch(Exception $e){
		echo "<h1>ERRO: Não foi possível Conectar!</h1>";
		echo $e->getMessage();
	}
	/*
	if ($db) {
		echo "<h1>Banco de \"Dados\" Conectado!</h1>";
	} else {
		echo "<h1>ERRO: Não foi possível Conectar!</h1>";
	}
	*/
?>