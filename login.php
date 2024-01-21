<?php
include 'conecta.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrativo | SESTI GDF</title>
  <link rel="stylesheet" href="public/css/login.css">

</head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

  <div class="login-page bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-1">
          <h3 class="mb-3 text-center">Login Administrativo</h3>
          <div class="bg-white shadow rounded">
            <div class="row center">
              <div class="col-md-7 pe-0">
                <div class="form-left h-100 py-5 px-5">
                  <form class="row g-4" action="valida_adm.php" method="POST">
                    <div class="col-12">
                      <label>CPF<span class="text-danger">*</span></label>
                      <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                        <input type="text" name="cpf" class="form-control" placeholder="Informe o CPF">
                      </div>
                    </div>

                    <div class="col-12">
                      <label>Senha<span class="text-danger">*</span></label>
                      <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                        <input type="password" name="senha" class="form-control" placeholder="Informe a Senha">
                      </div>
                    </div>



                    <div class="col-12">
                      <button type="submit" class="btn btn-primary px-4 float-end mt-4">Realizar login</button>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->

</body>

</html>