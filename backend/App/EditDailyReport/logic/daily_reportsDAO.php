<?php

// ■ 一社員の指定月の日報を取得
function getDailyReport($dbh, $employee_id, $yearAndMonth) {
    try {
        $stmt = $dbh->prepare("SELECT A.id, B.employee_number, start_time, end_time, break, summary, A.created_at, A.updated_at
                    FROM daily_reports AS A LEFT OUTER JOIN employees AS B ON employee_id = B.employee_number
                    WHERE B.id = :id AND start_time LIKE :yearAndMonth");
        $stmt->bindParam(':id', $employee_id, PDO::PARAM_INT);
        $yearAndMonth .= "-%";//例:'2022-10-%'
        $stmt->bindParam(':yearAndMonth', $yearAndMonth, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
        exit();
    }
}

// ■ 日報を更新
function updateDailyReport($dbh, $daily_reports_id, $start_time, $end_time, $break, $summary) {
    try {
        $stmt = $dbh->prepare("UPDATE daily_reports
                    SET start_time=:start_time, end_time=:end_time, `break`=:break, summary=:summary
                    WHERE id=:id;");
        $stmt->bindParam(':id', $daily_reports_id, PDO::PARAM_INT);
        $stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $end_time, PDO::PARAM_STR);
        $stmt->bindParam(':break', $break, PDO::PARAM_INT);
        $stmt->bindParam(':summary', $summary, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
        exit();
    }
}

// ■ 日報を削除
function deleteDailyReport($dbh, $daily_reports_id, ) {
    try {
        $stmt = $dbh->prepare("DELETE FROM daily_reports WHERE id = :id limit 1;"); //事故防止のため「limit 1」
        $stmt->bindParam(':id', $daily_reports_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
        exit();
    }
}

?>