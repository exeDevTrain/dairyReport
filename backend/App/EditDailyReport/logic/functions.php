<?php

// ■ 表示年月の切り替え todo:今月に切り替えできない問題
function changeMonth($yearAndMonth, $type) {
  if ($type === "before") {
    // 前月へ
    return date('Y-m', strtotime($yearAndMonth . '-1 month'));
  } else if ($type === "next") {
    // 翌月へ
    return date('Y-m', strtotime($yearAndMonth . '+1 month'));
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