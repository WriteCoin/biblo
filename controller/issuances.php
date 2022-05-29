<?php
  $query_check_date = pg_query_params($conn, "SELECT * FROM issuance INNER JOIN exemplar ON issuance.id_exemplar = exemplar.id_exemplar INNER JOIN book ON book.id_book = exemplar.id_book WHERE id_reader_ticket = $1 AND date_delivery <= current_date", Array($reader['id_reader']));
  if ($query_check_date) {
    while ($data = pg_fetch_object($query_check_date)) {
      $query_update_exemplar = pg_query_params($conn, "UPDATE exemplar SET lost = TRUE WHERE lost_by_whom = $1 AND id_book = $2", Array($reader['id_reader'], $data->id_book));
    }
  }

  $date_issuance = $get_post('Дата_выдачи', '');
  $date_delivery = $get_post('Дата_возврата', '');
  if ($date_issuance || $date_delivery) {
    try {
      if ($date_issuance) {
        $query_update = pg_query_params($conn, "UPDATE issuance SET date_issuance = $1 WHERE id_reader_ticket = $2", Array($date_issuance, $reader['id_reader']));
      }
      if ($date_delivery) {
        $query_update = pg_query_params($conn, "UPDATE issuance SET date_delivery = $1 WHERE id_reader_ticket = $2", Array($date_delivery, $reader['id_reader']));
      }
      $_SESSION['op_message'] = 'Данные успешно изменены';
      header('Location: ../views/issuances.php');
    } catch (Error $ex) {
      die('Произошла ошибка');
    }
  }

  $sql ="
    SELECT issuance.id_issuance, book.title AS \"Название\", book.publishing_house AS \"Издательство\", book.year_publication AS \"Год издания\", author.fio AS \"ФИО автора\", genre.genre AS \"Жанр\",
           exemplar.lost AS \"Не возвращена?\", issuance.date_issuance AS \"Дата_выдачи\", issuance.date_delivery AS \"Дата_возврата\", issuance.date_actual_delivery AS \"Действительная дата возврата\"
    FROM book 
      INNER JOIN author_book ON book.id_book = author_book.id_book 
      INNER JOIN author ON author.id_author = author_book.id_author
      INNER JOIN genre_book ON genre_book.id_book = book.id_book
      INNER JOIN genre ON genre.id_genre = genre_book.id_genre
      INNER JOIN exemplar ON exemplar.id_book = book.id_book
      INNER JOIN issuance ON issuance.id_exemplar = exemplar.id_exemplar;
  ";

  $query = pg_query($conn, $sql);
  $query_keys = pg_query($conn, $sql);

  $min_date_issuance = get_date('');
  $max_date_issuance = get_date('');
  $max_date_issuance->add(new DateInterval('P5D'));

  $min_date_issuance_str = $min_date_issuance->format('Y-m-d');
  $max_date_issuance_str = $max_date_issuance->format('Y-m-d');

  $min_date_delivery = get_date('');
  $max_date_delivery = get_date('');
  $max_date_delivery->add(new DateInterval('P10D'));

  $min_date_delivery_str = $min_date_delivery->format('Y-m-d');
  $max_date_delivery_str = $max_date_delivery->format('Y-m-d');
?>