<?php
	
	require_once('../config.php');
	require_once(DBAPI);

	$customers = null;
	$customer = null;

	/**
	 *  Listagem de Clientes
	 */
	function index() {
		global $customers;
		$customers = find_all('customers');
	}
		
		/**
	 *  Visualização de um Cliente
	 */
	function view($id = null) {
	  global $customer;
	  $customer = find('customers', $id);
	}
	/**
	 *  Cadastro de Clientes
	 */
	function add() {

	  if (!empty($_POST['customer'])) {
		
			$today = 
			  date_create('now', new DateTimeZone('America/Sao_Paulo'));

			$customer = $_POST['customer'];
			$customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
			
			save('customers', $customer);
			header('location: index.php');
		}
	}
	/**
	*  Insere um registro no BD
	*/
	function save($table = null, $data = null) {

	  $database = open_database();

	  $columns = null;
	  $values = null;

	  //print_r($data);

	  foreach ($data as $key => $value) {
		$columns .= trim($key, "'") . ",";
		$values .= "'$value',";
	  }

	  // remove a ultima virgula
	  $columns = rtrim($columns, ',');
	  $values = rtrim($values, ',');
	  
	  $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";

	  try {
		$database->query($sql);

		$_SESSION['message'] = "Registro cadastrado com sucesso.";
		$_SESSION['type'] = "success";
	  
	  } catch (Exception $e) { 
	  
		$_SESSION['message'] = "Nao foi possivel realizar a operacao.";
		$_SESSION['type'] = "danger";
	  } 

	  close_database($database);
	}
	/**
	 *	Atualizacao/Edicao de Cliente
	 */
	function edit() {

	  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

	  if (isset($_GET['id'])) {

		$id = $_GET['id'];

		if (isset($_POST['customer'])) {

		  $customer = $_POST['customer'];
		  $customer['modified'] = $now->format("Y-m-d H:i:s");

		  update('customers', $id, $customer);
		  header('location: index.php');
		} else {

		  global $customer;
		  $customer = find('customers', $id);
		} 
	  } else {
		header('location: index.php');
	  }
	}
	/**
	 *  Exclusão de um Cliente
	 */
	function delete($id = null) {

	  global $customer;
	  $customer = remove('customers', $id);

	  header('location: index.php');
	}
	/**
	 *  Formata as datas
	 */
	 function formatadata($data, $formato) {
		 $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
		 return $dt->format($formato);
	 }
	
	/**
	*  Formata as cep
	*/
	function formatacep($cep) {
		$cf = substr($cep, 0, 5) . "-" . substr($cep, 5, 3);
		return $cf;
	}
	 
	/**
	*  Formata as tel
	*/
	function formatatel($tel) {
		$tl = substr($tel, 0, 5) . "-" . substr($tel, 5, 5);
		return $tl;
	}
	 
	/**
	*  Formata as cel
	*/
	function formatacel($cel) {
		$cl = substr($cel, 0, 0) . "(" . substr($cel, 0, 2) . ")" . " " . substr($cel, 2, 5) . "-" . substr($cel, 7, 12);
		return $cl;
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