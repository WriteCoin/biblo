<?php if (isset($query)) : ?>
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
                  <td><?= $data->fio ?></td>
                  <td><?= $data->user_name ?></td>
                  <td><?= $data->phone ?></td>
                </tr>
              <?php endwhile ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endif ?>