<?php
// session_start();

// ヘッダー（ナビゲーション）
$title = "日報編集ページ";
include('common/header.php'); //画面処理などの場合はinclude
// DB接続
require_once('logic/config.php');
// 日時フォーマット変更
require_once('logic/changeDate.php');
// いろんな関数
require_once('logic/functions.php');
// employeesテーブル操作
require_once('logic/employeesDAO.php');
// daily_reportsテーブル操作
require_once('logic/daily_reportsDAO.php');
?>

<?php
// 遷移元ページから渡されるデータ
$employee_id = "2"; //employees.id(社員番号="1200001")

try {
    $dbh = dbconnect();

    // ■ 社員情報の取得
    $res1 = getEmployee($dbh, $employee_id);
    // echo '<pre>'; var_dump($res1); echo '</pre>';//デバッグ表示

    $yearAndMonth = "";
    // ■ 表示年月の切り替え
    if (isset($_POST['changeMonth'])) {
      $type_int = $_POST['changeMonth'];
      $yearAndMonth = changeMonth($yearAndMonth, $type_int);
    } else {
      $yearAndMonth = date('Y-m'); //初期値は今月初日
    }

    // ■ 日報情報の取得
    $res2 = getDailyReport($dbh, $employee_id, $yearAndMonth);
    // echo '<pre>'; var_dump($res2); echo '</pre>';//デバッグ表示

} catch (PDOException $e) {
    echo $e->getMessage() . "\n";
    exit();
}

// ■ 編集フォーム
// 初期状態
$readonly = "readonly";
$runButton = "<button type='button' class='btn btn-success fs-5 px-4 edit-btn' disabled>編集する</button>";
if (isset($_REQUEST['update'])) {
  echo "日報ID:" . $_REQUEST['update'] . "の「編集」ボタンが押された" . "\r\n"; //デバッグ表示
  $runButton = "<button type='submit' class='btn btn-success fs-5 px-4 edit-btn' name='confirmUpdate' value=" . $_REQUEST['update'] . ">編集する</button>";
  $readonly = "";
}
if (isset($_REQUEST['delete'])) {
  echo "日報ID:" . $_REQUEST['delete'] . "の「削除」ボタンが押された" . "\r\n"; //デバッグ表示
  $runButton = "<button type='submit' class='btn btn-danger fs-5 px-4 delete-btn' name='confirmDelete' value=" . $_REQUEST['delete'] . ">削除する</button>";
}

// 実行ボタン
if (isset($_REQUEST['confirmUpdate'])) {
  // 「編集する」ボタンを押したら
  echo "「編集する」ボタンが押された" . "\r\n"; //デバッグ表示
} else if (isset($_REQUEST['confirmDelete'])) {
  // 「削除する」ボタンを押したら
  echo "「削除する」ボタンが押された" . "\r\n"; //デバッグ表示
}
?>

<?php
/* 現在の年月を取得 */
//// wataさんコード～
$timestamp = "";
$timestamp = $res2[0]['start_time']; //例:start_time = "2022-10-14 09:00:00" 月初めの日報の始業時刻から取得
$yearAndMonth = changeYearAndMonth($timestamp);
//// ～wataさんコード
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>日報編集ページ</title>
</head>

<body>
<div class="container">

<div class="d-flex justify-content-center p-3 mt-4">
  <h2><?= $res1['employee_number'] ?> <?= $res1['name'] ?></h2>
</div>

  <form action="" method="post" class="col d-flex justify-content-center">
  <button type="submit" class="btn btn-light previous-btn" name="changeMonth" value="-1">&#9664;</button> <!--- 前月ボタン -->
  <h2><?= $yearAndMonth ?></h2>
  <button type="submit" class="btn btn-light next-btn" name="changeMonth" value="1">&#9654;</button> <!--- 翌月ボタン -->
  </form>

<table class="table mb-4">
  <thead>
    <tr>
      <th scope="col">日付</th>
      <th scope="col">始業</th>
      <th scope="col">終業</th>
      <th scope="col">休憩（分）</th>
      <th scope="col">業務内容</th>
      <th scope="col">操作</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($res2 as $row): ?>
      <tr>
        <form action="" method="post">
        <td><input type="text" name="day" value="<?= changeDateAndDayOfWeek($row['start_time']) ?>" readonly></th>
        <td><input type="text" name="start_time" value="<?= changeHourAndMinutes($row['start_time']) ?>" readonly></td>
        <td><input type="text" name="end_time"  value="<?= changeHourAndMinutes($row['end_time']) ?>" readonly></td>
        <td><input type="text" name="break"  value="<?= $row['break'] ?>" readonly></td>
        <td><textarea rows="1" style="min-width: 100%" name="summary" readonly><?php echo $row['summary'] ?></textarea></td>
        <td><button type="submit" class="btn btn-success" name="update" value="<?= $row['id'] ?>">編集</button></td>
        <td><button type="submit" class="btn btn-danger" name="delete" value="<?= $row['id'] ?>">削除</button></td>
        </form>
      </tr>
  <?php endforeach ?>
  </tbody>
</table>

<table class="table mb-4">
  <thead></thead>
    <tr>
      <th scope="col">日付</th>
      <th scope="col">始業</th>
      <th scope="col">終業</th>
      <th scope="col">休憩（分）</th>
      <th scope="col">業務内容</th>
    </tr>
  </thead>
  <tbody>
      <tr>
        <td><input type="date" value="<?php if(isset($_REQUEST['day'])) {echo $_REQUEST['day'];} ?>" <?= $readonly?>></td>
        <td><input type="time" value="<?php if(isset($_REQUEST['day'])) {echo $_REQUEST['start_time'];} ?>" <?= $readonly?>></td>
        <td><input type="time" value="<?php if(isset($_REQUEST['day'])) {echo $_REQUEST['end_time'];} ?>" <?= $readonly?>></td>
        <td><input type="number" min="0" step="30" value="<?php if(isset($_REQUEST['day'])) {echo $_REQUEST['break'];} ?>" <?= $readonly?>></td>
        <td><textarea rows="5" style="min-width: 100%" <?= $readonly?>><?php if(isset($_REQUEST['day'])) {echo $_REQUEST['summary'];} ?></textarea></td>
      </tr>
      </tbody>
</table>

<div class="d-grid gap-2 col-3 mx-auto d-flex justify-content-center">
  <form action="" method="post">
    <?php echo $runButton ?>
  </form>
</div>

</div><!-- .container -->
</body>
</html>