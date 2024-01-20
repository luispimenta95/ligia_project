<?php
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
$result_log = "SELECT * from noticia";
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

<?php include 'header_adm.php'; ?>


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

        <div id="userbox" class="userbox">
          <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
              <img src="../public/assets/images/user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="../public/assets/images/!logged-user.jpg">
            </figure>
            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com"><span class="name">
                <?php echo $_SESSION["nome_administrador"] ?></span>
              <span class="role">Legrano | Administrativo</span>
            </div>
            <i class="fa custom-caret"></i>
          </a>
          <div class="dropdown-menu">
            <ul class="list-unstyled">
              <li class="divider"></li>
              <li>
                <a role="menuitem" tabindex="-1" href="logout_adm.php"><i class="fa fa-power-off"></i> Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      </div>

    </header>
    <!-- end: header -->

    <div class="inner-wrapper">
      <!-- start: sidebar -->


      <aside id="sidebar-left" class="sidebar-left">

        <div class="sidebar-header ">


        </div>

        <div class="nano">
          <!-- Menu Lateral -->

          <ul class="list-group">
            <a href="home.php">
              <li class="list-group-item">Home</li>
            </a>
            <a href="clientes.php">
              <li class="<?php if ($pagina_atual = "clientes.php") {
                            echo "list-group-item active";
                          } else {
                            echo "list-group-item";
                          } ?>">Sócios </li>
            </a>

            <a href="promocoes.php">
              <li class="list-group-item">Categorias</li>
            </a>

          </ul>
          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Filtar clientes por nome

                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <form method="POST" action="clientes.php" class="search nav-form">
                    <div class="input-group input-search">
                      <input type="text" class="form-control" name="termo" id="q" placeholder="Pesquisa por nome...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>


          </div>

        </div>
      </aside>
      <!-- end: sidebar -->

      <section role="main" class="content-body">
        <header class="page-header">

        </header>

        <div class="row">
          <div class="col-md-12">
            <?php
            if ($total_logs == 0) {
              $result_logs = "SELECT * from noticia n  limit $incio, $quantidade_pg ";

              $resultado_logs = mysqli_query($conn, $result_logs);
              $total_logs = mysqli_num_rows($resultado_logs);

              $msg_pesquisa = "<div class='alert alert-warning'>Nenhum cliente encontrado no sistema ! </div>";
            }
            ?>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>

                    <th>Cliente </th>
                    <th>Dependentes</th>


                  </tr>
                </thead>
                <tbody>
                  <?php


                  while ($row = mysqli_fetch_assoc($resultado_logs)) { ?>


                    <tr>

                      <th> <?php echo $row["id_noticia"] ?> </th>
                      <th> <?php echo $row["titulo_noticia"] ?> </th>

                      <!-- ================================== lista de dependentes ========================== -->



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

                    <li><a href="clientes.php?pagina=1"> Primeira página </a></li>


                    <?php
                    for ($i = $pagina - $limitador; $i <= $pagina - 1; $i++) {
                      if ($i >= 1) {
                    ?>
                        <li><a href="clientes.php?pagina=<?php echo $i; ?>"> <?php echo $i; ?></a></li>


                    <?php }
                    }
                    ?>
                    <li class="active"> <span><?php echo $pagina; ?></span></li>

                    <?php
                    for ($i = $pagina + 1; $i <= $pagina + $limitador; $i++) {
                      if ($i <= $num_pagina) { ?>
                        <li><a href="clientes.php?pagina=<?php echo $i; ?>"> <?php echo $i; ?></a></li>

                    <?php }
                    }



                    ?>
                    <li><a href="clientes.php?pagina=<?php echo $num_pagina; ?>"> <span aria-hidden="true"> Ultima página </span></a></li>



                  <?php } ?>
                  </ul>
                </nav>
                <a href="#cadastro" data-toggle="modal"><button type='button' class='btn btn-success'>Cadastrar sócio</button></a>


                <a href="relatorio_clientes.php"><button type="button" class="btn btn-dark">Gerar relatório </button>


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