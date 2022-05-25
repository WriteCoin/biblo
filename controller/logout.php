<?php
  require '../controller/api.php';

  unset($_SESSION['logged_user']);
  unset($_SESSION['reader']);

  header('Location: ../views/index.php');
?>