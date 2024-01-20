<?php
  include '../conecta.php';

$msg = false;

   $nome_promo = $_POST["titulo"];
    $publico = $_POST["noticia"];
        $link = $_POST["link"];

        $id = $_POST["cod"];



	 $sql_code = "UPDATE noticia n SET n.titulo_noticia='$nome_promo', n.texto_noticia='$publico', n.video='$link' WHERE n.id_noticia=$id";


    

   if ($conn->query($sql_code) === TRUE) {

                   header("Location:home.php");



        }








           

 



?>