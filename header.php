<?php include 'conecta.php';

date_default_timezone_set('America/Recife');
$datetime = new DateTime("now", new DateTimeZone("America/Recife"));



?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/ticker-style.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-top black-bg d-none d-md-block">
                <div class="container">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>
                                    <li><img src="assets/img/icon/header_icon1.png" alt="">34ºc, Sunny </li>
                                    <li><img src="assets/img/icon/header_icon1.png" alt=""><?php echo $datetime->format('d/m/Y H:i'); ?></li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                <ul class="header-social">
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li> <a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-mid d-none d-md-block">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <div class="header-banner f-right ">
                                <img src="assets/img/hero/header_card.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                            <!-- sticky -->
                            <div class="sticky-logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-md-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="#">Categorias</a>
                                            <ul class="submenu">
                                                <?php

                                                $sql2 = "SELECT * from categoria c order by c.nome_categoria ";
                                                $result2 = $conn->query($sql2);
                                                while ($categorias = $result2->fetch_assoc()) {
                                                ?>
                                                    <li>
                                                        <a href="lista_categorias.php?id=<?php echo $categorias["id_categoria"] ?>" class="d-flex">
                                                            <p><?php echo strtoupper($categorias["nome_categoria"]) ?></p>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>

                                            </ul>
                                        </li>
                                        <li><a href="#">Noticias</a>
                                            <ul class="submenu">
                                                <?php

                                                $sql2 = "SELECT * from noticia n order by n.titulo_noticia ";
                                                $result2 = $conn->query($sql2);

                                                while ($noticias = $result2->fetch_assoc()) {

                                                ?>
                                                    <li><a href="single-blog.php?id=<?php echo $noticias["id_noticia"] ?>"><?php echo $noticias["titulo_noticia"] ?></a></li>



                                                <?php
                                                }
                                                ?>

                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-md-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>