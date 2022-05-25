<?php
  require '../controller/api.php';
  $title = 'Главная страница';
  require '../templates/header.php';

  require '../controller/user.php';
  require '../templates/user.php';
?>

<?php require '../templates/footer.php'; ?>