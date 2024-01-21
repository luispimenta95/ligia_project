<?php
$isLocal = true;
$conn = null;
if ($isLocal) {
   $conn = new MySQLi('localhost', 'root', '', 'portal');
} else {
   $conn = new MySQLi('localhost', 'id18925220_localhost', 'Mp13151319!', 'id18925220_portal');
}
if ($conn->connect_error) {
   echo "Desconectado! Erro: " . $conn->connect_error;
}
