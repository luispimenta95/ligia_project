<?php

session_start();
unset($_SESSION['id_administrador'], $_SESSION['nome_administrador'], $_SESSION['logado'], $_SESSION['senha']);
header("Location: login.php");