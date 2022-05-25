<?php
  require '../controller/connect_info.php';

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

  $secure_data = fn($data) => strip_tags(htmlspecialchars($data));

  $get_post = fn($str_data, $default) => isset($_POST[$str_data]) ? $_POST[$str_data] : $default;

  $get_GET = fn($str_data, $default) => isset($_GET[$str_data]) ? $_GET[$str_data] : $default;
?>