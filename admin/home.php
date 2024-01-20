﻿<?php
  session_start();
  if (!isset($_SESSION["logado"])) {
    header("Location:../index.php");
    session_destroy();
  }
  include '../conecta.php';
  $pagina_atual = "home.php";
  ?>

<!doctype html>
<html class="fixed">

<?php include 'header_adm.php'; ?>


<body>
  <section class="body">

    <!-- start: header -->
    <header class="header">


      <!-- start: search & user box -->
      <div class="header-right">

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
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                  <span class="name"><?php echo $_SESSION["nome_administrador"] ?></span>
                  <span class="role">Legrano | Administrativo</span>

                </div>
                <i class="fa custom-caret"></i>
              </a>
              <div class="dropdown-menu">
                <ul class="list-unstyled">
                  <li class="divider"></li>
                  <li>
                    <a role="menuitem" tabindex="-1" href="../logout_adm.php"><i class="fa fa-power-off"></i> Logout</a>
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

        <div class="sidebar-header">

        </div>

        <div class="nano">
          <!-- Menu Lateral -->

          <ul class="list-group">
            <a href="home.php">
              <li class="<?php if ($pagina_atual = "home.php") {
                            echo "list-group-item active";
                          } else {
                            echo "list-group-item";
                          } ?>">Home</li>
            </a>
            <a href="clientes.php">
              <li class="list-group-item">Sócios </li>
            </a>
            <a href="dependentes.php">
              <li class="list-group-item">Dependentes </li>
            </a>
            <a href="movimentacoes.php">
              <li class="list-group-item">Registros financeiros </li>
            </a>
            <a href="log.php">
              <li class="list-group-item">Registros de cadastro</li>
            </a>
            <a href="promocoes.php">
              <li class="list-group-item">Promoções</li>
            </a>

            <a href="mensagens.php">
              <li class="list-group-item">Mensagens </li>
            </a>



          </ul>
        </div>

      </aside>
      <!-- end: sidebar -->

      <section role="main" class="content-body">
        <header class="page-header">

        </header>

        <div class="row">
          <div class="col-md-12">



          </div>


          <!-- start: page -->


          <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-secondary">
              <div class="panel-body">
                <div class="widget-summary">
                  <div class="widget-summary-col widget-summary-col-icon">
                    <div class="summary-icon bg-secondary">
                      <i class="fa fa-usd"></i>
                    </div>
                  </div>
                  <div class="widget-summary-col">
                    <div class="summary">
                      <h4 class="title">Crédito disponível</h4>
                      <div class="info">
                        <?php
                        $data01 = date('y-m-d');

                        $sql = "SELECT SUM(saldo_cliente) AS soma FROM cliente WHERE ativo = '1' ";

                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        $total = number_format($row["soma"], 2, '.', '');

                        ?>
                        <strong class="amount">R$ <?php echo $total ?> </strong>
                      </div>
                    </div>
                    <div class="summary-footer">
                      <a class="text-muted text-uppercase" href="movimentacoes.php">Exibir finanças</a>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>


          <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-secondary">
              <div class="panel-body">
                <div class="widget-summary">
                  <div class="widget-summary-col widget-summary-col-icon">
                    <div class="summary-icon bg-secondary">
                      <i class="fa fa-cogs"></i>
                    </div>
                  </div>
                  <div class="widget-summary-col">
                    <div class="summary">
                      <h4 class="title">Registros do sistema</h4>
                      <div class="info">
                        <?php
                        $data01 = date('y-m-d');

                        $sql = "SELECT * from log_informacoes l WHERE l.id_movimentacao<6";

                        $result = $conn->query($sql);
                        $rowcount = mysqli_num_rows($result);
                        ?>
                        <strong class="amount"><?php echo $rowcount ?> </strong>
                      </div>
                    </div>
                    <div class="summary-footer">
                      <a class="text-muted text-uppercase" href="log.php">Exibir operações</a>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>


          <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-secondary">
              <div class="panel-body">
                <div class="widget-summary">
                  <div class="widget-summary-col widget-summary-col-icon">
                    <div class="summary-icon bg-secondary">
                      <i class="fa fa-user"></i>
                    </div>
                  </div>
                  <div class="widget-summary-col">
                    <div class="summary">
                      <h4 class="title">Total de clientes </h4>
                      <div class="info">
                        <?php
                        $sql = "select * from cliente";
                        $result = $conn->query($sql);
                        $rowcount = mysqli_num_rows($result);
                        ?>
                        <strong class="amount"><?php echo $rowcount ?></strong>
                      </div>
                    </div>
                    <div class="summary-footer">
                      <a class="text-muted text-uppercase" href="clientes.php">Exibir clientes </a>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>



          <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-secondary">
              <div class="panel-body">
                <div class="widget-summary">
                  <div class="widget-summary-col widget-summary-col-icon">
                    <div class="summary-icon bg-secondary">
                      <i class="fa fa-user"></i>
                    </div>
                  </div>
                  <div class="widget-summary-col">
                    <div class="summary">
                      <h4 class="title">Total de compradores autorizados </h4>
                      <div class="info">
                        <?php
                        $sql = "select * from comprador";
                        $result = $conn->query($sql);
                        $rowcount = mysqli_num_rows($result);
                        ?>
                        <strong class="amount"><?php echo $rowcount ?></strong>
                      </div>
                    </div>
                    <div class="summary-footer">
                      <a class="text-muted text-uppercase" href="dependentes.php">Exibir compradores autorizados </a>
                    </div>
                  </div>
                </div>
              </div>
            </section>
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