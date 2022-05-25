<?php
  require "/controller/api.php";

  $data = $_POST;
  if (isset($data['do_login'])) {
    $errors = array();

    $user_name = $secure_data($data['user_name']);
    $user_password = $secure_data($data['user_password']);
    $user_role = $secure_data($data['user_role']);

    $user_query = pg_query_params($conn, 'SELECT * FROM person WHERE user_name = $1', Array($user_name));
    $user = pg_fetch_object($user_query);

    if (!$user) {
      $errors[] = "Пользователь с таким логином не найден!";
    } else {
      $client_query = pg_query_params($conn, 'SELECT * FROM reader WHERE person_id = $1;', Array($user->id));
      $client = pg_fetch_object($client_query);

      if (!$client) {
        $errors[] = "Клиент не найден";
      }

      $admin_query = pg_query_params($conn, 'SELECT * FROM admins WHERE person_id = $1', Array($user->id));
      $admin = pg_fetch_object($admin_query);

      if (!$admin && $user_role == 'admin') {
        $errors[] = "Вы не зарегистрированы в системе как администратор";
      }

      if (empty($errors) && password_verify($user_password, $user->user_password)) {
        // Все верно, пускаем пользователя
        $_SESSION['logged_user'] = $user;
        $_SESSION['user_role'] = $user_role;

        // Редирект на главную страницу
        header('Location: /views/index.php');
      } else {
        $errors[] = "Пароль неверно введен!";
      }
    }
    if (!empty($errors)) {
      echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
    }
  }
?>