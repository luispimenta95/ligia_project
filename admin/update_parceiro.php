<?php
include '../conecta.php';

$msg = false;

$titulo = $_POST["titulo"];
$texto = $_POST["parceiro"];
$categoria = $_POST["categoria"];
$id_parceiro = $_POST["id_parceiro"];

$sql_code = "UPDATE parceiro SET nome_parceiro = '$titulo'  , texto_parceiro = '$texto',id_tipo_parceiro = '$categoria' WHERE id_parceiro=$id_parceiro";


if ($conn->query($sql_code) === TRUE) {

  header("Location:parceiros.php");
} else {
  $msg = "erro no sql";
  header("Location:parceiros.php");
}
