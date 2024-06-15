<?php
	function criptografia($senha) {
		$custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';
	
		
		$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
	
		return $hash;
	}
	
	$senha = criptografia("admin");
	echo $senha;
?>