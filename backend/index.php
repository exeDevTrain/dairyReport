<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Document</title>

</head>
<body>
<div class="d-flex justify-content-center p-3 mb-2 bg-danger text-white">
  <h1>日報登録システム</h1>
</div>


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

<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">employee_id</th>
      <th scope="col">start_time</th>
      <th scope="col">end_time</th>
      <th scope="col">break</th>
      <th scope="col">summary</th>
      <th scope="col">created_at</th>
      <th scope="col">updated_at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $row): ?>
      <tr>
        <th scope="row"><?php echo $row['id']; ?></th>
        <td><?php echo $row['employee_id']; ?></td>
        <td><?php echo $row['start_time']; ?></td>
        <td><?php echo $row['end_time']; ?></td>
        <td><?php echo $row['break']; ?></td>
        <td><?php echo $row['summary']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td><?php echo $row['updated_at']; ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

</body>
</html>