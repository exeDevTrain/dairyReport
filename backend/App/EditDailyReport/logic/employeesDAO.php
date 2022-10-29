<?php

function getEmployee($dbh, $employee_id) {
    try {
        $stmt1 = $dbh->prepare("SELECT id, employee_number, `name`, is_admin, delete_flag, created_at, updated_at
                    FROM employees WHERE id = :id");
        $stmt1->bindParam(':id', $employee_id, PDO::PARAM_INT);
        $stmt1->execute();
        return $stmt1->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
        exit();
    }
}


?>