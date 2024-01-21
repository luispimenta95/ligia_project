<?php
include '../conecta.php';

$msg = false;

$titulo = $_POST["nome"];
$id_categoria = $_POST["id_categoria"];

$sql_code = "UPDATE categoria SET nome_categoria = '$titulo'  WHERE id_categoria=$id_categoria";


if ($conn->query($sql_code) === TRUE) {

  header("Location:categorias.php");
} else {
  $msg = "erro no sql";
  header("Location:categorias.php");
}
