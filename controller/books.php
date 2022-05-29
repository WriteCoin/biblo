<?php
  $id_book = $get_post('id_book', 0);
  if ($id_book) {
    // $today = get_date('');
    $query_count_existing_issues = pg_query_params($conn, "SELECT COUNT(id_issuance) FROM issuance WHERE id_reader_ticket = $1 AND date_issuance = current_date GROUP BY id_issuance", Array($reader['id_reader']));

    if ($query_count_existing_issues) {
      $count_existing_issues = pg_fetch_assoc($query_count_existing_issues);
      if ($count_existing_issues) {
        $count_existing_issues = $count_existing_issues['count'];
      }
    }

    if ($query_count_existing_issues && $count_existing_issues && $count_existing_issues >= 5) {
      $_SESSION['op_message_error'] = 'Нельзя выбирать больше 5 книг в день';
    } else {
      $query_count_losts = pg_query_params($conn, "SELECT COUNT(id_exemplar) FROM exemplar WHERE lost_by_whom = $1 AND lost = TRUE", Array($reader['id_reader']));

      if ($query_count_losts) {
        $count_losts = pg_fetch_assoc($query_count_losts);
        if ($count_losts) {
          $count_losts = $count_losts['count'];
        }
      }

      if ($query_count_losts && $count_losts && $count_losts >= 5) {
        $_SESSION['op_message_error'] = 'Нельзя выбрать книгу; верните свои потерянные';
      } else {
        $query_new_exemplar = pg_query_params($conn, "INSERT INTO exemplar(id_book, lost, lost_by_whom) VALUES ($1, FALSE, $2) RETURNING id_exemplar", Array($id_book, $reader['id_reader']));
        $new_exemplar = pg_fetch_assoc($query_new_exemplar);
        // $exemplar = pg_query($conn, "SELECT * FROM exemplar WHERE lost_by_whom = $1 AND id_exemplar = MAX(id_exemplar)", Array($reader['id_reader']));
        $query_new_issuance = pg_query_params($conn, "INSERT INTO issuance(id_reader_ticket, id_exemplar, date_issuance, date_delivery) VALUES ($1, $2, current_date, current_date + interval '5 day')", Array($reader['id_reader'], $new_exemplar['id_exemplar']));

        $_SESSION['op_message'] = 'Книга выбрана'; 
      }
    }

    header('Location: ../views/index.php');
  }

  $book_titles = $get_GET('book_titles', '');
  $publishing_houses = $get_GET('publishing_houses', '');
  $publication_year_min = $get_GET('publication_year_min', '');
  $publication_year_max = $get_GET('publication_year_max', '');
  $authors = $get_GET('authors', '');
  $genres = $get_GET('genres', '');

  $book_titles = apply_field_equal('book.title', $book_titles, true);
  $publishing_houses = apply_field_equal('book.publishing_house', $publishing_houses, true);
  $authors = apply_field_equal('author.fio', $authors, true);
  $genres = apply_field_equal('genre.genre', $genres, true);

  // print_r($book_titles);
  // echo '<br>';

  $book_cond = get_sql_or($book_titles);
  $publishing_house_cond = get_sql_or($publishing_houses);
  if ($publication_year_min && $publication_year_max) {
    $publication_year_cond = "book.year_publication BETWEEN '$publication_year_min' AND '$publication_year_max'";
  } else {
    $publication_year_cond = '';
  }
  $author_cond = get_sql_or($authors);
  $genre_cond = get_sql_or($genres);

  // echo $book_cond . '<br>';

  $cond = get_sql_and([$book_cond, $publishing_house_cond, $publication_year_cond, $author_cond, $genre_cond]);

  // echo $cond . '<br>';

  $sql ="
    SELECT book.id_book, book.title AS \"Название\", book.publishing_house AS \"Издательство\", book.year_publication AS \"Год издания\", author.fio AS \"ФИО автора\", genre.genre AS \"Жанр\"
    FROM book 
      INNER JOIN author_book ON book.id_book = author_book.id_book 
      INNER JOIN author ON author.id_author = author_book.id_author
      INNER JOIN genre_book ON genre_book.id_book = book.id_book
      INNER JOIN genre ON genre.id_genre = genre_book.id_genre
    WHERE ($cond);
    ";

  // echo $sql . '<br>';

  // echo $sql . '<br>';
  $query = pg_query($conn, $sql);
  $query_keys = pg_query($conn, $sql);
?>