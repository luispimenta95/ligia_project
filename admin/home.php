<?php
session_start();
if (!isset($_SESSION["logado"])) {
  header("Location:../login.php");
  session_destroy();
}
include '../conecta.php';


mysqli_set_charset($conn, 'utf8');
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$pagina_atual = "noticias.php";
//Selecionar todos os logs da tabela
$result_log = "SELECT * from noticia n order by n.titulo_noticia";
$resultado_log = mysqli_query($conn, $result_log);

//Contar o total de logs
$total_logs = mysqli_num_rows($resultado_log);

//Seta a quantidade de logs por pagina
$quantidade_pg = 5;

//calcular o número de pagina necessárias para apresentar os logs
$num_pagina = ceil($total_logs / $quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg * $pagina) - $quantidade_pg;

//Selecionar os logs a serem apresentado na página
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container">
    <table class="table table-bordered table-dark">
      <thead>
        <tr>

          <th> Titulo </th>
          <th> Ações </th>

          <th> Imagens </th>
        </tr>
        </tr>
      </thead>
      <tbody>
        <?php


        while ($row = mysqli_fetch_assoc($resultado_log)) { ?>


          <tr>

            <th> <?php echo $row["titulo_noticia"] ?> </th>


            <th>

              <a href="#update<?php echo $row["id_noticia"] ?>" data-toggle="modal"><button type='button' class='btn btn-primary btn-sm'>Editar</button></a>

              <a href="delete.php?id=<?php echo $row["id_noticia"] ?> " onclick="return confirm('Deseja realmente excluir o registro ?')"><button type='button' class='btn btn-danger btn-sm'>Excluir</button></a>
              <a href="#new_img<?php echo $row["id_noticia"] ?>" data-toggle="modal"><button type='button' class='btn btn-success btn-sm'>Novas imagens</button></a>
              <a href="../noticia.php?id=<?php echo $row["id_noticia"] ?> " target="_blank"> <button type='button' class='btn btn-default btn-sm'>Visualizar notícia</button></a>


            </th>

            <th>
              <div class="container">
                <div class="row">

                  <?php

                  $sql2 = "SELECT * from imagem_noticia n where n.id_noticia=" . $row["id_noticia"] . "";
                  $result2 = $conn->query($sql2);
                  while ($imagem = $result2->fetch_assoc()) { ?>
                    <div class="col-md-3">

                      <img src="UP/<?php echo $imagem['imagem']; ?>" class="img-fluid">
                      <a href="delete_img.php?id=<?php echo $imagem["id_img_noticia"] ?> " onclick="return confirm('Deseja realmente excluir o registro ?')"><button type='button' class='btn btn-danger btn-sm'>Excluir</button></a>

                    </div>

                </div>

              </div>

  </div>

<?php }

?>
</th>



<!-- ================================== lista de dependentes ========================== -->







<form action="update.php" method="post" class="form-group" enctype="multipart/form-data">

  <div id="update<?php echo $row["id_noticia"] ?>" class="modal fade" role="dialog" class="form-group">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar <?php echo $row["titulo_noticia"] ?></h4>
        </div>
        <div class="modal-body">



          <div class="col-md-12">



            <div class="form-group">
              <label for="exampleInputEmail1">Titulo</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="titulo" value="<?php echo $row["titulo_noticia"] ?>">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Texto da noticia</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="noticia"><?php echo $row["texto_noticia"] ?></textarea>

            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Link do video</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="link" value="<?php echo $row["video"] ?>">
            </div>

            <div class="form-group">
              <input type="hidden" class="form-control" id="exampleInputEmail1" name="cod" value="<?php echo $row["id_noticia"] ?>" readonly>
            </div>



          </div>


        </div>
        <div class="modal-footer">

          <button type="submit" class=" btn btn-primary">Alterar dados</button>


          <button type="submit" class=" btn btn-danger" data-dismiss="modal">Voltar</button>
        </div>
      </div>

    </div>
  </div>

</form>




<form action="new_img.php" method="post" class="form-group" enctype="multipart/form-data">

  <div id="new_img<?php echo $row["id_noticia"] ?>" class="modal fade" role="dialog" class="form-group">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inserir imagens <?php echo $row["titulo_noticia"] ?></h4>
        </div>
        <div class="modal-body">



          <div class="col-md-12">



            <div class="form-group">
              <label for="exampleInputEmail1">Titulo</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="titulo" value="<?php echo $row["titulo_noticia"] ?>" readonly>
            </div>




            <div class="form-group">
              <input type="hidden" class="form-control" id="exampleInputEmail1" name="cod" value="<?php echo $row["id_noticia"] ?>" readonly>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1"> Imagens</label>
              <input type="file" class="form-control" id="exampleInputEmail1" name="arquivo[]" multiple="multiple">
            </div>

          </div>


        </div>
        <div class="modal-footer">

          <button type="submit" class=" btn btn-primary">Inserir imagens</button>


          <button type="submit" class=" btn btn-danger" data-dismiss="modal">Voltar</button>
        </div>
      </div>

    </div>
  </div>

</form>

<!-- Começo cadastro -->
<form action="upload.php" method="POST" class="form-group" enctype="multipart/form-data">

  <div id="cadastro" class="modal fade" role="dialog" class="form-group">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cadastro de noticias</h4>
        </div>
        <div class="modal-body">



          <div class="form-group">
            <label for="exampleInputEmail1">Titulo</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="titulo">
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Texto da noticia</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="noticia"></textarea>

          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Link do video</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="link">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Selecionar imagens</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="arquivo[]" multiple="multiple">
          </div>



          <div class="modal-footer">
            <button type="submit" class=" btn btn-primary">Realizar cadastro</button>

            <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </div>

      </div>
    </div>

</form>



<!-- Fim Cadastro -->



<!-- ================================== lista de movimentações recentes ========================== -->





<!-- ================================== Deposito ========================== -->




<!-- ================================== CADASTRO DE SÓCIOS ========================== -->



<!-- ================================== Saque ========================== -->






<?php } ?>
</tr>

</tbody>
</table>

<div>
  <h3>Modal Example</h3>
  <p>Click on the button to open the modal.</p>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Open modal
  </button>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


      <form action="upload.php" method="POST" class="form-group" enctype="multipart/form-data">

<div class="form-group">
  <label for="exampleInputEmail1">Titulo</label>
  <input type="text" class="form-control" id="exampleInputEmail1" name="titulo">
</div>


<div class="form-group">
  <label for="exampleInputEmail1">Texto da noticia</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="noticia"></textarea>

</div>


<div class="form-group">
  <label for="exampleInputEmail1">Link do video</label>
  <input type="text" class="form-control" id="exampleInputEmail1" name="link">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">Selecionar imagens</label>
  <input type="file" class="form-control" id="exampleInputEmail1" name="arquivo[]" multiple="multiple">
</div>



<div class="modal-footer">
  <button type="submit" class=" btn btn-primary">Realizar cadastro</button>

  <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
</div>
      </form>
</div>

  

    </div>
  </div>
</div>
</div>

</body>

</html>