<?php $data = pg_fetch_assoc($query_keys); ?>
<table>
  <thead>
    <tr>
      <?php if ($data) : ?>
      <?php foreach ($data as $key => $value) { ?>
        <?php
          $key_view = $key;
          if ($key == 'Дата_выдачи') {
            $key_view = 'Дата выдачи';
          }
          if ($key == 'Дата_возврата') {
            $key_view = 'Дата возврата';
          }
        ?>
        <?php if ($key != 'id_issuance') : ?>
          <th><?= $key_view ?></th>
        <?php endif ?>
      <?php } ?>
      <?php endif ?>
    </tr>
  </thead>
  <tbody>
    <?php if (!pg_num_rows($query)) : ?>
      <p><i>Нет выдач</i></p>
    <?php endif ?>
    <?php while ($data = pg_fetch_assoc($query)) : ?>
      <!-- <tr class="tr_book" onmouseover='this.firstChild.lastChild.firstChild.removeAttribute("hidden")' onmouseout='this.firstChild.lastChild.firstChild.setAttribute("hidden", "hidden")'> -->
      <!-- <tr class="tr_book" onmouseover='console.log(this.firstChild.nextElementSibling.tagName.toLowerCase()); console.log(document.getElementsByTagName(".tr_book > " + this.firstChild.nextElementSibling.tagName.toLowerCase() + " > td"))'> -->
      <tr class="tr_book">
        <form method="post">
          <?php foreach ($data as $key => $value) { ?>
            <?php
              if ($key == 'Не возвращена?') {
                if ($value == 'f') {
                  $value = 'Нет';
                } else {
                  $value = 'Да';
                }
              }
              
            ?>

            <?php if ($key == 'id_issuance') : ?>
              <input type="hidden" name="id_issuance" value="<?= $value ?>">
            <?php else : ?>
              <?php if ($key == 'Дата_выдачи' || $key == 'Дата_возврата') : ?>
                <td>
                  <input type="date" name="<?= $key ?>" value="<?= $value ?>" 
                    <?php if ($key == 'Дата_выдачи') : ?>
                      min="<?= $min_date_issuance_str ?>" max="<?= $max_date_issuance_str ?>"
                    <?php else : ?>
                      min="<?= $value ?>" max="<?= $max_date_delivery_str ?>"
                    <?php endif ?>
                  >
                </td>
              <?php else : ?>
                <td><?= $value ?></td>
              <?php endif ?>
            <?php endif ?>

          <?php } ?>
          <td>
            <button type="submit">Отправить</button>
          </td>
          <!-- <button hidden type="submit" onmouseover='this.removeAttribute("hidden")' onmouseout='this.setAttribute("hidden", "hidden")'>Выбрать</button> -->
        </form>
      </tr>
    <?php endwhile ?>
  </tbody>
</table>