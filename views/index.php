<?php
  require '../controller/api.php';
  $title = 'Главная страница';
  require '../templates/header.php';
  require '../controller/user.php';
?>

<br>
<?php require '../templates/user.php'; ?>

<br>
<?php require '../templates/book_filter.php'; ?>

<h2>Книги</h2>
<?php require '../controller/books.php'; require '../templates/books.php'; ?>

<?php require '../templates/footer.php'; ?>