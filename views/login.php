<?php
  require '/controller/api.php';
  $title = 'Авторизация';
  require '/templates/header.php';
?>

<h2>Авторизация</h2>

<form action="/views/login.php" method="post">
  <label for="user_name">Ваш логин:</label>
  <input type="text" name="user_name" placeholder="Введите логин">

  <label for="user_password">Ваш пароль:</label>
  <input type="password" name="user_password" placeholder="Введите пароль">

  <p>
    <input type="radio" value="client" checked name="user_role">  Войти как читатель
  </p>
  <p>
    <input type="radio" value="moderator" name="user_role"> Войти как администратор
  </p>

  <button class="btn-btn small" name="do_login" type="submit">Авторизоваться</button>
</form>
<br>
<br>
<a href="/views/signup.php">Регистрация</a>
<p>Вернуться на <a href="/views/index.php">главную</a>.</p>

<?php require '/templates/footer.php'; ?>