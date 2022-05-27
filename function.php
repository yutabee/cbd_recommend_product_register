<?php

function connect_to_db()
{
  $dbn = 'mysql:dbname=php_cbd_table;charset=utf8mb4;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

  try {
    return  new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}
