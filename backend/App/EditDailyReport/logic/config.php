<?php
// DBへの接続
function dbconnect() {
    $dsn = 'mysql:dbname=php_local;host=db;charset=utf8';
    $user = 'phper';
    $password = 'secret';
    
    $dbh = new PDO ($dsn, $user, $password);
    if (!$dbh) { //DB接続チェック
        echo "接続失敗: " . $e->getMessage() . "\n";
    }
    return $dbh;
}
?>