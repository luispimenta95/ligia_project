<?php
  include '../conecta.php';

$msg = false;

   $nome = $_POST["nome"];
    $email = $_POST["email"];
$mensagem = $_POST["mensagem"];
$id = $_POST["id"];
           

$sql_code = "INSERT INTO comentario_noticia (nome,email,comentario,id_noticia,data_comentario) VALUES ('$nome','$email','$mensagem','$id',NOW())";// Salva o registro do cliente no banco de dados
        if ($conn->query($sql_code) === TRUE) {

  

          header("Location:../noticia.php?id=$id");

        }


?>