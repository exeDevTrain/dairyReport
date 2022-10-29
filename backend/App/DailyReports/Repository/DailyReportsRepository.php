<?php
declare(strict_types=1);

namespace App\DailyReports\Repository;

use App\DailyReports\Config\ExecuteMySql;

require_once(__DIR__ . '/../Config/ExecuteMySql.php');


final class DailyReportsRepository {

    public function fetchAll(): array
    {
        $query = 'SELECT 
                    `id`,
                    `employee_id`,
                    `start_time`,
                    `end_time`,
                    `break`,
                    `summary`,
                    `created_at`
                  FROM 
                    `daily_reports`';

        $mysql = new ExecuteMySql(query: $query);

        return $mysql->execute();
    }
}