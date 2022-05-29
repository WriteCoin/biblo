<?php require '../templates/navbar_element.php'; ?>

<nav class="blue darken-4">
  <div class="nav-wrapper">
    <a href="../views/index.php" class="brand-logo">Библиотека</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <?php
        // echo $current_url . '<br>';
        render_navbar_element('../views/index.php', 'Библиотека');
        render_navbar_element('../views/issuances.php', 'Выдачи', 'Читатель');
        render_navbar_element('../views/signup.php', 'Регистрация'); 
        render_navbar_element('../views/login.php', 'Войти', ''); 
        render_navbar_element('../controller/logout.php', 'Выйти', 'Читатель'); 
      ?>
    </ul>
  </div>
</nav>