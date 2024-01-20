<?php
include '../conecta.php';

$msg = false;

$nome = $_POST["titulo"];

$sql_code = "INSERT INTO categoria (nome_categoria) VALUES ('$nome')"; // Salva o registro do cliente no banco de dados
if ($conn->query($sql_code) === TRUE) {


  header("Location:categorias.php");
} else {
  $msg = "erro no sql";
  header("Location:categorias.php");
}
