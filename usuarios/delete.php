<?php
	//esse é o delete.php
	require_once('functions.php'); 

	if (isset($_GET['id'])){
		try{
			// consultando o usuário para obeter o nome do arquivo da foto
			$usuario = find("usuarios", $_GET['id']);
			// Chamando a função para apagar o usuário do banco de dados
			delete($_GET['id']);
			// Apagando o arquivo da foto do usuário pasta foto
			unlink("foto/" . $usuario['foto']);
		} catch (Exception $e){
			$_SESSION['message'] = "Não foi possivel realizar a operação:" . $e->GetMessage();
			$_SESSION['type'] = "danger";
		}
	} 
?>