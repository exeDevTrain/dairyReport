<?php

// ■ 表示年月の切り替え todo:今月に切り替えできない問題
function changeMonth($yearAndMonth, $type_int) {
    $month = date('Y-m-1'); //初期値は今月初日
    if (isset($_POST['changeMonth'])) {
      if (($_POST['changeMonth']) === '-1') {
        return date('Y-m', strtotime($month . '-1 month'));
      } else if (($_POST['changeMonth']) === '1') {
        return date('Y-m', strtotime($month . '+1 month'));
      }
    } else {
      return date('Y-m', strtotime($month));
    }
}

// ■ ログインチェック todo:フィルターで一括チェックしたい
// $employee_id = "";
// if (isset($_SESSION['employee_id']) && isset($_SESSION['employee_num'])) {
//   $employee_id = $_SESSION['employee_id'];
// } else {
//   header('Location: login.php');
//   exit();
// }
?>