
<?php
require_once('config-bd.php');

class modelParceiros extends ConfigBd
{
   private $conn = null;

   function __construct()
   {
      $this->conn = $this->initBd();
   }

   function recuperarParceirosTopo()
   {
      $sql = "SELECT * FROM parceiro p WHERE p.id_tipo_parceiro = 2 LIMIT 100 offset 0";
      $resultado = mysqli_query($this->conn, $sql);
      return $resultado;
   }

   function recuperarParceirosLateral()
   {
      $sql = "SELECT * FROM parceiro p WHERE p.id_tipo_parceiro = 1 LIMIT 100 offset 0";
      $resultado = mysqli_query($this->conn, $sql);
      return $resultado;
   }

   function recuperaImagemPrincipal($parceiro)
   {
      $sql = "SELECT * from imagem_parceiro n where n.id_parceiro=" . $parceiro . " LIMIT 1";
      $result = $this->conn->query($sql);
      $imagem = $result->fetch_assoc();
      return $imagem;
   }
}
?>




