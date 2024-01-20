<?php
  include '../conecta.php';

$msg = false;

  
        $id = $_GET["id"];


 $sql = "DELETE FROM noticia WHERE id_noticia=$id";

if ($conn->query($sql) === TRUE) {
 header("Location:home.php");
} else {
  echo "Error deleting record: " . $conn->error;
}

?>