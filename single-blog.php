<?php
include 'config.php';
$id = $_GET['id'];
include 'model/model-noticia.php';
include 'model/model-parceiro.php';
$modelNoticia = new modelNoticias();
$modelParceiro = new modelParceiros();
$noticia_atual     = $modelNoticia->recuperaNoticia($id);
$noticia_anterior  = $modelNoticia->recuperaNoticia($id - 1);
$proxima_noticia   = $modelNoticia->recuperaNoticia($id + 1);
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>News HTML-5 Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header>
        <?php include 'header.php'; ?>

        <!-- Carousel -->
        <div id="demo" class="carousel slide" data-bs-ride="carousel">



            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <?php

                $resultado_logs = $modelParceiro->recuperarParceirosTopo();
                $total_logs = mysqli_num_rows($resultado_logs);
                for ($i = 0; $i < $total_logs; $i++) {
                    $parceiros = $resultado_logs->fetch_assoc();
                ?>
                    <div class="carousel-item active">
                        <?php
                        $imagem = $modelParceiro->recuperaImagemPrincipal($parceiros["id_parceiro"]);

                        ?>
                        <a href="single-page-parceiro.php?id=<?php echo $parceiros["id_parceiro"] ?>">
                            <img class=" img-fluid" src="admin/UP/<?php echo $imagem['imagem']; ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        </div>
        <!-- Header End -->
    </header>

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <?php

                            $sql2 = "SELECT * from imagem_noticia n where n.id_noticia=$id LIMIT 1";
                            $result2 = $conn->query($sql2);
                            $imagem = $result2->fetch_assoc();
                            ?>
                            <img class="img-fluid" src="admin/UP/<?php echo $imagem['imagem']; ?>" alt="">
                        </div>
                        <div class="blog_details">
                            <h2><?php echo $noticia_atual["titulo_noticia"] ?>
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="fa fa-user"></i><?php echo $GLOBALS['titulo']; ?></a></li>
                            </ul>
                            <p><?php echo nl2br($noticia_atual['texto_noticia']); ?></p>
                            <?php
                            $sql3 = "SELECT * from imagem_noticia n where n.id_noticia=$id LIMIT 100 offset 1";
                            $resultado_logs = mysqli_query($conn, $sql3);
                            $total_logs = mysqli_num_rows($resultado_logs);
                            if ($total_logs > 0) { ?>
                                <br><br>
                                <div class="footer-tittle">
                                    <h4 class="text-center">Veja mais imagens</h4>
                                </div>
                                <br><br>
                                <div class="row">
                                    <?php for ($i = 0; $i < $total_logs; $i++) {
                                        $imagens_meio = $resultado_logs->fetch_assoc();
                                    ?>
                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <img src="admin/UP/<?php echo $imagens_meio['imagem']; ?>" alt="Lights" style="width:100%">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php

                            } ?>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="navigation-area">
                            <div class="row">
                                <?php
                                if (!empty($noticia_anterior)) { ?>
                                    <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                        <div class="thumb">
                                            <a href="single-blog.php?id=<?php echo $noticia_anterior["id_noticia"] ?>">
                                                <img class="img-fluid" src="assets/img/post/preview.png" alt="">
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="single-blog.php?id=<?php echo $noticia_anterior["id_noticia"] ?>">
                                                <span class="lnr text-white ti-arrow-left"></span>
                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Notícia Anterior</p>
                                            <a href="single-blog.php?id=<?php echo $noticia_anterior["id_noticia"] ?>">

                                                <h4><?php echo $noticia_anterior["titulo_noticia"] ?></h4>
                                            </a>
                                        </div>
                                    </div>

                                <?php }
                                if (!empty($proxima_noticia)) { ?>
                                    <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                        <div class="detials">
                                            <p>Próxima notícia</p>
                                            <a href="single-blog.php?id=<?php echo $proxima_noticia["id_noticia"] ?>">
                                                <h4><?php echo $proxima_noticia["titulo_noticia"] ?></h4>

                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="#">
                                                <span class="lnr text-white ti-arrow-right"></span>
                                            </a>
                                        </div>
                                        <div class="thumb">
                                            <a href="single-blog.php?id=<?php echo $proxima_noticia["id_noticia"] ?>">
                                                <img class="img-fluid" src="assets/img/post/next.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'colunas_categoria.php'; ?>

            </div>
    </section>
    <!--================ Blog Area end =================-->
    <?php include 'footer.php'; ?>


    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Breaking New Pluging -->
    <script src="./assets/js/jquery.ticker.js"></script>
    <script src="./assets/js/site.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>