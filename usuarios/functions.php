<?php
	//esse é o functos.php
	require_once('../config.php');
	require_once(DBAPI);

	$usuario = null;
	$usuarios = null;

	/**
	 *  Listagem de Usuários
	 */
	function index() {
		global $usuarios;
		if (!empty($_POST['user'])) {
			$usuario = filter("usuarios", "nome like '%" . $_POST['user'] . "%'");
		} else {
			$usuario = find_all('usuarios');
		}
	}
		
	/**
	 *  Criptografia
	 */
	function criptografia($senha) {
		/*
			==> Criptografia Blowfish
			http://www.linhadecodigo.com.br/artigo/3532/criptografando-senhas-usando-bcrypt-blowfish-no-php.aspx
		*/
		// Aplicando criptografia na senha
		$cursto = "08";
		$salt = "CflfllePArKlBJomM0F6aJ";
		
		// Gera um hash basesado em bcrypt
		$hash = crypt ($senha, "$2a$" . $crusto . "$" . $salt . "$");
		
		return $hash; // retorna a senha criptografia
	}
	/**
	 *  Upload de imagens
	 */
	function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
		/*
		==> Upload de arquivos no PHP
		https://www.w3schools.com/php/php_file_upload.asp
		*/
		// Upload da foto
		try {
			$nomearquivo = basename($arquivo_destino); //nome do arquivo
			$uploadOk = 1;
			// Verificando se o arquivo é uma imagem
			if(isset($_POST["sumbmit"])) {
				$check = getimagesize ($nome_temp);
				if($check == false) {
					$_SESSION['message'] = "File is an image -" . $check["mime"] . ".";
					$_SESSION['type'] = "info";
					//echo "File is an image -" .$check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
					throw new Exceptio("O arquivo não é uma imagem!");
					//echo "O arquivo não é uma imagem";
				}
			}
			
			//Verificando se o arquivo já existe na pasta
			if (file_exists($arquivo_destino)) {
				$uploadOk = 0;
				throw new Exceptio("Desculpe, o arquivo já existe!");
				//echo "Desculpe, o arquivo já existe.";
			}
			
			//Verificamdo se o tamanho de arquivo
			if ($tamanho_arquivo > 5000000) {
				$uploadOk = 0;
				throw new Exceptio("Desculpe, mas o é muito grande!");
				//echo "Desculpe, mas o arquivo é muitogrande!");
			}
			
			// Allow certain file formas
			if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif") {
				$uploadOk = 0;
				throw new Exceptio("Desculpe, mas só são permitidos arquivos de imagem JPEG, JPEG, PNG e GIF!");
				//echo"Desculpe, mas só são permitidos arquivo imagem JPG, JPEG, PNG e GIF!";			
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				throw new Exceptio("Desculpe, mas o arquivo não pode ser enviado.");
				//echo "Desculpe, mas o arquivo não pode ser enviado.";
			} else {
				// Se tudo estiver OK, tentamos fazer o upload do arquivo
				if (move_uploaded_file($_FILES["foto"] ["tmp_name"], $arquivo_destino)) {
					//colocando o nome do arquivo da foto do usuario no vetor
					$_SESSION['message'] = "O arquivo" . htmlspecialchars($nomearquivo) . " foi armazenado.";
					$_SESSION['type'] = "success";
					//echo "O arquivo" . htmlspecialchars($nomearquivo) . " foi armazenado.";
				} else {
					throw new Exceptio("Desculpe, mas o arquivo não pode ser enviado.");
					//echo "Desculpe, mas o arquivo não pode ser enviado.";
				}
			}
		} catch (Exceptio $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
			$_SESSION['type'] = "danger";
		}
	  
	}
	
	/**
	 *	Cadastro de Usuários
	 */
	function add() {

		if (!empty($_POST['ussuario'])) {
			try {
				$usuario = $_POST['usuario'];
				
				if (!empty($_FILES["foto"] ["name"])) {
					// Upload da foto
					$pasta_destino = "fotos/"; //pasta onde ficam as fotos
					$arquivo_destino = $pasta_destino . basename($_FILES["foto"] ["name"]); //Caminho completo até o arquivo que será arquivodo
					$nomearquivo = basename($_FILES["foto"] ["name"]); //nome do arquivo
					$resolucao_arquivo  = getimagesize($_FILES["foto"] ["tmp_name"]);
					$tamanho_arquivo = $_FILES["foto"] ["size"]; //tamanho do arquivo em bytes
					$nome_temp = $_FILES["foto"] ["tmp_name"];// nome e caminho do arquivo no servidor
					$tipo_arquivo = strtolower(pathinfo($arquivo_destino,PATHNFO_EXTENSION));// extensão do arquivo
					
					// Chamada do da fanção upload para gravar a imagem
					upload ($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
					
					$usuario['foto'] = $nomearquivo;
				}
				//criptografando a senha
				if (!empty($usuario['password'])) {
					$senha = criptografia($usuario['password']);
					$usuario['password'] = $senha;
				}
				
				$usuario['foto'] = $nomearquivo;
				
				save('usuarios', $usuario);
				header('Location: index.php');
			} catch (Exceptio $e) {
				$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
				$_SESSION['type'] = "danger";
			}
		}
	}
	
	/**
	 *  Atulizacao/Edicao de Usuários
	 */
	function edti() {
		
		//$now = new DateTime ("now");
		try {
			if (isset($_GET['id'])) {
				
				$id = $_GET['id'];
				
				if (isset($_POST['usuario'])) {
					
					$usuario = $_POST['usuario'];
					
					//criptografando a senha
					if (!empty($usuario['password'])) {
						$senha = criptografia($usuario['password']);
						$usuario['password'] = $senha;
					}
					
					if (!empty($_FILES["foto"] ["name"])) {
						// Upload da foto
						$pasta_destino = "fotos/"; //pasta onde ficam as fotos
						$arquivo_destino = $pasta_destino . basename($_FILES["foto"] ["name"]); //Caminho completo até o arquivo que será arquivodo
						$nomearquivo = basename($_FILES["foto"] ["name"]); //nome do arquivo
						$resolucao_arquivo  = getimagesize($_FILES["foto"] ["tmp_name"]);
						$tamanho_arquivo = $_FILES["foto"] ["size"]; //tamanho do arquivo em bytes
						$nome_temp = $_FILES["foto"] ["tmp_name"];// nome e caminho do arquivo no servidor
						$tipo_arquivo = strtolower(pathinfo($arquivo_destino,PATHNFO_EXTENSION));// extensão do arquivo
						
						upload ($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
						
						$usuario['foto'] = $nomearquivo;
					}
					
					update('usuarios', $usuario);
					header('Location: index.php');
				} else {
					global $usuario;
					$usuario = find("usuario", $id);
				}
			} else {
				header('Location: index.php');
			}
		} catch (Exceptio $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
			$_SESSION['type'] = "danger";
		}
	}
	
	/**
	*  Visualização de um Usuários
	*/
	function view($id = null) {
		global $usuario;
		$usuario = find("usuario", $id);
		
	}

	/**
	*  Exclusão de um Usuários
	*/
	function delete($id = null) {
		global $usuario;
		$usuario = remove("usuario", $id);
		
		header("Location: index.php");
	}

	/**
	* Gerando PDF
	*/
	function pdf ($p = null){
		//Instanciation of inherited class
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		$usuarios = null;
		if($p){
			$usuarioos = filter("usuarios", "nome like'%" . $p . "%'");
		} else{
			$usuarios = find_all("usuarios");
		}
		foreach ($usuarios as $usuario){
			$pdf->Cell(0,10, $usuario['id'] . "_" . $usuario['nome'] . "_" . $usuario['user'],0,1);
		}
		//
		/*
		for ($i=1;$i<=40;$i++)
			$pdf->Cell(0,10, 'Printig line nuber '.$i,0,1);
		*/
		$pdf->Output();
	} 
?>