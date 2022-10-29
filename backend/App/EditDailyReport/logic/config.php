<?php
// DBへの接続
function dbconnect() {
    $dsn = 'mysql:dbname=php_local;host=db;charset=utf8';
    $user = 'phper';
    $password = 'secret';
    
    $dbh = new PDO ($dsn, $user, $password); //一般的な処理の範囲ならPDOで十分
    if (!$dbh) { //DB接続チェック
        echo "接続失敗: " . $e->getMessage() . "\n";
    }
    return $dbh;
}
?>