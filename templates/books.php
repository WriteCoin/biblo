<?php $data = pg_fetch_assoc($query_keys); ?>
<table>
  <thead>
    <tr>
      <?php if ($data) : ?>
      <?php foreach ($data as $key => $value) { ?>
        <?php if ($key != 'id_book') : ?>
          <th><?= $key ?></th>
        <?php endif ?>
      <?php } ?>
      <?php endif ?>
    </tr>
  </thead>
  <tbody>
    <?php if (!pg_num_rows($query)) : ?>
      <p><i>Книг не найдено</i></p>
    <?php endif ?>
    <?php while ($data = pg_fetch_assoc($query)) : ?>
      <!-- <tr class="tr_book" onmouseover='this.firstChild.lastChild.firstChild.removeAttribute("hidden")' onmouseout='this.firstChild.lastChild.firstChild.setAttribute("hidden", "hidden")'> -->
      <!-- <tr class="tr_book" onmouseover='console.log(this.firstChild.nextElementSibling.tagName.toLowerCase()); console.log(document.getElementsByTagName(".tr_book > " + this.firstChild.nextElementSibling.tagName.toLowerCase() + " > td"))'> -->
      <tr class="tr_book">
        <form method="post">
          <?php foreach ($data as $key => $value) { ?>
            <?php if ($key != 'id_book') : ?>
              <td><?= $value ?></td>
            <?php else : ?>
              <input type="hidden" name="id_book" value="<?= $value ?>">
            <?php endif ?>
          <?php } ?>
          <td>
            <button type="submit"
              <?php if (!isset($reader)) : ?>
                hidden
              <?php endif ?>
            >Выбрать</button>
          </td>
          <!-- <button hidden type="submit" onmouseover='this.removeAttribute("hidden")' onmouseout='this.setAttribute("hidden", "hidden")'>Выбрать</button> -->
        </form>
      </tr>
    <?php endwhile ?>
  </tbody>
</table>

<!-- <script>
  const trs = document.querySelectorAll('.tr_book')
  if (trs.length) {
    trs.forEach(function(tr) {
      console.log(tr)
      tr.onmouseover = function() {
        // console.log(this)
        // const form = this.firstChild
        // console.log(form)
        const form = this.firstChild.nextElementSibling
        console.log(form.innerHTML)
        const nodes = form.childNodes
        console.log(nodes)
      }

      // tr.addEventListener('onmouseover', function() {
      //   console.log(this)
      //   const form = this.firstChild
      //   console.log(form)
      // })
    })
  }
</script> -->