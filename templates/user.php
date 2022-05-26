<!-- <?php if (isset($query)) : ?>
  <div class="row">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Информация о пользователе</span>
          <table>
            <thead>
              <tr>
                <td>ФИО</td>
                <td>Логин</td>
                <td>Номер телефона</td>
              </tr>
            </thead>
            <tbody>
              <?php while ($data = pg_fetch_object($query)) : ?>
                <tr>
                  <td><?= $data->fio_person ?></td>
                  <td><?= $data->user_name ?></td>
                  <td><?= $data->telephone ?></td>
                </tr>
              <?php endwhile ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endif ?> -->

<?php if (isset($logged_user) && isset($reader)) : ?>
  <div class="row">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title">Информация о пользователе</span>
        <table>
          <thead>
            <tr>
              <td><b>ФИО</b></td>
              <td><b>Логин</b></td>
              <td><b>Номер телефона</b></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= $logged_user->fio_person ?></td>
              <td><?= $logged_user->user_name ?></td>
              <td><?= $logged_user->telephone ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php endif ?>