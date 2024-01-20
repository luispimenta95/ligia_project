<?php include 'conecta.php'; ?>

<div class="col-lg-4">
    <div class="blog_right_sidebar">

        <aside class="single_sidebar_widget post_category_widget">
            <h4 class="widget_title">Categorias</h4>
            <ul class="list cat-list">

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
        </aside>
    </div>
</div>