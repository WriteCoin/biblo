<?php
  $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

  if (!$conn) {
    die('Could not connect');
  }

  session_start();

  require 'set_user.php';

  // определение текущей страницы
  function get_current_url() {
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];
    return $url;
  }
  $current_url = get_current_url();

  function for_role($role) {
    global $user_role_name;
    if ($user_role_name != $role) {
      die("Страница только для роли " . $user_role_name);
    }
  }
?>