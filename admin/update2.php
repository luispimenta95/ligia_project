<?php
include '../conecta.php';

  $id = $_POST["cod"];

 $buscar = "SELECT * FROM imagem_noticia WHERE id_noticia = $id";
$result = $conn->query($buscar);



//Contar o total de logs
$total_logs = mysqli_num_rows($result);




for ($i= 0; $i<$total_logs; $i++){

  $fotos = $result->fetch_assoc();
$fotografia= $fotos["imagem"];
    echo $fotografia . "<br>";


}   

?>