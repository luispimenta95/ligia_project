<?php
include '../conecta.php';

$msg = false;

$titulo = $_POST["titulo"];
$texto = $_POST["noticia"];
$categoria = $_POST["categoria"];
$id_noticia = $_POST["id_noticia"];

$sql_code = "UPDATE noticia SET titulo_noticia = '$titulo'  , texto_noticia = '$texto',id_categoria = '$categoria' WHERE id_noticia=$id_noticia";


if ($conn->query($sql_code) === TRUE) {

  header("Location:noticias.php");
} else {
  $msg = "erro no sql";
  header("Location:noticias.php");
}
