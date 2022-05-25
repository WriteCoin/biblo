<?php
  $data = $_POST;
  if (isset($data['do_login'])) {
    $errors = array();

    $user_name = $secure_data($data['user_name']);
    $user_password = $secure_data($data['user_password']);

    $user_query = pg_query_params($conn, 'SELECT * FROM person WHERE user_name = $1', Array($user_name));
    $user = pg_fetch_object($user_query);

    if (!$user) {
      $errors[] = "Пользователь с таким логином не найден!";
    } else {
      $reader_query = pg_query_params($conn, 'SELECT * FROM reader WHERE id_person = $1;', Array($user->id_person));
      $reader = pg_fetch_assoc($reader_query);
      
      if (!isset($reader['id_person'])) {
        $errors[] = "Читатель не найден";
      }

      if (empty($errors) && password_verify($user_password, $user->password)) {
        // Все верно, пускаем пользователя
        $_SESSION['logged_user'] = $user;
        $_SESSION['reader'] = $reader;

        // Редирект на главную страницу
        header('Location: ../views/index.php');
      } else {
        $errors[] = "Пароль неверно введен!";
      }
    }
    if (!empty($errors)) {
      echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
    }
  }
?>