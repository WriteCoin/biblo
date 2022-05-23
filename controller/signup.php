<?php
  require "/controller/api.php";

  $data = $_POST;

  // регистрация
  if (isset($data['do_signup'])) {
    $errors = array();

    $user_name = $secure_data($data['user_name']);
    $phone = $secure_data($data['phone']);
    $fio = $secure_data($data['fio']);
    $user_password = $secure_data($data['user_password']);
    $user_password2 = $secure_data($data['user_password2']);

    if (trim($fio) == '') {
      $errors[] = "Введите ФИО!";
    }

    if (trim($phone) == '') {
      $errors[] = "Введите телефон";
    }

    if (trim($user_name) == '') {
      $errors[] = "Введите имя пользователя";
    }

    if ($user_password == '') {
      $errors[] = "Введите пароль";
    }

    if ($user_password2 != $user_password) {
      $errors[] = "Повторный пароль введен не верно!";
    }

    if (mb_strlen($user_name) < 5 || mb_strlen($user_name) > 90) {
      $errors[] = "Недопустимая длина логина";
    }

    if (mb_strlen($user_password) < 2 || mb_strlen($user_password) > 8) {
      $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";
    }

    // проверка на уникальность логина
    $login_query = pg_query_params($conn, 'SELECT * FROM person WHERE user_name = $1', Array($user_name));
    $user = pg_fetch_object($login_query);
    if ($user) {
      $errors[] = "Пользователь с таким логином существует!";
    }

    // проверка номера телефона
    if (!preg_match("/^[0-9]{10,11}+$/", $phone)) {
      $errors[] = "Телефон задан в неверном формате";
    }

    if (empty($errors)) {
      // Все проверено, регистрируем
      // добавляем в таблицу записи

      // хешируем пароль
      $user_password = password_hash($user_password, PASSWORD_DEFAULT);

      $new_user_query = pg_query_params($conn, 'INSERT INTO person(first_name, last_name, user_name, user_password, phone, email) VALUES ($1, $2, $3, $4, $5, $6);', Array($first_name, $last_name, $user_name, $user_password, $phone, $email));

      $user_query = pg_query_params($conn, 'SELECT * FROM person WHERE user_name = $1', Array($user_name));
      $new_user = pg_fetch_object($user_query);

      $new_client_query = pg_query_params($conn, 'INSERT INTO clients(person_id) VALUES ($1);', Array($new_user->id));
      $client_query = pg_query_params($conn, 'SELECT * FROM clients WHERE person_id = $1;', Array($new_user->id));
      $new_client = pg_fetch_object($client_query);

      echo '<div style="color: green; ">Вы успешно зарегистрированы! Можно <a href="/views/login.php">авторизоваться</a>.</div><hr>';
    } else {
      echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
  }
?>