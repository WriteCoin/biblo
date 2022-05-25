<?php
  if (isset($_SESSION['logged_user'])) {
    $logged_user = $_SESSION['logged_user'];
    $reader = $_SESSION['reader'];

    $user_role_name = 'Читатель';
  }
  if (!isset($user_role_name)) {
    $user_role_name = '';
  }
?>