<?php 
  require '../controller/api.php';
  $title = 'Регистрация';
  require '../controller/signup.php';
  require '../templates/header.php'; 
?>

<h2>Регистрация</h2>

<form action="../views/signup.php" method="post">
  <label for="fio">Ваше ФИО:</label>
  <input type="text" name="fio" placeholder="Введите ФИО">

  <label for="user_name">Ваш логин:</label>
  <input type="text" name="user_name" placeholder="Введите логин">
  
  <label for="user_password">Ваш пароль:</label>
  <input type="password" name="user_password" placeholder="Введите пароль">

  <input type="password" name="user_password2" placeholder="Повторите пароль">

  <label for="phone">Ваш телефон:</label>
  <input type="tel" name="phone" placeholder="Введите телефон">

  <button class="btn-btn small" name="do_signup" type="submit">Зарегистрировать</button>
</form>
<br>
<a href="../views/login.php">Авторизация</a>
<p>Вернуться на <a href="../views/index.php">главную</a>.</p>

<?php require '../templates/footer.php'; ?>