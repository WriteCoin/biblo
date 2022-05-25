<?php
  if (isset($reader)) {
    $query = pg_query_params($conn, "SELECT * FROM person INNER JOIN reader ON person.id_person = reader.id_person WHERE id_reader = $1", Array($reader['id_reader']));
  }
?>