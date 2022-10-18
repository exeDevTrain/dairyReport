<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Hello World!</h1>
  <p>pタグを追加</p>

<?php
// DB接続（ローカル用）
$dsn = 'mysql:dbname=php_local;host=db;charset=utf8';
$user = 'phper';
$password = 'secret';

try {
  $dbh = new PDO ($dsn, $user, $password);
  $stmt = $dbh->query('SELECT * FROM daily_reports');
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo "接続失敗: " . $e->getMessage() . "\n";
  exit();
}
?>

<table>
  <tr><th>ID</th><th>社員番号</th><th>始業時刻</th><th>終業時刻</th><th>休憩時間</th><th>業務内容</th><th>登録日時</th><th>更新日時</th></tr>
  <?php foreach($result as $row): ?>
  <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['employee_id']; ?></td>
    <td><?php echo $row['start_time']; ?></td>
    <td><?php echo $row['end_time']; ?></td>
    <td><?php echo $row['break']; ?></td>
    <td><?php echo $row['summary']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td><?php echo $row['updated_at']; ?></td>
  </tr>
  <?php endforeach ?>
</table>

</body>
</html>