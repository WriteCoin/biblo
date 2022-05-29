<?php
  require '../controller/connect_info.php';

  $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

  if (!$conn) {
    die('Could not connect');
  }

  session_start();

  require 'set_user.php';

  // определение текущей страницы
  function get_current_url() {
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];
    return $url;
  }
  $current_url = get_current_url();

  function for_role($role) {
    global $user_role_name;
    if ($user_role_name != $role) {
      die("Страница только для роли " . $user_role_name);
    }
  }

  $secure_data = fn($data) => strip_tags(htmlspecialchars($data));

  $secure_arr = function($arr) use ($secure_data) {
    $num = count($arr);
    for ($i = 0; $i < $num; $i++) {
      $arr[$i] = $secure_data($arr[$i]);
    }
    return $arr;
  };

  $get_post = fn($str_data, $default) => isset($_POST[$str_data]) ? $_POST[$str_data] : $default;

  $get_GET = fn($str_data, $default) => isset($_GET[$str_data]) ? $_GET[$str_data] : $default;

  function get_sql_cond($operator, $default_cond) {
    return function($conds) use ($operator, $default_cond) {
      $result = '';
      if (!is_array($conds)) {
        return $result;
      }
      $num = count($conds);
      for ($i = 0; $i < $num; $i++) {
        if (!$conds[$i]) {
          if ($num == 1 && $default_cond == 'false' && $operator == 'or') {
            $conds[$i] = '(true)';
          } else {
            $conds[$i] = '(' . $default_cond . ')';
          }
        }
        $result = $result . $conds[$i];
        $result = ($i !== $num - 1) ? $result . ' ' . $operator . ' ' : $result;
      }
      return $result;
    };
  }

  function get_sql_and($conds) {
    return get_sql_cond('and', 'true')($conds);
  }

  function get_sql_or($conds) {
    return get_sql_cond('or', 'false')($conds);
  }
  
  // echo get_sql_and(['1 == 1', '', 'TRUE != 1']) . '<br>';
  // echo get_sql_or(['1', '2', '3']) . '<br>';

  function apply_field_equal($field, $conds, $is_literal = false) {
    if (!is_array($conds)) {
      return [];
    }
    $num = count($conds);
    for ($i = 0; $i < $num; $i++) {
      if ($conds[$i]) {
        if ($is_literal) {
          $conds[$i] = '\'' . $conds[$i] . '\'';
        }
        $conds[$i] = "$field = $conds[$i]";
      }
    }
    return $conds;
  }
  
  // print_r(apply_field_equal('name', ['1', '2', '3']));

  function get_date($date_str) {
    $timeZone = 'T';
    $dateTime = new DateTime($date_str);
    $dateTime->setTimeZone(new DateTimeZone($timeZone));
    $dateTime->add(new DateInterval('PT10H'));
    return $dateTime;
  }

  function site_message() {
    if (isset($_SESSION['op_message'])) {
      echo '<div style="color: green; ">' . $_SESSION['op_message'] . '</div><hr>';
      unset($_SESSION['op_message']);
    } else if (isset($_SESSION['op_message_error'])) {
      echo '<div style="color: red; ">' . $_SESSION['op_message_error'] . '</div><hr>';
      unset($_SESSION['op_message_error']);
    }
  }

  // function display_error($msg) {
  //   echo '<div style="color: red; ">' . $msg . '</div><hr>';
  // }

  // function display_success($msg) {
  //   echo '<div style="color: white; ">' . $msg . '</div><hr>';
  // }
?>