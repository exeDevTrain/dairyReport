<?php

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

?>