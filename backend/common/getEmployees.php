<?php
$dsn = 'mysql:dbname=php_local;host=db;charset=utf8';
$user = 'phper';
$password = 'secret';

try {
  $dbh = new PDO ($dsn, $user, $password);
  $stmt = $dbh->query('SELECT * FROM employees');
  $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo "接続失敗: " . $e->getMessage() . "\n";
  exit();
}