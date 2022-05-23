<?php
  require '/controller/api.php';

  unset($_SESSION['logged_user']);

  header('Location: /views/index.php');
?>