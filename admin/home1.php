<?php
session_start();
if (!isset($_SESSION["logado"])) {
  header("Location:../login.php");
  session_destroy();
}
include '../conecta.php';


mysqli_set_charset( $conn, 'utf8');
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
  $pagina_atual = "noticias.php";
//Selecionar todos os logs da tabela
$result_log = "SELECT * from noticia n order by n.titulo_noticia";
$resultado_log = mysqli_query($conn, $result_log);

//Contar o total de logs
$total_logs = mysqli_num_rows($resultado_log);

//Seta a quantidade de logs por pagina
$quantidade_pg = 5;

//calcular o número de pagina necessárias para apresentar os logs
$num_pagina = ceil($total_logs/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os logs a serem apresentado na página
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->

    <title>Olá, mundo!</title>
  </head>
  <body>
<div class="container">
  <header>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  <?php echo $_SESSION["nome_administrador"] ?>|

  <a href="../logout.php">Sair do sistema</a>

  </div>
</nav>
   
  </header>
<section class="container pt-5 pb-3 pb-lg-5" id="demos">
    <div class="table-responsive">

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


             while($row = mysqli_fetch_assoc($resultado_log)){ ?>


      <tr>

<th> <?php echo $row["titulo_noticia"] ?> </th>

  
  <th>     
           
       <a href="#update<?php echo $row["id_noticia"] ?>" data-toggle="modal"><button type='button' class='btn btn-primary btn-sm'>Editar</button></a>

<a href="delete.php?id=<?php echo $row["id_noticia"] ?> " onclick="return confirm('Deseja realmente excluir o registro ?')"><button type='button' class='btn btn-danger btn-sm'>Excluir</button></a>
 <a href="#new_img<?php echo $row["id_noticia"] ?>"  data-toggle="modal"><button type='button' class='btn btn-success btn-sm'>Novas imagens</button></a>
<a href="../noticia.php?id=<?php echo $row["id_noticia"] ?> " target="_blank"> <button type='button' class='btn btn-default btn-sm'>Visualizar notícia</button></a>


          </th>

          <th>
       <div class="container"> 
    <div class="row">
  
            <?php 

    $sql2 = "SELECT * from imagem_noticia n where n.id_noticia=". $row["id_noticia"]."" ;
$result2 = $conn->query($sql2);
while($imagem = $result2->fetch_assoc()){?>
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


  


  

  <form action="update.php" method="post" class="form-group"  enctype="multipart/form-data">
       
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
     <input type="hidden" class="form-control" id="exampleInputEmail1" name="cod" value="<?php echo $row["id_noticia"] ?>"readonly>
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




<form action="new_img.php" method="post" class="form-group"  enctype="multipart/form-data">
       
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
     <input type="hidden" class="form-control" id="exampleInputEmail1" name="cod" value="<?php echo $row["id_noticia"] ?>"readonly>
    </div>
  
 <div class="form-group">
    <label for="exampleInputEmail1"> Imagens</label>
    <input type="file" class="form-control" id="exampleInputEmail1"  name="arquivo[]" multiple="multiple">
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
 <form action="upload.php" method="POST" class="form-group"  enctype="multipart/form-data">
       
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
    <input type="text" class="form-control" id="exampleInputEmail1" name="link" >
    </div>

     <div class="form-group">
    <label for="exampleInputEmail1">Selecionar imagens</label>
    <input type="file" class="form-control" id="exampleInputEmail1"  name="arquivo[]" multiple="multiple">
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
</div>
  <a href="#cadastro" data-toggle="modal"><button type='button' class='btn btn-success'>Cadastrar notícia</button></a>

    </section>
</div>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>