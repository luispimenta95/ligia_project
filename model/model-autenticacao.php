<?php
require_once('config-bd.php');
class modelAutenticacao extends ConfigBd
{
	private $conn = null;


	function __construct()
	{
		$this->conn = $this->initBd();
	}


	// Methods


	function validaLoginAdministrativo($login, $senha): mixed
	{
		$sql = "SELECT nome_administrador,id_administrador FROM administrador WHERE LPAD(cpf_administrador,11,'0') = '$login' and senha_administrador = '$senha'";
		$result = $this->conn->query($sql);
		$rowcount = mysqli_num_rows($result);

		if ($rowcount > 0) {
			$acesso = $result->fetch_assoc();
			return $acesso;
		} else {
			return false;
		}
	}
}
