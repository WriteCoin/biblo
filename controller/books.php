<?php
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

  $book_cond = get_sql_or('title', $book_titles);
  $publishing_house_cond = get_sql_or('book.publishing_house', $publishing_houses);
  if ($publication_year_min && $publication_year_max) {
    $publication_year_cond = "$publication_year_min >= book.year_publication AND book.year_publication <= $publication_year_max";
  } else {
    $publication_year_cond = '';
  }
  $author_cond = get_sql_or('author.fio', $authors);
  $genre_cond = get_sql_or('genre.genre', $genres);

  $cond = get_sql_and([$book_cond, $publishing_house_cond, $publication_year_cond, $author_cond, $genre_cond]);

  $sql ="
    SELECT book.title AS \"Название\", book.publishing_house AS \"Издательство\", book.year_publication AS \"Год издания\", author.fio AS \"ФИО автора\", genre.genre AS \"Жанр\"
    FROM book 
      INNER JOIN author_book ON book.id_book = author_book.id_book 
      INNER JOIN author ON author.id_author = author_book.id_author
      INNER JOIN genre_book ON genre_book.id_book = book.id_book
      INNER JOIN genre ON genre.id_genre = genre_book.id_genre
    WHERE ($cond);
    ";

  // echo $sql . '<br>';
  $query = pg_query($conn, $sql);
  $query_keys = pg_query($conn, $sql);
?>