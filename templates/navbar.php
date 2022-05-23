<nav class="blue darken-4">
  <div class="nav-wrapper">
    <a href="/views/index.php" class="brand-logo">Библиотека</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <?php
        render_navbar_element('/views/index.php', 'Библиотека');
        render_navbar_element('/views/issues.php', 'Выдачи');
        render_navbar_element('/views/new_book.php', 'Новая книга', 'Администратор');
        render_navbar_element('/views/change_books.php', 'Изменить книги', 'Администратор');
        render_navbar_element('/views/new_autor.php', 'Добавить автора', 'Администратор');
        render_navbar_element('/views/change_autors.php', 'Изменить авторов', 'Администратор');
        render_navbar_element('/views/new_genre.php', 'Добавить жанр', 'Администратор');
        render_navbar_element('/views/change_ganres.php', 'Изменить жанры', 'Администратор'); 
        render_navbar_element('/views/signup.php', 'Регистрация'); 
        render_navbar_element('/views/login.php', 'Войти'); 
        render_navbar_element('/controller/logout.php', 'Выйти'); 
      ?>
    </ul>
  </div>
</nav>