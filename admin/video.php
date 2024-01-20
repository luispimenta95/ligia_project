<!doctype html>
<?php
include '../conecta.php';

?>
<html lang="en">
  <head>
    <title>Colorlib Arte nas ruas &mdash; Minimal Blog Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">

    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    
   <form action="upload_video.php" method="post">
  
  <div class="form-group">
   <label for="inputEmail3" class="col-form-label">Selecione a notícia</label>
    
 <select name="noticia" required>

   <option >Selecione</option>
        <?php 
        
        $sql2 = "SELECT * from noticia n ";
$result2 = $conn->query($sql2);

while($noticias = $result2->fetch_assoc()) { 

        ?>
    <option value="<?php echo $noticias["id_noticia"]; ?>"><?php echo $noticias["titulo_noticia"];?></option>
                            <?php
                        }
                    ?>
</select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Link do vídeo</label>
    <input type="text" name="link" class="form-group">
  </div>



  <button type="submit" class="btn btn-primary">Enviar</button>
</form>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/jquery-migrate-3.0.0.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>

    
    <script src="js/main.js"></script>
  </body>
</html>