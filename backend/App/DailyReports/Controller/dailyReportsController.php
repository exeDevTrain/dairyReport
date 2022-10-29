<?php

namespace App\DailyReports\Controller;

use App\DailyReports\UseCase\FetchAll;


require_once(__DIR__ . './../UseCase/Fetch.php');


final class dailyReportsController {
    public function fetchAll()
    {
        $fetchAll = new FetchAll();

        return $fetchAll->execute();
    }
}