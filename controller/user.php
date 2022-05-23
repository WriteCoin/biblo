<?php
  if (isset($reader)) {
    $query = pg_query_params($conn, "SELECT * FROM person INNER JOIN readers ON person.id = readers.person_id WHERE person_id = $1", Array($reader->id));
  } elseif (isset($admin)) {
    $query = pg_query_params($conn, "SELECT * FROM person INNER JOIN admins ON person.id = admins.person_id WHERE person_id = $1", Array($admin->id));
  }
?>