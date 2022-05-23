<?php function render_navbar_element($url, $title, $role = 1) { global $user_role_name; ?>
  <?php if ($user_role_name == $role || $role == 1) : ?>
    <li 
      <?php if ($current_url == $url) : ?>
      class="active"
      <?php endif ?>
    ><a href="<?= $url ?>"><?= $title ?></a></li>
  <?php endif ?>
<?php } ?>