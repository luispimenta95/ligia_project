<?php
$conn = new MySQLi('localhost', 'root', '', 'portal');
if($conn->connect_error){
   echo "Desconectado! Erro: " . $conn->connect_error;
}


?>