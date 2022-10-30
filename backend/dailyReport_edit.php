<?php
// session_start();
// DB接続
require_once('./App/EditDailyReport/logic/config.php');
// 日時フォーマット変更
require_once('./App/EditDailyReport/logic/changeDate.php');
// いろんな関数
require_once('./App/EditDailyReport/logic/functions.php');
// employeesテーブル操作
require_once('./App/EditDailyReport/logic/employeesDAO.php');
// daily_reportsテーブル操作
require_once('./App/EditDailyReport/logic/daily_reportsDAO.php');

// 遷移元ページから渡されるデータ
$employee_id = "2"; //employees.id(社員番号="1200001")

$THISMONTH = date("Y-m-01"); //定数のように扱う

try {
  $dbh = dbconnect();
  // ■ 社員情報の取得
  $res1 = getEmployee($dbh, $employee_id);
  // echo '<pre>'; var_dump($res1); echo '</pre>';//デバッグ表示

  // ■ 表示年月の切り替え
  $month = "";
  if (isset($_GET['changeMonth'])) { //"before"または"next"
    // $month = changeMonth($_GET['current'], $_GET['changeMonth']);
    $month = $_GET['changeMonth'];
  } else {
    $month = substr($THISMONTH, 0, 7);
  }
  // echo "＄month=" . $month;

  // ■ 日報情報の取得
  $res2 = getDailyReport($dbh, $employee_id, $month);
  // echo '<pre>'; var_dump($res2); echo '</pre>';//デバッグ表示

} catch (PDOException $e) {
  echo $e->getMessage() . "\n";
  exit();
}

// ■ 編集フォーム
// 初期状態
$readonly = "readonly";
$runButton = "<button type='button' class='btn btn-success fs-5 px-4 edit-btn' disabled>編集する</button>";
$message = "";
// 「編集」
if (isset($_REQUEST['update'])) {
  $debugDisp = "日報ID:" . $_REQUEST['update'] . "の「編集」ボタンが押された"; //デバッグ表示
  $runButton = "<button type='submit' class='btn btn-success fs-5 px-4 edit-btn' name='confirmUpdate' value=" . $_REQUEST['update'] . ">編集する</button>";
  $readonly = "";
}
// 「削除」
if (isset($_REQUEST['delete'])) {
  $debugDisp = "日報ID:" . $_REQUEST['delete'] . "の「削除」ボタンが押された"; //デバッグ表示
  $runButton = "<button type='submit' class='btn btn-danger fs-5 px-4 delete-btn' name='confirmDelete' value=" . $_REQUEST['delete'] . ">削除する</button>";
}

// ■ 実行ボタン
if (isset($_REQUEST['confirmUpdate'])) {
  // 「編集する」
  $debugDisp = "「編集する」ボタンが押された"; //デバッグ表示
  $daily_reports_id = $_POST['confirmUpdate'];
  $date = $_POST['date'];
  $start_time = $date . " " . $_POST['start_time'] . ":00";
  $end_time = $date . " " . $_POST['end_time'] . ":00";
  $break = $_POST['break'];
  $summary = $_POST['summary'];
  $debugDisp = $daily_reports_id . "," . $date . "," . $start_time . "," . $end_time . "," . $break . "," . $summary; //デバッグ表示
  $cnt = updateDailyReport($dbh, $daily_reports_id, $start_time, $end_time, $break, $summary);
  if ($cnt === 1) {
    $message = "日報ID:" . $daily_reports_id . "を編集しました。"; //todo:セッションで保持する
    $url = "http://localhost:28000/App/EditDailyReport/dailyReport_edit.php?changeMonth=" . $month;
    header('Location: ' . $url); //リダイレクト
    exit();
  } else {
    $message = "何らかのエラー（変更されていないなど）";
  }
} else if (isset($_REQUEST['confirmDelete'])) {
  // 「削除する」
  $debugDisp = "「削除する」ボタンが押された"; //デバッグ表示

  $daily_reports_id = $_POST['confirmDelete'];
  $cnt = deleteDailyReport($dbh, $daily_reports_id);
  if ($cnt === 1) {
    $message = "日報ID:" . $daily_reports_id . "を削除しました。</span></p>";
    // header('Location: ./dailyReport_edit.php'); //リダイレクト
    $url = "http://localhost:28000/App/EditDailyReport/dailyReport_edit.php?changeMonth=" . $month;
    header('Location: ' . $url); //リダイレクト
    exit();
  } else {
    $message = "日報ID:" . $daily_reports_id . "は存在しません。日報を確認してください。</span></p>";
  }
}
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
<?php
// ヘッダー
$title = "日報編集ページ";
include('./App/EditDailyReport/common/header.php'); //画面処理などの場合はinclude
?>
<body>
<div class="container">

<div class="d-flex justify-content-center p-3 mt-4">
  <h2><?= $res1['employee_number'] ?> <?= $res1['name'] ?></h2>
</div>

  <form action="" method="get" class="col d-flex justify-content-center">
  <button type="submit" class="btn btn-light previous-btn" name="changeMonth" value="<?= date('Y-m', strtotime($month . " -1 month")) ?>">&#9664;</button> <!--- 前月ボタン -->
  <h2><?= changeYearAndMonth($month) ?></h2>
  <button type="submit" class="btn btn-light next-btn" name="changeMonth" value="<?= date('Y-m', strtotime($month . " +1 month")) ?>">&#9654;</button> <!--- 翌月ボタン -->
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
        <td><input type="text" value="<?= changeDateAndDayOfWeek($row['start_time']) ?>" readonly></th>
        <input type="hidden" name="date" value="<?= $row['start_time'] ?>">
        <td><input type="text" value="<?= changeHourAndMinutes($row['start_time']) ?>" readonly></td>
        <input type="hidden" name="start_time" value="<?= $row['start_time'] ?>">
        <td><input type="text" value="<?= changeHourAndMinutes($row['end_time']) ?>" readonly></td>
        <input type="hidden" name="end_time" value="<?= $row['end_time'] ?>">
        <td><input type="text" name="break"  value="<?= $row['break'] ?>" readonly></td>
        <td><textarea rows="1" style="min-width: 100%" name="summary" readonly><?php echo $row['summary'] ?></textarea></td>
        <td><button type="submit" class="btn btn-success" name="update" value="<?= $row['id'] ?>">編集</button></td>
        <td><button type="submit" class="btn btn-danger" name="delete" value="<?= $row['id'] ?>">削除</button></td>
        </form>
      </tr>
  <?php endforeach ?>
  </tbody>
</table>

<form action="" method="post">
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
        <!-- データ送信用に、hiddenで生の値も送信「例:2022-10-14 09:00:00」 -->
        <td><input type="date" name="date" value="<?php if(isset($_POST['date'])) {echo removeTime($_POST['date']);} ?>" <?= $readonly?>></td> <!-- 例:2022-10-18 -->
        <td><input type="time" name="start_time" value="<?php if(isset($_POST['start_time'])) {echo changeHourAndMinutes($_POST['start_time']);} ?>" <?= $readonly?>></td>
        <td><input type="time" name="end_time" value="<?php if(isset($_POST['end_time'])) {echo changeHourAndMinutes($_POST['end_time']);} ?>" <?= $readonly?>></td>
        <td><input type="number" name="break" min="0" step="30" value="<?php if(isset($_REQUEST['break'])) {echo $_REQUEST['break'];} ?>" <?= $readonly?>></td>
        <td><textarea rows="5" name="summary" style="min-width: 100%" <?= $readonly?>><?php if(isset($_REQUEST['summary'])) {echo $_REQUEST['summary'];} ?></textarea></td>
      </tr>
      </tbody>
</table>

<div class="d-grid gap-2 col-3 mx-auto d-flex justify-content-center">
    <?= $runButton ?>
  </div>
  <p><?php if(isset($debugDisp)) { echo $debugDisp; }?></p>
  <p><span class="error"><?= $message ?></span></p>
</form>

</div><!-- .container -->
</body>
</html>