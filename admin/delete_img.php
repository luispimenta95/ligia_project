<?php
  include '../conecta.php';

$msg = false;

  
        $id = $_GET["id"];


 $sql = "DELETE FROM imagem_noticia WHERE id_img_noticia=$id";

if ($conn->query($sql) === TRUE) {
 header("Location:home.php");
} else {
  echo "Error deleting record: " . $conn->error;
}



?>