<?php
	function open_database() {
		try {
			$conn = new PDO("mysql:host=". DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
	
	function close_database($conn) {
		$conn = null;
	}

	function find($table = null, $id = null) {
		$database = open_database();
		$found = null;
		try {
			if ($id) {
				$sql = "SELECT * FROM $table WHERE id = ?";
				$stmt = $database->prepare($sql);
				$stmt->execute([$id]);
				$found = $stmt->fetch(PDO::FETCH_ASSOC);/*corrigir codigo com o d prof */
			} else {
				$sql = "SELECT * FROM $table";
				$stmt = $database->query($sql);
				$found = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
		} catch (PDOException $e) {
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['type'] = 'danger';
		}
		close_database($database);
		return $found;
	}

	function find_all($table) {
		return find($table);
	}

	/**
	 *  Atualiza um registro em uma tabela, por ID
	 */
	function update($table = null, $id = 0, $data = null) {
		try {
			$database = open_database();
	
			$items = '';
			foreach ($data as $key => $value) {
				$items .= trim($key, "'") . '=?,';
			}
			
			$items = rtrim($items, ',');
	
			$sql = "UPDATE $table SET $items WHERE id=?";
			$stmt = $database->prepare($sql);
	
			$values = array_values($data);
			$values[] = $id;
	
			$stmt->execute($values);
	
			$_SESSION['message'] = "Registro atualizado com sucesso.";
			$_SESSION['type'] = "success";
		} catch (PDOException $e) {
			$_SESSION['message'] = "Não foi possível realizar a operação.";
			$_SESSION['type'] = "danger";
		}
	}
	
	function remove($table = null, $id = null) {
		try {
			$database = open_database();
	
			if ($id) {
				$sql = "DELETE FROM $table WHERE id = ?";
				$stmt = $database->prepare($sql);
				$stmt->bindParam(1,  $id, PDO::PARAM_INT);
				$stmt->execute();
	
				$_SESSION['message'] = "Registro Removido com Sucesso.";
				$_SESSION['type'] = "success";
			}
		} catch (PDOException $e) {
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['type'] = 'danger';
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
			$stmt = $database->prepare($sql);
			$stmt->execute();

			$_SESSION['message'] = "Registro cadastrado com sucesso.";
			$_SESSION['type'] = "success";
	  
		} catch (Exception $e) { 
	  
			$_SESSION['message'] = "Nao foi possivel realizar a operacao.";
			$_SESSION['type'] = "danger";
		} 

		close_database($database);
	}
	
	function criptografia($senha) {
		$custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';
		
		$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
	
		return $hash;
	}
		
	function clear_messages() {
		$_SESSION['message'] = null;
		$_SESSION['type'] = null;
	}

	/**
	 * Pesquisa registros pelo parametro $p que foi passado
	 */
	function filter( $table = null, $p = null ) {
		
		$database = open_database();
		$found = null;
		
		try {
			if ($p) {
				$sql = "SELECT * FROM " . $table . "WHERE " . $p;
				$result = $database->query($sql);
				if ($result->num_rows > 0) {
					$found = array();
					while ($row = $result->fetch_assoc()) {
						array_push($forund, $row);
					}
				} else {
					throw new Exception("Não foram encontrados registros de dados!");
				}
			}
		} catch (Exception $e) {
			$_SESSION['message'] = "Ocorreu um erro:" . $e->GetMessage();
			$_SESSION['type'] = "danger";
		}
		
		close_database($database);
		return $found;
	}
?>