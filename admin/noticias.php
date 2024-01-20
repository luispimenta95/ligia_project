﻿<?php
session_start();
if (!isset($_SESSION["logado"])) {
  header("Location:../index.php");
  session_destroy();
}
include '../conecta.php';

mysqli_set_charset($conn, 'utf8');
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$pagina_atual = "clientes.php";
//Selecionar todos os logs da tabela
$result_log = "SELECT id_noticia,titulo_noticia,nome_categoria from noticia n inner join categoria c on n.id_categoria = c.id_categoria order by titulo_noticia";
$resultado_logs = mysqli_query($conn, $result_log);

//Contar o total de logs
$total_logs = mysqli_num_rows($resultado_logs);

//Seta a quantidade de logs por pagina
$quantidade_pg = 5;

//calcular o número de pagina necessárias para apresentar os logs
$num_pagina = ceil($total_logs / $quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg * $pagina) - $quantidade_pg;

//Selecionar os logs a serem apresentado na página
?>
<!doctype html>
<html lang="pt-BR">

<html class="fixed">

<?php
include 'header_adm.php';
include '../config.php';

?>


<body>
  <section class="body">

    <!-- start: header -->
    <header class="header">
      <div class="logo-container">
        <a href="../" class="logo">
          <img src="../public/assets/images/logo2.jpg" height="35" alt="Legrano Orgânicos">
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
          <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
      </div>

      <div class="header-right">

        <?php include 'topo.php'; ?>

      </div>
      </div>

    </header>
    <!-- end: header -->

    <div class="inner-wrapper">
      <?php include 'menu_lateral.php'; ?>

      <!-- end: sidebar -->

      <section role="main" class="content-body">
        <header class="page-header">

        </header>

        <div class="row">
          <div class="col-md-12">
            <?php
            if ($total_logs == 0) {
              $result_logs = "SELECT id_noticia,titulo_noticia,nome_categoria from noticia n inner join categoria c on n.id_categoria = c.id_categoria  limit $incio, $quantidade_pg ";

              $resultado_logs = mysqli_query($conn, $result_logs);
              $total_logs = mysqli_num_rows($resultado_logs);

              $msg_pesquisa = "<div class='alert alert-warning'>Nenhum cliente encontrado no sistema ! </div>";
            }
            ?>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>

                    <th>Codigo </th>
                    <th>Titulo</th>
                    <th>Categoria</th>
                    <th>Editar</th>

                  </tr>
                </thead>
                <tbody>
                  <?php


                  while ($row = mysqli_fetch_assoc($resultado_logs)) { ?>


                    <tr>

                      <th> <?php echo $row["id_noticia"] ?> </th>
                      <th> <?php echo $row["titulo_noticia"] ?> </th>
                      <th> <?php echo $row["nome_categoria"] ?> </th>

                      <th>

                        <a href="#edicao<?php echo $row["id_noticia"] ?>" data-toggle="modal"><button type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>


                      </th>
                      <!-- =============================CADASTRO==================================== -->
                      <form action="cadastro_noticia.php" method="POST" class="form-group" enctype="multipart/form-data">

                        <div id="cadastro" class="modal fade" role="dialog" class="form-group">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <?php
                                if (isset($_SESSION['msg'])) {
                                  echo $_SESSION['msg'];
                                  unset($_SESSION['msg']);
                                }
                                ?>
                                <h4 class="modal-title">Cadastro de noticias</h4>
                              </div>
                              <div class="modal-body">

                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Titulo da noticia</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" name="titulo" required>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Texto da noticia</label>
                                  <div class="col-sm-10">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="noticia" required></textarea>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Categoria</label>
                                  <div class="col-sm-10">
                                    <select name="categoria" required>
                                      <option>Selecione</option>
                                      <?php
                                      $sql2 = "SELECT * from categoria c order by c.nome_categoria ";
                                      $result2 = $conn->query($sql2);

                                      while ($categoria = $result2->fetch_assoc()) {

                                      ?>
                                        <option value="<?php echo $categoria["id_categoria"]; ?>"><?php echo $categoria["nome_categoria"]; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Imagens</label>
                                  <div class="col-sm-10">
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="arquivo[]" multiple="multiple">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class=" btn btn-primary">Realizar cadastro</button>

                                <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
                              </div>
                            </div>

                          </div>
                        </div>

                      </form>
                      <!-- ============================= FIM CADASTRO==================================== -->


                      <!-- =============================Edicao==================================== -->
                      <form action="update.php?id=<?php echo $row["id_noticia"]; ?>" method="POST" class="form-group">

                        <div id="edicao<?php echo $row["id_noticia"] ?>" class="modal fade" role="dialog" class="form-group">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <?php
                                if (isset($_SESSION['msg'])) {
                                  echo $_SESSION['msg'];
                                  unset($_SESSION['msg']);
                                }


                                $sql2 = "SELECT * from noticia n where n.id_noticia=" . $row["id_noticia"];
                                $result2 = $conn->query($sql2);
                                $noticia = $result2->fetch_assoc();

                                ?>
                                <h4 class="modal-title">Atualização da noticia <?php echo $noticia['titulo_noticia']; ?></h4>
                              </div>
                              <div class="modal-body">

                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Titulo da noticia</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" name="titulo" value="<?php echo $noticia['titulo_noticia']; ?>" required>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Texto da noticia</label>
                                  <div class="col-sm-10">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="noticia" <?php echo $noticia['texto_noticia']; ?> required></textarea>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Categoria</label>
                                  <div class="col-sm-10">
                                    <select name="categoria" required>
                                      <option>Selecione</option>
                                      <?php
                                      $sql2 = "SELECT * from categoria c order by c.nome_categoria ";
                                      $result2 = $conn->query($sql2);

                                      while ($categoria = $result2->fetch_assoc()) {

                                      ?>
                                        <option value="<?php echo $categoria["id_categoria"]; ?>"><?php echo $categoria["nome_categoria"]; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Imagens</label>
                                  <div class="col-sm-10">
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="arquivo[]" multiple="multiple">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class=" btn btn-primary">Realizar cadastro</button>

                                <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
                              </div>
                            </div>

                          </div>
                        </div>

                      </form>
                      <!-- ============================= FIM Edição==================================== -->


                    <?php } ?>
                    </tr>

                </tbody>
              </table>
              <?php
              if (isset($msg_pesquisa)) {
                echo $msg_pesquisa;
                unset($msg_pesquisa);
              }
              ?>
              <?php
              $result_log = "SELECT * from noticia";

              $resultado_log = mysqli_query($conn, $result_log);

              //Contar o total de logs
              $total_logs = mysqli_num_rows($resultado_log);
              $limitador = 1;
              if ($total_logs > $quantidade_pg) { ?>
                <nav class="text-center">
                  <ul class="pagination">

                    <li><a href="noticias.php?pagina=1"> Primeira página </a></li>


                    <?php
                    for ($i = $pagina - $limitador; $i <= $pagina - 1; $i++) {
                      if ($i >= 1) {
                    ?>
                        <li><a href="noticias.php?pagina=<?php echo $i; ?>"> <?php echo $i; ?></a></li>


                    <?php }
                    }
                    ?>
                    <li class="active"> <span><?php echo $pagina; ?></span></li>

                    <?php
                    for ($i = $pagina + 1; $i <= $pagina + $limitador; $i++) {
                      if ($i <= $num_pagina) { ?>
                        <li><a href="noticias.php?pagina=<?php echo $i; ?>"> <?php echo $i; ?></a></li>

                    <?php }
                    }



                    ?>
                    <li><a href="noticias.php?pagina=<?php echo $num_pagina; ?>"> <span aria-hidden="true"> Ultima página </span></a></li>



                  <?php } ?>
                  </ul>
                </nav>
                <a href="#cadastro" data-toggle="modal"><button type='button' class='btn btn-success'>Cadastrar sócio</button></a>




            </div>



          </div>


          <!-- start: page -->




        </div>

    </div>


  </section>
  </div>
  </div>
  <!-- end: page -->
  </section>
  </div>


  </section>

  <!-- Vendor -->
  <script src="../public/assets/vendor/jquery/jquery.js"></script>
  <script src="../public/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
  <script src="../public/assets/vendor/bootstrap/js/bootstrap.js"></script>
  <script src="../public/assets/vendor/nanoscroller/nanoscroller.js"></script>
  <script src="../public/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="../public/assets/vendor/magnific-popup/magnific-popup.js"></script>
  <script src="../public/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

  <!-- Specific Page Vendor -->
  <script src="../public/assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
  <script src="../public/assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
  <script src="../public/assets/vendor/jquery-appear/jquery.appear.js"></script>
  <script src="../public/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
  <script src="../public/assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
  <script src="../public/assets/vendor/flot/jquery.flot.js"></script>
  <script src="../public/assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
  <script src="../public/assets/vendor/flot/jquery.flot.pie.js"></script>
  <script src="../public/assets/vendor/flot/jquery.flot.categories.js"></script>
  <script src="../public/assets/vendor/flot/jquery.flot.resize.js"></script>
  <script src="../public/assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
  <script src="../public/assets/vendor/raphael/raphael.js"></script>
  <script src="../public/assets/vendor/morris/morris.js"></script>
  <script src="../public/assets/vendor/gauge/gauge.js"></script>
  <script src="../public/assets/vendor/snap-svg/snap.svg.js"></script>
  <script src="../public/assets/vendor/liquid-meter/liquid.meter.js"></script>
  <script src="../public/assets/vendor/jqvmap/jquery.vmap.js"></script>
  <script src="../public/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
  <script src="../public/assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
  <script src="../public/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
  <script src="../public/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
  <script src="../public/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
  <script src="../public/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
  <script src="../public/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
  <script src="../public/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>

  <!-- Theme Base, Components and Settings -->
  <script src="../public/assets/javascripts/theme.js"></script>

  <!-- Theme Custom -->
  <script src="../public/assets/javascripts/theme.custom.js"></script>

  <!-- Theme Initialization Files -->
  <script src="../public/assets/javascripts/theme.init.js"></script>


  <!-- Examples -->
  <script src="../public/assets/javascripts/dashboard/examples.dashboard.js"></script>
</body>

</html>