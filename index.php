<?php
include 'model/model-noticia.php';
$model = new modelNoticias();
include 'config.php';

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>News HTML-5 Template </title>
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
    <style>
        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        /* display 3 */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left {
            transform: translateX(0);
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>


    <main>
        <!-- Trending Area Start -->
        <div class="trending-area fix">
            <div class="container">
                <div class="trending-main">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Trending Top -->

                            <?php

                            $noticiaTopo = $model->recuperaNoticiaPrincipal();
                            $imagem = $model->recuperaImagemPrincipal($noticiaTopo['id_noticia']);
                            ?>
                            <div class="trending-top mb-30">
                                <div class="trend-top-img">
                                    <img src="admin/UP/<?php echo $imagem['imagem']; ?>" alt="">
                                    <div class="trend-top-cap">
                                        <span><?php echo $noticiaTopo["nome_categoria"] ?></span>
                                        <h2><a href="single-blog.php?id=<?php echo $noticiaTopo["id_noticia"] ?>"><?php echo $noticiaTopo['titulo_noticia']; ?></a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include 'colunas_categoria.php'; ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- Trending Area End -->
        <!--   Weekly-News start -->
        <div class="weekly-news-area pt-50">
            <div class="container">
                <div class="weekly-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>Recentes</h3>
                            </div>

                        </div>
                    </div>

                    <div class="container text-center my-3">
                        <div class="row mx-auto my-auto">
                            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner w-100" role="listbox">
                                    <div class="carousel-item active">

                                        <?php
                                        $resultado_logs = $model->recuperarNoticiasRecentes();
                                        $total_logs = mysqli_num_rows($resultado_logs);
                                        for ($i = 0; $i < $total_logs; $i++) {
                                            $noticias = $resultado_logs->fetch_assoc();
                                        ?>
                                            <div class="col-md-4">
                                                <div class="card card-body">
                                                    <?php
                                                    $imagem = $model->recuperaImagemPrincipal($noticias['id_noticia']);

                                                    ?>
                                                    <a href="single-blog.php?id=<?php echo $noticias["id_noticia"] ?>">
                                                        <img class=" img-fluid" src="admin/UP/<?php echo $imagem['imagem']; ?>">
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Weekly-News -->

        <!--  Recent Articles start -->
        <div class="recent-articles">
            <div class="container">
                <div class="recent-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>Outras notícias</h3>
                            </div>
                        </div>
                    </div>
                    <div class="container text-center my-3">
                        <div class="row mx-auto my-auto">
                            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner w-100" role="listbox">
                                    <div class="carousel-item active">

                                        <?php

                                        $resultado_logs = $model->recuperarNoticiasAntigas();
                                        $total_logs = mysqli_num_rows($resultado_logs);
                                        for ($i = 0; $i < $total_logs; $i++) {
                                            $noticias = $resultado_logs->fetch_assoc();
                                        ?>
                                            <div class="col-md-4">
                                                <div class="card card-body">
                                                    <?php


                                                    $imagem = $model->recuperaImagemPrincipal($noticias['id_noticia']);

                                                    ?>
                                                    <a href="single-blog.php?id=<?php echo $noticias["id_noticia"] ?>">
                                                        <img class=" img-fluid" src="admin/UP/<?php echo $imagem['imagem']; ?>">
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <!--Recent Articles End -->
    </main>

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
    <script>
        $('#recipeCarousel').carousel({
            interval: 10000
        })

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 3;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>

    < /body>

        < /html>