
<?php
require_once('config-bd.php');
class modelNoticias extends ConfigBd
{
   private $conn = null;


   function __construct()
   {
      $this->conn = $this->initBd();
   }


   // Methods


   function recuperaNoticias(): mixed
   {
      $result_log = "SELECT id_noticia, status_noticia,titulo_noticia,nome_categoria from noticia n inner join categoria c on n.id_categoria = c.id_categoria order by titulo_noticia";
      $resultado_logs = mysqli_query($this->conn, $result_log);
      return $resultado_logs;
   }

   function recuperaNoticia($id_noticia): mixed
   {
      $sql = "SELECT * from noticia n where n.id_noticia=" . $id_noticia;
      $result = $this->conn->query($sql);
      $noticia = $result->fetch_assoc();
      return $noticia;
   }
   function recuperaImagensNoticia($id_noticia): mixed
   {
      $sql2 = "SELECT * from imagem_noticia n where n.id_noticia=" . $id_noticia;
      $result2 = $this->conn->query($sql2);
      $imagem = $result2->fetch_assoc();
      return $imagem;
   }

   function recuperaNoticiaPrincipal()
   {
      $sqlTopo = "SELECT id_noticia,titulo_noticia,nome_categoria from noticia n inner join categoria c on n.id_categoria = c.id_categoria where n.status_noticia = 1
                             ORDER BY id_noticia DESC LIMIT 0, 1;";
      $result3 = $this->conn->query($sqlTopo);
      $noticiaTopo = $result3->fetch_assoc();
      return $noticiaTopo;
   }
   function recuperaImagemPrincipal($id_noticia)
   {
      $sql = "SELECT * from imagem_noticia n where n.id_noticia=" . $id_noticia . " LIMIT 1";
      $result = $this->conn->query($sql);
      $imagem = $result->fetch_assoc();
      return $imagem;
   }
   function recuperarNoticiasRecentes()
   {
      $sql = "SELECT * FROM noticia WHERE datediff(date(now()),data_noticia) < 7  LIMIT 100 offset 0";
      $recentes = mysqli_query($this->conn, $sql);
      return $recentes;
   }
   function recuperarNoticiasAntigas()
   {
      $sql = "SELECT * FROM noticia WHERE datediff(date(now()),data_noticia) > 7  LIMIT 100 offset 0";
      $antigas = mysqli_query($this->conn, $sql);
      return $antigas;
   }
}
?>




