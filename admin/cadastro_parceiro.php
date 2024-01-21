<?php
include '../conecta.php';

$msg = false;

$titulo = $_POST["titulo"];
$texto = $_POST["parceiro"];
$categoria = $_POST["categoria"];



$sql_code = "INSERT INTO parceiro (nome_parceiro, texto_parceiro,id_tipo_parceiro) VALUES ('$titulo','$texto', '$categoria')"; // Salva o registro do cliente no banco de dados
if ($conn->query($sql_code) === TRUE) {

  $last_id = $conn->insert_id;

  $diretorio = "UP/";

  if (!is_dir($diretorio)) {
    echo "Pasta $diretorio nao existe";
  } else {
    $arquivo = $_FILES['arquivo'];
    for ($controle = 0; $controle < count($arquivo['name']); $controle++) {


      $extensao = strtolower(substr($arquivo['name'][$controle], -4)); //pega a extensao do arquivo
      $novo_nome = "projeto_" . md5(time() + $controle) . $extensao;
      $destino = $diretorio . "/" . $novo_nome[$controle];
      $_UP['pasta'] = 'UP/';


      if (move_uploaded_file($_FILES['arquivo']['tmp_name'][$controle], $_UP['pasta'] . $novo_nome)) {
        $sql_code = "INSERT INTO imagem_parceiro (imagem,id_parceiro) VALUES('$novo_nome','$last_id' )";
      }

      if ($conn->query($sql_code) === TRUE) {
        header("Location:home.php");
      } else {
        echo "Erro ao realizar upload";
      }
    }
  }
} else {
  $msg = "erro no sql";
  header("Location:home.php");
}
