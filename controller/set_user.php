<?php
  if (isset($_SESSION['logged_user'])) {
    $logged_user = $_SESSION['logged_user'];
    if (isset($_SESSION['user_role'])) {
      $logged_user_role = $_SESSION['user_role'];
      if ($logged_user_role == 'reader') {
        $user_role_name = 'Читатель';
        $reader_query = pg_query_params($conn, 'SELECT * FROM readers WHERE person_id = $1', Array($logged_user->id));
        $reader = pg_fetch_object($reader_query);
      } elseif ($logged_user_role == 'admin') {
        $user_role_name = 'Администратор';
        $admin_query = pg_query_params($conn, 'SELECT * FROM admins WHERE person_id = $1', Array($logged_user->id));
        $admin = pg_fetch_object($admin_query);
      }
    }
  }
  if (!isset($user_role_name)) {
    $user_role_name = '';
  }
?>