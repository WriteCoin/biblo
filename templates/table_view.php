<?php $data = pg_fetch_assoc($query_keys); ?>
<table>
  <thead>
    <tr>
      <?php foreach ($data as $key => $value) { ?>
        <th><?= $key ?></th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php while ($data = pg_fetch_assoc($query)) : ?>
      <tr>
        <?php foreach ($data as $key => $value) { ?>
          <td><?= $value ?></td>
        <?php } ?>
      </tr>
    <?php endwhile ?>
  </tbody>
</table>